<?php

class Person extends AppModel {
    public $name = 'Person';
	public $useTable = 'person';
	public $primaryKey = 'Person_ID';
	public $virtualFields = array('full_name' => 'CONCAT(Person.First_Name, " ", Person.Last_Name)');
	public $displayField = 'full_name';

	public $belongsTo = array(
			'Church' => array(
				'className' => 'Church',
				'foreignKey' => 'tblChurch_Church_ID'));

	public $hasMany = array(
			'Application' => array(
				'className' => 'Application',
				'foreignKey' => 'tblPerson_Person_ID'),
			'RefereeTemp' => array(
				'className' => 'RefereeTemp',
				'foreignKey' => 'tblPerson_Person_ID'),
			'Reference' => array(
				'className' => 'Reference',
				'foreignKey' => 'tblPerson_Person_ID'));

}

?>
