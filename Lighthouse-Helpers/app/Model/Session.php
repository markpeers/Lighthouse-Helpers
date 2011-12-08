<?php
class Session extends AppModel {
	public $useTable = 'sessions';
	public $primaryKey = 'Sessions_ID';
	public $displayField = 'Description';

	public $hasMany = array(
			'AssignedSession' => array(
				'className' => 'AssignedSession',
				'foreignKey' => 'tblSessions_Sessions_ID'),
			'OfferedSession' => array(
				'className' => 'OfferedSession',
				'foreignKey' => 'tblSessions_Sessions_ID'));

}
