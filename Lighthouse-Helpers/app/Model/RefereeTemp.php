<?php
class RefereeTemp extends AppModel {
	public $useTable = 'referee_temp';
	public $primaryKey = 'Referee_temp_ID';

	public $belongsTo = array(
			'Person' => array(
				'className' => 'Person',
				'foreignKey' => 'tblPerson_Person_ID'));
		
}
