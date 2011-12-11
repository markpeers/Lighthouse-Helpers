<?php

class Person extends AppModel {
    public $name = 'Person';
	public $useTable = 'person';
	public $primaryKey = 'Person_ID';

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
				'foreignKey' => 'tblPerson_Person_ID'));
	
						

}

?>
