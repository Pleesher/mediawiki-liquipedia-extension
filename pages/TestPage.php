<?php
class LiquiGoals_TestPage extends SpecialPage
{
	public function __construct()
	{
		parent::__construct('Test');
	}

	public function execute($subPage)
	{
		$user = $this->getUser();
		$user_id = $user->getId();

		echo (new LiquiGoals_QueryHelper(PleesherExtension::$pdo))->getUserEditCount($user_id, ['namespace' => [NS_MAIN, NS_TEMPLATE, NS_USER]]);
		echo (new LiquiGoals_QueryHelper(PleesherExtension::$pdo))->getUserEditCount($user_id, ['namespace' => [NS_MAIN, NS_TEMPLATE, NS_USER]]);
		echo (new LiquiGoals_QueryHelper(PleesherExtension::$pdo))->getUserEditCount($user_id, ['namespace' => [NS_MAIN, NS_TEMPLATE, NS_USER]]);

		die;

	}
}