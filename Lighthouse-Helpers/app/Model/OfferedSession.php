<?php
class OfferedSession extends AppModel {
	public $name = 'OfferedSession';
	public $useTable = 'session_offered';
	public $primaryKey = 'Session_Offer_ID';

	public $belongsTo = array(
			'Session' => array(
				'className' => 'Session',
				'foreignKey' => 'tblSessions_Sessions_ID'),
			'OfferedRole' => array(
				'className' => 'OfferedRole',
				'foreignKey' => 'tblRole_Offered_Role_Assigned_ID'));



}
