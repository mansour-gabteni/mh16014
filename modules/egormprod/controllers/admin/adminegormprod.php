<?php
class adminegormprodController extends ModuleAdminControllerCore
{
	
	public function renderList()
	{
		$this->initToolbar();
		$this->addRowAction('edit');
		$this->addRowAction('delete');
		return parent::renderList();
	}
	
}