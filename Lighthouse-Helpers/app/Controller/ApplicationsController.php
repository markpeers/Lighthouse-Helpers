<?php
class ApplicationsController extends AppController {
	public $uses = array('Application', 'Role', 'Church', 'AssignedRole', 'AssignedSession', 'Person');
	public $name = 'Applications';

	public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Person.Last_Name' => 'asc',
			'Person.First_Name' => 'asc'
	),
		'fields' => array(
			'Application.Application_ID',
			'Application.Year',
			'Person.Person_ID',
			'Person.Title',
			'Person.First_Name',
			'Person.Last_Name'
	)
	);


	function index() {

		//		$this->Session->setflash('Flash message');

		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		$lhyears = $sessiondata['lhyears'];

		//check to see if the filter is being changed
		if (!empty($this->request->data)) {
			$lhyear = $this->request->data['Filter']['Year'];
			//write the updated filter year to the session
			$this->Session->write('Filter.Year', $lhyear);
		}

		//get role counts from database - couldn't do this with cake
		$sql = 'SELECT `Role`.`Role_per_agegroup` AS `AgeGroup` ,`Role`.`RoleName` AS `RoleName`,COUNT(`Application`.`Application_ID`) AS `Qty` ';
		$sql = $sql . 'FROM `reg_helpers_role_assigned` AS `AssignedRoles` ';
		$sql = $sql . 'LEFT JOIN `reg_helpers_role` AS `Role` ON (`AssignedRoles`.`tblRole_Role_ID` = `Role`.`Role_ID`) ';
		$sql = $sql . 'LEFT JOIN `reg_helpers_application` AS `Application` ON (`AssignedRoles`.`tblApplication_Application_ID` = `Application`.`Application_ID`) ';
		$sql = $sql . 'WHERE `Application`.`Year` = ' . $lhyear . ' ';
		$sql = $sql . 'GROUP BY `Role`.`Role_per_agegroup`,`Role`.`RoleName`';

		$rolecounts = $this->Application->query($sql);

		//get total number of helpers for current year
		$totalHelpers = $this->Application->find('count', array('conditions' => array('Application.Year' => $lhyear)));

		$rolearray = array();
		// arrays are toddler, 4s, 5s, 6s, 7s, 8s, 9s, 10+, 12
		$agegroupheader = array('Role', 'Toddlers', '4s', '5s', '6s', '7s', '8s', '9s', '10+', '12s');
		$lhk = array('Lighthouse Keeper',0,0,0,0,0,0,0,0,0);
		$ll = array('Lamp Lighter','-','-',0,0,0,0,0,'-','-');
		$agl = array('Agegroup Leader',0,0,0,0,0,0,0,0,0);
		$teacher = array('Teacher',0,0,0,0,0,0,0,0,0);
		$special = array('Special Needs',0,0,0,0,0,0,0,0,0);
		$otherrolesheader = array('Role', 'Leader', 'Helpers');
		$craft = array('Craft - 5\'s to 9\'s',0,0);
		$craft4 = array('Craft - 4\'s',0,0);
		$craft10 = array('Craft - 10+',0,0);
		$craftprep = array('Craft Preparation','-',0);
		$admin = array('Administration',0,0);
		$carpark = array('Car Park',0,0);
		$chairman = array('Chairman','-',0);
		$comforts = array('Comforts Tent',0,0);
		$drama = array('Drama',0,0);
		$evenbbq = array('Evening Events - BBQ','-',0);
		$evengen = array('Evening Events - General',0,0);
		$evenactivity = array('Evening Events - Teenage Activities','-',0);
		$eventuck = array('Evening Events - Tuck Shop','-',0);
		$firstaid = array('First Aid',0,0);
		$helperchildren = array('Helper\'s Children',0,0);
		$lifeboat = array('Lifeboat Tent',0,0);
		$cafe = array('Lighthouse Cafe',0,0);
		$mainstage = array('Main Stage',0,0);
		$music = array('Music',0,0);
		$pastoral = array('Pastoral Care','-',0);
		$photo = array('Photographer','-',0);
		$quiettent = array('Quiet Tent',0,0);
		$registrations = array('Registrations',0,0);
		$sales = array('Sales',0,'-');
		$saturday = array('Saturday Evening Event',0,0);
		$security = array('Security',0,0);
		$siteup = array('Setting Up Site','-',0);
		$site = array('Site','-',0);
		$sitedown = array('Site Breakdown','-',0);
		$siteman = array('Site Manager','-',0);
		$sport = array('Sports',0,0);
		$tech = array('Tech Support','-',0);
		$toysale = array('Toy Sale','-',0);
		$treasurer = array('Treasurer','-',0);
		$vicechair = array('Vice Chair','-',0);
		$water = array('Water Tent',0,0);

		foreach($rolecounts as $role):
		//array_push($rolearray, $role['Role']['RoleName']);
		switch ($role['Role']['RoleName'])
		{
			case 'Toddler Helper': $lhk[1] = $role[0]['Qty']; break;
			case 'Lighthouse Keeper - 4\'s': $lhk[2] = $role[0]['Qty']; break;
			case 'Lighthouse Keeper - 5\'s': $lhk[3] = $role[0]['Qty']; break;
			case 'Lighthouse Keeper - 6\'s': $lhk[4] = $role[0]['Qty']; break;
			case 'Lighthouse Keeper - 7\'s': $lhk[5] = $role[0]['Qty']; break;
			case 'Lighthouse Keeper - 8\'s': $lhk[6] = $role[0]['Qty']; break;
			case 'Lighthouse Keeper - 9\'s': $lhk[7] = $role[0]['Qty']; break;
			case 'Lighthouse Keeper - 10+\'s': $lhk[8] = $role[0]['Qty']; break;
			case 'Lighthouse Keeper - 12s': $lhk[9] = $role[0]['Qty']; break;
			case 'Lamplighter - 5\'s': $ll[3] = $role[0]['Qty']; break;
			case 'Lamplighter - 6\'s': $ll[4] = $role[0]['Qty']; break;
			case 'Lamplighter - 7\'s': $ll[5] = $role[0]['Qty']; break;
			case 'Lamplighter - 8\'s': $ll[6] = $role[0]['Qty']; break;
			case 'Lamplighter - 9\'s': $ll[7] = $role[0]['Qty']; break;
			case 'AGL - Toddlers': $agl[1] = $role[0]['Qty']; break;
			case 'AGL - 4s': $agl[2] = $role[0]['Qty']; break;
			case 'AGL - 5s': $agl[3] = $role[0]['Qty']; break;
			case 'AGL - 6s': $agl[4] = $role[0]['Qty']; break;
			case 'AGL - 7s': $agl[5] = $role[0]['Qty']; break;
			case 'AGL - 8s': $agl[6] = $role[0]['Qty']; break;
			case 'AGL - 9s': $agl[7] = $role[0]['Qty']; break;
			case 'AGL - 10+s': $agl[8] = $role[0]['Qty']; break;
			case 'AGL - 12s': $agl[9] = $role[0]['Qty']; break;
			case 'Teacher - Toddlers': $teacher[1] = $role[0]['Qty']; break;
			case 'Teacher - 4s': $teacher[2] = $role[0]['Qty']; break;
			case 'Teacher - 5s': $teacher[3] = $role[0]['Qty']; break;
			case 'Teacher - 6s': $teacher[4] = $role[0]['Qty']; break;
			case 'Teacher - 7s': $teacher[5] = $role[0]['Qty']; break;
			case 'Teacher - 8s': $teacher[6] = $role[0]['Qty']; break;
			case 'Teacher - 9s': $teacher[7] = $role[0]['Qty']; break;
			case 'Teacher - 10+s': $teacher[8] = $role[0]['Qty']; break;
			case 'Teacher - 12s': $teacher[9] = $role[0]['Qty']; break;
			case 'Special Needs - Toddlers': $special[1] = $role[0]['Qty']; break;
			case 'Special Needs - 4s': $special[2] = $role[0]['Qty']; break;
			case 'Special Needs - 5s': $special[3] = $role[0]['Qty']; break;
			case 'Special Needs - 6s': $special[4] = $role[0]['Qty']; break;
			case 'Special Needs - 7s': $special[5] = $role[0]['Qty']; break;
			case 'Special Needs - 8s': $special[6] = $role[0]['Qty']; break;
			case 'Special Needs - 9s': $special[7] = $role[0]['Qty']; break;
			case 'Special Needs - 10+s': $special[8] = $role[0]['Qty']; break;
			case 'Special Needs - 12s': $special[9] = $role[0]['Qty']; break;
			case 'Craft - 5s to 9s - Leader': $craft[1] = $role[0]['Qty']; break;
			case 'Craft - 5s to 9s': $craft[2] = $role[0]['Qty']; break;
			case 'Craft - 4s - Leader': $craft4[1] = $role[0]['Qty']; break;
			case 'Craft - 4s': $craft4[2] = $role[0]['Qty']; break;
			case 'Craft - 10+s - Leader': $craft10[1] = $role[0]['Qty']; break;
			case 'Craft - 10+s': $craft10[2] = $role[0]['Qty']; break;
			case 'Craft Preparation': $craftprep[2] = $role[0]['Qty']; break;
			case 'Administration - Leader': $admin[1] = $role[0]['Qty']; break;
			case 'Administration': $admin[2] = $role[0]['Qty']; break;
			case 'Car Park - Leader': $carpark[1] = $role[0]['Qty']; break;
			case 'Car Park': $carpark[2] = $role[0]['Qty']; break;
			case 'Chairman': $chairman[2] = $role[0]['Qty']; break;
			case 'Comforts Tent - Leader': $comforts[1] = $role[0]['Qty']; break;
			case 'Comforts Tent': $comforts[2] = $role[0]['Qty']; break;
			case 'Drama - Leader': $drama[1] = $role[0]['Qty']; break;
			case 'Drama': $drama[2] = $role[0]['Qty']; break;
			case 'Evening Events - BBQ': $evenbbq[2] = $role[0]['Qty']; break;
			case 'Evening Events - General': $evengen[2] = $role[0]['Qty']; break;
			case 'Evening Events - Teenage Activities': $evenactivity[2] = $role[0]['Qty']; break;
			case 'Evening Events - Tuck Shop': $eventuck[2] = $role[0]['Qty']; break;
			case 'Evenings - Leader': $evengen[1] = $role[0]['Qty']; break;
			case 'First Aid': $firstaid[2] = $role[0]['Qty']; break;
			case 'First Aid - Leader': $firstaid[1] = $role[0]['Qty']; break;
			case 'Helper\'s Children': $helperchildren[2] = $role[0]['Qty']; break;
			case 'Helper\'s Children - Leader': $helperchildren[1] = $role[0]['Qty']; break;
			case 'Lifeboat Tent': $lifeboat[2] = $role[0]['Qty']; break;
			case 'Lifeboat Tent - Leader': $lifeboat[1] = $role[0]['Qty']; break;
			case 'Lighthouse Cafe': $cafe[2] = $role[0]['Qty']; break;
			case 'Lighthouse Cafe - Leader': $cafe[1] = $role[0]['Qty']; break;
			case 'Main Stage': $mainstage[2] = $role[0]['Qty']; break;
			case 'Main Stage - Leader': $mainstage[1] = $role[0]['Qty']; break;
			case 'Music': $music[2] = $role[0]['Qty']; break;
			case 'Music - Leader': $music[1] = $role[0]['Qty']; break;
			case 'Pastoral Care': $pastoral[2] = $role[0]['Qty']; break;
			case 'Photographer': $photo[2] = $role[0]['Qty']; break;
			case 'Quiet Tent': $quiettent[2] = $role[0]['Qty']; break;
			case 'Quiet Tent - Leader': $quiettent[1] = $role[0]['Qty']; break;
			case 'Registrations': $registrations[2] = $role[0]['Qty']; break;
			case 'Registrations - Leader': $registrations[1] = $role[0]['Qty']; break;
			case 'Sales': $sales[2] = $role[0]['Qty']; break;
			case 'Sales - Leader': $sales[1] = $role[0]['Qty']; break;
			case 'Saturday Evening Event': $saturday[2] = $role[0]['Qty']; break;
			case 'Saturday Evening Event - Leader': $saturday[1] = $role[0]['Qty']; break;
			case 'Security': $security[2] = $role[0]['Qty']; break;
			case 'Security - Leader': $security[1] = $role[0]['Qty']; break;
			case 'Setting Up Site': $siteup[2] = $role[0]['Qty']; break;
			case 'Site': $site[2] = $role[0]['Qty']; break;
			case 'Site Breakdown': $sitedown[2] = $role[0]['Qty']; break;
			case 'Site Manager': $siteman[2] = $role[0]['Qty']; break;
			case 'Sports': $sport[2] = $role[0]['Qty']; break;
			case 'Sports - Leader': $sport[1] = $role[0]['Qty']; break;
			case 'Tech Support': $tech[2] = $role[0]['Qty']; break;
			case 'Toy Sale': $toysale[2] = $role[0]['Qty']; break;
			case 'Treasurer': $treasurer[2] = $role[0]['Qty']; break;
			case 'Vice Chair': $vicechair[2] = $role[0]['Qty']; break;
			case 'Water Tent': $water[2] = $role[0]['Qty']; break;
			case 'Water Tent - Leader': $water[1] = $role[0]['Qty']; break;
			default:
			 // code to be executed if n is different from both label1 and label2;
		}
		endforeach;
		//$rolecounts = array_count_values($rolearray);
		//		print_r($rolecounts);
		$agegrouproles = array($lhk,$ll,$agl,$teacher,$special);
		$otherroles = array($admin,$carpark,$chairman,$comforts,$craft4,$craft,$craft10,$craftprep,
		$drama,$evenbbq,$evengen,$evenactivity,$eventuck,$firstaid,$helperchildren,
		$lifeboat,$cafe,$mainstage,$music,$pastoral,$photo,$quiettent,$registrations,
		$sales,$saturday,$security,$siteup,$site,$sitedown,$siteman,$sport,$tech,
		$toysale,$treasurer,$vicechair,$water);


		$summarys = array('TotalHelpers' => $totalHelpers,
							'AgeGroupHeader' => $agegroupheader,
							'AgeGroupRoles' => $agegrouproles,
							'OtherRolesHeader' => $otherrolesheader,
							'OtherRoles' => $otherroles,
							'LHYears' => $sessiondata['lhyears']);

		$this->set('summarys', $summarys);
	}

	function helperlist() {
		 
		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		$lhyears = $sessiondata['lhyears'];
		 
		if (!empty($this->request->data)) {
			$lhyear = $this->request->data['Filter']['Year'];
			$this->Session->write('Filter.Year', $lhyear);
		}
		$this->paginate['conditions'] = array(
    		'Application.Year'=> $this->Session->read('Filter.Year')
		);

		$this->set('LHYears', $lhyears);
		$this->set('applications', $this->paginate());
	}

	public function helper($application_id = null, $person_id = null, $year = null) {
		//debug('Test');
		if ($this->request->is('ajax')) {
			//debug($this->request);
			$tab = $this->request->params['pass']['2'];
			switch ($tab) {
				case 'ajaxtest':
					$data = array('tab' => $tab);
					break;

				case 'ajaxconfidential':
					$data = $this->Application->find('first',
					array('fields' => array('Application.Conviction',
											'Application.Caution',
											'Application.Court',
											'Application.Conduct',
											'Application.Childprotection',
											'Application.Healthproblems',
											'Application.Othername',
											'Application.Otheraddress',
											'Application.Conviction_details',
											'Application.Caution_details',
											'Application.Court_details',
											'Application.Conduct_details',
											'Application.Childprotection_details',
											'Application.Healthproblems_details',
											'Application.Othername_details',
											'Application.Otheraddress_details'),
						'conditions' => array('Application.Application_ID' => $application_id)
					));
					break;

				case 'ajaxconfirmation':
					$data = $this->Application->find('first',
					array('fields' => array('Application.Confirmation_email_sent',
											'Application.Confirmation_email_date'),
						'conditions' => array('Application.Application_ID' => $application_id)
					));
					break;

				case 'ajaxnotes':
					$data = $this->Application->find('first',
					array('fields' => array('Application.Notes'),
						'conditions' => array('Application.Application_ID' => $application_id)
					));
					break;

				case 'ajaxemergencycontact':
					$data = $this->Application->find('first',
					array('fields' => array('Application.Emergency_contact',
											'Application.Emergency_phone1',
											'Application.Emergency_phone2',
											'Application.Emergency_relationship'),
						'conditions' => array('Application.Application_ID' => $application_id)
					));
					break;

				case 'ajaxlhaddress':
					$data = $this->Application->find('first',
					array('fields' => array('Application.LH_Address_1',
											'Application.LH_Address_2',
											'Application.LH_Town',
											'Application.LH_County',
											'Application.LH_Post_Code',
											'Application.LH_Telephone'),
						'conditions' => array('Application.Application_ID' => $application_id)
					));
					break;

				case 'ajaxcrb':
					$data = $this->Application->find('first',
					array('fields' => array('Application.CRB',
											'Application.CRB_type',
											'Application.CRB_date',
											'Application.CRB_number',
											'Application.CRB_note'),
						'conditions' => array('Application.Application_ID' => $application_id)
					));
					break;

				case 'ajaxdeclaration':
					$data = $this->Application->find('first',
					array('fields' => array('Application.Parental_consent',
											'Application.Declaration_signed',
											'Application.Signature'),
						'conditions' => array('Application.Application_ID' => $application_id)
					));
					break;

				case 'ajaxhealth':
					$data = $this->Application->find('first',
					array('fields' => array('Application.Medical',
											'Application.Medical_note'),
						'conditions' => array('Application.Application_ID' => $application_id)
					));
					break;

				case 'ajaxexperience':
					$data = $this->Application->find('first',
					array('fields' => array('Application.Previous_experience',
											'Application.Experience_notes',
											'Application.Special_needs',
											'Application.Language',
											'Application.First_aid_cert',
											'Application.Helped_before'),
						'conditions' => array('Application.Application_ID' => $application_id)
					));
					break;

				case 'ajaxroleassigned';
				$this->Application->contain(array('AssignedRole',
													'AssignedRole.Role',
													'AssignedRole.AssignedSession',
													'AssignedRole.AssignedSession.Session'));
				$data = $this->Application->find('first',
					array('fields' => array('Application.Application_ID'),
						'conditions' => array('Application.Application_ID' => $application_id)
				));

				break;

				case 'ajaxhelpoffered';
				$this->Application->contain(array('OfferedRole',
													'OfferedRole.Role',
													'OfferedRole.OfferedSession',
													'OfferedRole.OfferedSession.Session'));
				$data = $this->Application->find('first',
					array('fields' => array('Application.Application_ID'),
						'conditions' => array('Application.Application_ID' => $application_id)
				));
				
				break;
				
				case 'ajaxreferees';
				$this->Application->contain(array('People',
													'RefereeTemp'
													));
				$data = $this->Application->find('first',
					array('fields' => array('Application.Application_ID'),
						'conditions' => array('Application.Application_ID' => $application_id)
				));

				break;

				default:
					;
					break;
			}
				
			$this->set('data', $data);
			$this->render($tab, 'ajax');
		}
		else {
			$this->Application->contain(array('Person',
											'Person.Church',
											'Person.RefereeTemp',
											'Person.RefereeTemp.year = '.$year,
											'Person.Reference',
											'Person.Reference.Referee',
											'Person.Reference.year = '.$year,
											'OfferedRole',
											'OfferedRole.Role',
											'OfferedRole.OfferedSession',
											'OfferedRole.OfferedSession.Session',
											'AssignedRole',
											'AssignedRole.Role',
											'AssignedRole.AssignedSession',
											'AssignedRole.AssignedSession.Session'));
			$application = $this->Application->find('first',
 				array('conditions' => array('Application.tblPerson_Person_ID' => $person_id, 
											'Application.Year' => $year )
											));
			
				
			$this->set('data', $application);
//			$this->set('data', array('Application' => $application));
		}
	}

    
	public function test($id = null) {
		
		if ($this->request->is('ajax')) {
			$this->log($this->request, 'debug');
			$this->render('test', 'ajax');
			//$tab = $this->request->params;
		}else{
			print_r($this->referer());
			$this->redirect($this->referer());
		}
	}
	
	public function editnotes($id=null) {
		$this->Application->id = $id;
		$this->log($this->data,'debug');
		if ($this->request->is('ajax')) {
			$this->log($this->request, 'debug');
			switch ($this->request->query['step']) {
				case 'edit':
					$data = $this->Application->find('first',
						array('fields' => array('Application.Notes'),
							'conditions' => array('Application.Application_ID' => $id),
							'recursive' => 0
						));
					$this->set('data', $data);
					$this->render('ajaxeditnotes', 'ajax');
					break;
				case 'update':
					;
					break;
				case 'cancel':
					$data = $this->Application->find('first',
						array('fields' => array('Application.Notes'),
							'conditions' => array('Application.Application_ID' => $id),
							'recursive' => 0
						));
					$this->set('data', $data);
					$this->render('ajaxnotes', 'ajax');
					break;
							
				default:
					;
				break;
			}
		}
	}

	public function savenotes($id=null) {
		$this->Application->id = $id;
		if ($this->request->is('ajax')) {
			$this->log($this->request, 'debug');
//			$this->set('data', $data);
			$this->render('ajaxnotes', 'ajax');
		}else{
			$this->redirect($this->referer());
		}
	}
	
	
	 
	function clearsession() {
		$this->Session->delete('Filter');
		$this->redirect(array('controller' => 'applications', 'action' => 'index'));
	}
}