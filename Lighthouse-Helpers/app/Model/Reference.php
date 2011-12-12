<?php
class Reference extends AppModel {
	public $useTable = 'reference';
	public $primaryKey = 'Reference_ID';

	public $belongsTo = array(
			'Referee' => array(
				'className' => 'Referee',
				'foreignKey' => 'tblReferee_Referee_ID'),
			'Person' => array(
				'className' => 'Person',
				'foreignKey' => 'tblPerson_Person_ID')
	);

}
