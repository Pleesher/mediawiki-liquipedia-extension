<?php
class LiquiGoals_PleesherImplementation extends PleesherImplementation
{
	public function getGoalData()
	{
		return require __DIR__ . '/data/goals.php';
	}

	public function getGoalCategories()
	{
		return ['general', 'players', 'teams', 'transfers', 'improving_liquipedia', 'unconventional'];
	}

	public function getI18nPrefix()
	{
		return 'liquigoals';
	}

	public function getGoalCheckingContext()
	{
		return [
			'query_helper' => new LiquiGoals_QueryHelper(PleesherExtension::$pdo)
		];
	}

	public function getLogger()
	{
		$logger = new \Monolog\Logger('liquigoals');
		$logger->pushHandler(new \Monolog\Handler\RotatingFileHandler(__DIR__ . '/logs/debug.log', \Monolog\Logger::DEBUG));
		$logger->pushHandler(new \Monolog\Handler\RotatingFileHandler(__DIR__ . '/logs/warning.log', \Monolog\Logger::WARNING));
		$logger->pushHandler(new \Monolog\Handler\RotatingFileHandler(__DIR__ . '/logs/error.log', \Monolog\Logger::ERROR));

		return $logger;
	}

	public function fillGoal($goal)
	{
		$goal = parent::fillGoal($goal);

		if (isset(PleesherExtension::$goal_data[$goal->code]->professions))
		{
			$goal->professions = array_filter(LiquiGoals::$professions, function($profession_key) use($goal) {
				return in_array($profession_key, PleesherExtension::$goal_data[$goal->code]->professions);
			}, ARRAY_FILTER_USE_KEY);
		}
		else
			$goal->professions = [];

		return $goal;
	}

	public function getUserPageData(User $user)
	{
		$user_professions = array_map(function($user_profession) use($user) {
			$user_profession->level = LiquiGoals::getUserLevelForProfession($user, $user_profession->key);
			$user_profession->kudos = LiquiGoals::getUserKudosForProfession($user, $user_profession->key);
			$user_profession->kudos_needed_for_next_level = isset($user_profession->levels_kudos[$user_profession->level])
				? $user_profession->levels_kudos[$user_profession->level]
				: $user_profession->kudos;
			return $user_profession;
		}, LiquiGoals::$professions);

		$user_professions = array_filter($user_professions, function($user_profession) {
			return $user_profession->level > 0;
		});

		return array_merge(parent::getUserPageData($user), [
			'user_professions' => $user_professions
		]);
	}

	public function getViewsFolder()
	{
		return __DIR__ . '/view';
	}
}
