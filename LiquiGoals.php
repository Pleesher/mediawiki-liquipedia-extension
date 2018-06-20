<?php

class LiquiGoals {

	public static $professions;

	public static function getConfigValue( $key, $default = null ) {
		return isset( $GLOBALS[ 'wg' . get_called_class() . $key ] ) ? $GLOBALS[ 'wg' . get_called_class() . $key ] : $default;
	}

	public static function initialize() {
		PleesherExtension::setImplementation( new LiquiGoals_PleesherImplementation() );

		self::$professions = array_map( function($profession) {
			return (object) $profession;
		}, require __DIR__ . '/data/professions.php' );
		foreach ( self::$professions as $key => $profession ) {
			$profession->key = $key;
		}
	}

	public static function initializeParser( Parser $parser ) {
		$parser->setHook( 'UserLevel', 'LiquiGoals::viewUserLevel' );
	}

	public static function beforePageDisplay( OutputPage &$out, Skin &$skin ) {
		$out->addModuleStyles( 'ext.liquigoals' );
		// TODO: remove all the code below (temporary)

		if ( isset( $GLOBALS[ 'wgUser' ] ) && $GLOBALS[ 'wgUser' ]->isLoggedIn() ) {
			if ( $out->getTitle()->getText() == 'RecheckAllMyAchievements' ) {
				PleesherExtension::$pleesher->revoke( $GLOBALS[ 'wgUser' ]->getName(), array_keys( PleesherExtension::$goal_data ) );
				PleesherExtension::$pleesher->checkAchievements( $GLOBALS[ 'wgUser' ]->getName() );
			} elseif ( $out->getTitle()->getText() == 'RecheckAllUserAchievements' ) {
				foreach ( PleesherExtension::getUsers() as $user ) {
					PleesherExtension::$pleesher->checkAchievements( $user->getName() );
				}
			} elseif ( $out->getTitle()->getText() == 'CreateAccount' && $out->getTitle()->getNamespace() == NS_SPECIAL ) {
				PleesherExtension::$pleesher->checkAchievements( $GLOBALS[ 'wgUser' ]->getName() );
			}
		}
	}

	public static function extensionTypes( array &$extensionTypes ) {
		$extensionTypes[ 'pleesher' ] = wfMessage( 'version-pleesher' )->text();

		return true;
	}

	public static function viewUserKudos( $input, array $args, Parser $parser, PPFrame $frame ) {
		$user_name = $args[ 'user' ];
		$user_id = User::idFromName( $user_name );

		if ( $user_id == 0 ) {
			PleesherExtension::$pleesher->logger->error( sprintf( 'No such wiki user: %s (%s)', $user_name, $_SERVER[ 'REQUEST_URI' ] ) );
			return 0;
		}

		$user = User::newFromId( $user_id );

		if ( isset( $args[ 'profession' ] ) ) {
			return self::getUserKudosForProfession( $user, $args[ 'profession' ] );
		}

		$pleesher_user = PleesherExtension::$pleesher->getUser( $user_name );
		return $pleesher_user->kudos;
	}

	public static function viewUserLevel( $input, array $args, Parser $parser, PPFrame $frame ) {
		$user_name = $args[ 'user' ];
		$user_id = User::idFromName( $user_name );

		if ( $user_id == 0 ) {
			PleesherExtension::$pleesher->logger->error( sprintf( 'No such wiki user: %s (%s)', $user_name, $_SERVER[ 'REQUEST_URI' ] ) );
			return 0;
		}

		if ( isset( $args[ 'profession' ] ) ) {
			$user = User::newFromId( $user_id );
			return self::getUserLevelForProfession( $user, $args[ 'profession' ] );
		}

		// TODO: no level without profession yet
		return 0;
	}

	public static function getUserKudosForProfession( User $user, $profession_key ) {
		$kudos = 0;

		$goals = PleesherExtension::getAchievements( $user->getName() );
		foreach ( $goals as $goal ) {
			if ( in_array( $profession_key, array_keys( $goal->professions ) ) ) {
				$kudos += $goal->kudos;
			}
		}

		return $kudos;
	}

	public static function getUserLevelForProfession( User $user, $profession_key ) {
		$kudos_for_profession = self::getUserKudosForProfession( $user, $profession_key );
		$profession = self::$professions[ $profession_key ];

		$level = 0;
		foreach ( $profession->levels_kudos as $level_kudos ) {
			if ( $kudos_for_profession < $level_kudos ) {
				break;
			}

			$level++;
		}

		return $level;
	}

}
