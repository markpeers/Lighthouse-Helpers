<?php

class Application extends AppModel {
    public $name = 'Application';
	public $useTable = 'application';
	public $primaryKey = 'Application_ID';

	public $belongsTo = array(
			'Person' => array(
				'className' => 'Person',
				'foreignKey' => 'tblPerson_Person_ID'));

	public $hasMany = array(
			'AssignedRole' => array(
				'className' => 'AssignedRole',
				'foreignKey' => 'tblApplication_Application_ID'),
			'OfferedRole' => array(
				'className' => 'OfferedRole',
				'foreignKey' => 'tblApplication_Application_ID'));
						

}

?>
