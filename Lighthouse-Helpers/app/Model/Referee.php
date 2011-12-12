<?php
class Referee extends AppModel {
	public $useTable = 'referee';
	public $primaryKey = 'Referee_ID';
	public $displayField = 'Last_Name';

	public $hasMany = array(
			'Reference' => array(
				'className' => 'Reference',
				'foreignKey' => 'tblReferee_Referee_ID'));

}
