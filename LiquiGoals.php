<?php
use Pleesher\Client\Client;

class LiquiGoals
{
	/**
	 * @var \Pleesher\Client\Client
	 */
	public static $professions;

	public static function getConfigValue($key, $default = null)
	{
		return isset($GLOBALS['wg' . get_called_class() . $key]) ? $GLOBALS['wg' . get_called_class() . $key] : $default;
	}

	public static function initialize()
	{
		PleesherExtension::setImplementation(new LiquiGoals_PleesherImplementation());

		self::$professions = array_map(function($profession) { return (object)$profession; }, require __DIR__ . '/data/professions.php');
		foreach (self::$professions as $key => $profession)
			$profession->key = $key;
	}

	public static function initializeParser(Parser $parser)
	{
		$parser->setHook('UserLevel', 'LiquiGoals::viewUserLevel');
	}

	public static function beforePageDisplay(OutputPage &$out, Skin &$skin)
	{
		$out->addModuleStyles( 'ext.liquigoals' );
		// TODO: remove all the code below (temporary)

		if (isset($GLOBALS['wgUser']))
		{
			if ($out->getTitle()->getText() == 'RecheckAllMyAchievements')
			{
				PleesherExtension::$pleesher->revoke($GLOBALS['wgUser']->getId(), array_keys(PleesherExtension::$goal_data));
				PleesherExtension::$pleesher->checkAchievements($GLOBALS['wgUser']->getId());
			}
			else if ($out->getTitle()->getText() == 'RecheckAllUserAchievements')
			{
				foreach (PleesherExtension::getUsers() as $user)
					PleesherExtension::$pleesher->checkAchievements($user->getId());
			}
		}
	}

	public static function viewUserKudos($input, array $args, Parser $parser, PPFrame $frame)
	{
		$username = $args['user'];
		$user_id = User::idFromName($username);

		if ($user_id == 0)
		{
			PleesherExtension::$pleesher->logger->error(sprintf('No such wiki user: %s (%s)', $username, $_SERVER['REQUEST_URI']));
			return 0;
		}

		$user = User::newFromId($user_id);

		if (isset($args['profession']))
			return self::getUserKudosForProfession($user, $args['profession']);

		$pleesher_user = PleesherExtension::$pleesher->getUser($user_id);
		return $pleesher_user->kudos;
	}

	public static function viewUserLevel($input, array $args, Parser $parser, PPFrame $frame)
	{
		$username = $args['user'];
		$user_id = User::idFromName($username);

		if ($user_id == 0)
		{
			PleesherExtension::$pleesher->logger->error(sprintf('No such wiki user: %s (%s)', $username, $_SERVER['REQUEST_URI']));
			return 0;
		}

		if (isset($args['profession']))
			return self::getUserLevelForProfession($user_id, $args['profession']);

		// TODO: no level without profession yet
		return 0;
	}

	public static function getUserKudosForProfession(User $user, $profession_key)
	{
		$kudos = 0;

		$goals = PleesherExtension::getAchievements($user->getId());
		foreach ($goals as $goal)
		{
			if (in_array($profession_key, array_keys($goal->professions)))
				$kudos += $goal->kudos;
		}

		return $kudos;
	}

	public static function getUserLevelForProfession(User $user,  $profession_key)
	{
		$kudos_for_profession = self::getUserKudosForProfession($user, $profession_key);
		$profession = self::$professions[$profession_key];

		$level = 0;
		foreach ($profession->levels_kudos as $level_kudos)
		{
			if ($kudos_for_profession < $level_kudos)
				break;

			$level++;
		}

		return $level;
	}
}
