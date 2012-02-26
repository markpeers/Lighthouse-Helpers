<?php
class Referee extends AppModel {
	public $useTable = 'referee';
	public $primaryKey = 'Referee_ID';
	public $displayField = 'full_name';
	public $virtualFields = array('full_name' => 'CONCAT(Referee.Title, " ", Referee.First_Name, " ", Referee.Last_Name)');
	
	public $hasMany = array(
			'Reference' => array(
				'className' => 'Reference',
				'foreignKey' => 'tblReferee_Referee_ID'));

}
