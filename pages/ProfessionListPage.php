<?php
class LiquiGoals_ProfessionListPage extends SpecialPage
{
	public function __construct()
	{
		parent::__construct('Professions');
	}

	public function execute($subPage)
	{
		$this->setHeaders();
		$this->checkPermissions();
		$this->checkReadOnly();
		$this->outputHeader();

		$html = PleesherExtension::render('professions', ['professions' => LiquiGoals::$professions]);
		$this->getOutput()->addHTML($html);
	}
}