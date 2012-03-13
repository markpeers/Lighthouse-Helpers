<?php
App::uses('CakeEmail', 'Network/Email');

class ApplicationsController extends AppController {
	public $uses = array('Application', 
						'Role', 
						'Church', 
						'AssignedRole', 
						'AssignedSession', 
						'Person'
						);
	public $name = 'Applications';
	
	private $crbValidYears = 5; //no of years CRB is valid
	private $crbRequiredAge = 17; //age at which a CRB is required
	private $ageAtDate = '08-31'; //when calculating age use this date (August 31)	
	private $problemFilterOptions = array('All', 'No Reference', 'No Role', 'No CRB'); //options for filter in index page

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
			'Person.Nickname',
			'Person.Last_Name'
			)
	);
	
	private function noRole($lhyear) {
		//get helpers with no role assigned
		$sql = 'SELECT `Application`.`Application_ID` ';
		$sql = $sql . 'FROM `reg_helpers_application` AS `Application` ';
		$sql = $sql . 'LEFT JOIN `reg_helpers_role_assigned` AS `AssignedRoles` ON (`AssignedRoles`.`tblApplication_Application_ID` = `Application`.`Application_ID`) ';
		$sql = $sql . 'WHERE `Application`.`year` = ' . $lhyear . ' AND `AssignedRoles`.`Role_Assigned_ID` IS NULL';
		
		$noRoleApplications = $this->Application->query($sql);

		$noRole = array();
		foreach ($noRoleApplications as $noRoleApplication) {
			array_push($noRole, $noRoleApplication['Application']['Application_ID']);
		}
		
		return $noRole;
	}
	
	private function crbAttention($lhyear) {
		//get helpers with CRB needing attention
		$sql = 'SELECT `Application`.`Application_ID` ';   
		$sql = $sql . 'FROM `reg_helpers_application` AS `Application` ';
		$sql = $sql . 'LEFT JOIN `reg_helpers_person` AS `Person` ON (`Application`.`tblPerson_Person_ID` = `Person`.`Person_ID`) ';
		$sql = $sql . 'WHERE `Application`.`year` = ' . $lhyear . ' ';
		$sql = $sql . 'AND (' . $lhyear . ' - YEAR(`Person`.`Date_of_birth`)) - ("' . $this->ageAtDate . '" < MID(`Person`.`Date_of_birth`, 6, 5)) > ' . $this->crbRequiredAge . ' ';
		$sql = $sql . 'AND (( `Application`.`CRB_date` IS NULL ) OR ( ' . $lhyear . ' - YEAR(`Application`.`CRB_date`)) - ("' . $this->ageAtDate . '" < MID(`Application`.`CRB_date`, 6, 5)) > ' . $this->crbValidYears . ') ';

		$crbApplications = $this->Application->query($sql);
		$crbAttention = array();
		foreach ($crbApplications as $crbApplication) {
			array_push($crbAttention, $crbApplication['Application']['Application_ID']);
		}
		
		return $crbAttention;
	}
	
	private function referenceAttention($lhyear) {
		//get applications without references
		//get all applications for current year and only add reference record if the reference is ok
		$applicationreferences = $this->Application->find('all', array('fields' => array('Application.Application_ID',
																						'Application.tblPerson_Person_ID',
																				        'Application.Year'
																						),
																	'contain' => array('Person' => array('fields' => array('Last_Name'),
																										'Reference' => array('fields' => array('year','Reference_OK'
																																				),
																															'conditions' => array('year' => $lhyear,
																																					'Reference_OK != ' => 0
																																					)
																															)
																										),
																						),
																	'conditions' => array('Application.year' => $lhyear
																						)
																	)
														);
		//walk through all applications and extract the application id only if there is no reference
		$referenceAttention = array();
		foreach ($applicationreferences as $applicationreference) {
			//debug($application);
			if (count($applicationreference['Person']['Reference']) == 0) {
				array_push($referenceAttention, $applicationreference['Application']['Application_ID']);
			}
		}
		return $referenceAttention;
	}

	function index() {

		//$this->Session->setflash('Flash message');

		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		$lhyears = $sessiondata['lhyears'];
		$applicationProblem = $sessiondata['applicationProblem'];
		
		
		//check to see if the filter is being changed
		if (!empty($this->request->data)) {
			//debug($this->request->data);
			$lhyear = $this->request->data['Filter']['Year'];
			//write the updated filter year to the session
			$this->Session->write('Filter.Year', $lhyear);
			$applicationProblem = $this->request->data['Filter']['ApplicationProblem'];
			$this->Session->write('Filter.Problem', $applicationProblem);
		}

		//get role counts from database - couldn't do this with cake
		$sql = 'SELECT `Role`.`Role_per_agegroup` AS `AgeGroup` ,`Role`.`RoleName` AS `RoleName`,COUNT(`Application`.`Application_ID`) AS `Qty` ';
		$sql = $sql . 'FROM `reg_helpers_role_assigned` AS `AssignedRoles` ';
		$sql = $sql . 'LEFT JOIN `reg_helpers_role` AS `Role` ON (`AssignedRoles`.`tblRole_Role_ID` = `Role`.`Role_ID`) ';
		$sql = $sql . 'LEFT JOIN `reg_helpers_application` AS `Application` ON (`AssignedRoles`.`tblApplication_Application_ID` = `Application`.`Application_ID`) ';
		$sql = $sql . 'WHERE `Application`.`Year` = ' . $lhyear . ' ';
		$sql = $sql . 'GROUP BY `Role`.`Role_per_agegroup`,`Role`.`RoleName`';

		$rolecounts = $this->Application->query($sql);
		
		//get roles and create counts		
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


		$summarys = array('TotalHelpers' => $this->Application->find('count', array('conditions' => array('Application.Year' => $lhyear))), //get total number of helpers for current year
							'NoRoleCount' => count($this->noRole($lhyear)), //get applications with no role assigned
							'CRBNeedsAttentionCount' => count($this->crbAttention($lhyear)),
							'ReferenceNeedsAttentionCount' => count($this->referenceAttention($lhyear)), //get applications without references
							'AgeGroupHeader' => $agegroupheader,
							'AgeGroupRoles' => $agegrouproles,
							'OtherRolesHeader' => $otherrolesheader,
							'OtherRoles' => $otherroles,
							'LHYears' => $sessiondata['lhyears'],
							'problemFilterOptions' => $this->problemFilterOptions);

		$this->set('summarys', $summarys);
	}

	function helperlist() {
		 
		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		$lhyears = $sessiondata['lhyears'];
		$applicationProblem = $sessiondata['applicationProblem'];
		
	 
		if (!empty($this->request->data)) {
			//debug($this->request->data);
			$lhyear = $this->request->data['Filter']['Year'];
			$this->Session->write('Filter.Year', $lhyear);
			$applicationProblem = $this->request->data['Filter']['ApplicationProblem'];
			$this->Session->write('Filter.Problem', $applicationProblem);
			}
		
		switch ($applicationProblem) {
			case 0: $conditions = array('Application.Year'=> $this->Session->read('Filter.Year')); break; //all applications
			case 1: $conditions = array('Application.Application_ID ' => $this->referenceAttention($lhyear)); break; //applications with no reference
			case 2: $conditions = array('Application.Application_ID ' => $this->noRole($lhyear)); break; //applications with no role assigned
			case 3: $conditions = array('Application.Application_ID ' => $this->crbAttention($lhyear));	break; //applications with no CRB
			default:
		}
		
		//build an array with next and previous applications for each application
		$this->Application->contain(array('Person' => array('fields' => array('First_Name','Last_Name'))));
		$filtered_applications = $this->Application->find('all', array('conditions' => $conditions,
																						'fields' => array('Application.Application_ID',
																											'Application.tblPerson_Person_ID',
																											'Application.Year'),
																						'recursive' => 1,
																						'order' => array('Person.Last_Name',
																										'Person.First_Name')));
			//for each filtered application returned, find preveious and next and add to the array
			for ($i = 0; $i < count($filtered_applications); $i++) {
				if ($i < count($filtered_applications) - 1) {
					$filtered_applications[$i]['next_application']['application_id'] = $filtered_applications[$i + 1]['Application']['Application_ID'];
					$filtered_applications[$i]['next_application']['person_id'] = $filtered_applications[$i + 1]['Application']['tblPerson_Person_ID'];
					$filtered_applications[$i]['next_application']['year'] = $filtered_applications[$i + 1]['Application']['Year'];
				} else {
					$filtered_applications[$i]['next_application'] = null;
				}
				if ($i > 0) {
					$filtered_applications[$i]['previous_application']['application_id'] = $filtered_applications[$i - 1]['Application']['Application_ID'];
					$filtered_applications[$i]['previous_application']['person_id'] = $filtered_applications[$i - 1]['Application']['tblPerson_Person_ID'];
					$filtered_applications[$i]['previous_application']['year'] = $filtered_applications[$i - 1]['Application']['Year'];
				} else {
					$filtered_applications[$i]['previous_application'] = null;
				}
			}
		//debug($filtered_applications);
		$this->Session->write('FilterdApplications', $filtered_applications);
		
		$this->paginate['conditions'] = $conditions;

		$this->set('LHYears', $lhyears);
		$this->set('problemFilterOptions', $this->problemFilterOptions);
		$this->set('applications', $this->paginate());
	}

	public function helper($application_id = null, $person_id = null, $year = null, $offset = null) {
//		if ($offset==null) {
			if ($year==null) {
				$sessiondata = $this->getsessiondata();
				$year = $sessiondata['lhyear'];
			}
			
			//write current application_id to the session
			$this->Session->write('Current.Application', $application_id);
			$this->Session->write('Current.Person', $person_id);

			//find applications before and after current application
			//this depends on the filter setting, so get list of applications matching the filter
/* 			switch ($this->Session->read('Filter.Problem')) {
				case 0: $conditions = array('Application.Year'=> $year); break; //all applications
				case 1: $conditions = array('Application.Application_ID ' => $this->referenceAttention($year)); break; //applications with no reference
				case 2: $conditions = array('Application.Application_ID ' => $this->noRole($year)); break; //applications with no role assigned
				case 3: $conditions = array('Application.Application_ID ' => $this->crbAttention($year));	break; //applications with no CRB
				default:
			}
 */			//			debug($conditions);
			//also need helpers name so that the application before and after can be in alphabeticalorder 
/* 			$this->Application->contain(array('Person' => array('fields' => array('First_Name',
																								'Last_Name'))));
			$applications = $this->Application->find('all', array('conditions' => $conditions,
																				'fields' => array('Application.Application_ID',
																									'Application.tblPerson_Person_ID',
																									'Application.Year'),
																				'recursive' => 1,
																				'order' => array('Person.Last_Name',
																								'Person.First_Name')));
 */			//			debug($applications);
/* 			$next_application = null;
			$previous_application = null;
			for ($i = 0; $i < count($applications); $i++) {
				if ($applications[$i]['Application']['Application_ID'] == $application_id) {
					//debug($i);
					if ($i < count($applications) - 1) {
						$next_application['application_id'] = $applications[$i + 1]['Application']['Application_ID'];
 						$next_application['person_id'] = $applications[$i + 1]['Application']['tblPerson_Person_ID'];
						$next_application['year'] = $applications[$i + 1]['Application']['Year'];
					}
					if ($i > 0) {
						$previous_application['application_id'] = $applications[$i - 1]['Application']['Application_ID'];
						$previous_application['person_id'] = $applications[$i - 1]['Application']['tblPerson_Person_ID'];
						$previous_application['year'] = $applications[$i - 1]['Application']['Year'];
					}
					break;
				}
			}
 */	
			foreach ($this->Session->read('FilterdApplications') as $filteredapplication) :
				if ($filteredapplication['Application']['Application_ID'] == $application_id) {
					$next_application = $filteredapplication['next_application'];
					$previous_application = $filteredapplication['previous_application'];
					break;
					}
			endforeach;
					
			$this->set('next_application', $next_application);
			$this->set('previous_application', $previous_application);
			
			//			debug($next_application);
					
			//debug('Test');
			$lastyear = $year - 1;
			//define what associated data is required from other tables
			$this->Application->contain(array('Person',
											'Person.Church',
											'Person.RefereeTemp' => array('conditions' => array('RefereeTemp.Year = ' => $year)),
											'Person.Reference.Referee',
											'Person.Reference' => array('conditions' => array('Reference.Year ' => array($year, $year - 1)),
																		'order' => array('Reference.Year DESC')),
											'OfferedRole',
											'OfferedRole.Role',
											'OfferedRole.OfferedSession',
											'OfferedRole.OfferedSession.Session',
											'AssignedRole',
											'AssignedRole.Role',
											'AssignedRole.AssignedSession',
											'AssignedRole.AssignedSession.Session'));
			//get the application record and all associated data
			$application = $this->Application->find('first',
	 				array('conditions' => array('Application.Application_ID' => $application_id )));
			
			//get crb data from application records from previous years for this helper
			$crbs = $this->Application->find('all', 
					array('conditions' => array('Application.tblPerson_Person_ID' => $person_id,
												'Application.Year < ' => $year
												),
							'fields' => array(	'Application.Application_ID', 
												'Application.Year', 
												'Application.CRB',
												'Application.CRB_date',
												'Application.CRB_note',
												'Application.CRB_number'
												),
							'order' => array('Application.Year DESC'
												),
							'recursive' => 0));
			
			$this->set('crbs', $crbs);
			$this->set('data', $application);
/* 		} else { //$offset is set so find next or previous application and call helper again with new application
			//find applications that mtch the curent filter and get application ID and person id
			switch ($this->Session->read('Filter.Problem')) {
				case 0: $conditions = array('Application.Year'=> $year); break; //all applications
				case 1: $conditions = array('Application.Application_ID ' => $this->referenceAttention($year)); break; //applications with no reference
				case 2: $conditions = array('Application.Application_ID ' => $this->noRole($year)); break; //applications with no role assigned
				case 3: $conditions = array('Application.Application_ID ' => $this->crbAttention($year));	break; //applications with no CRB
				default:
			}
//			debug($conditions);
			$this->Application->contain(array('Person' => array('fields' => array('First_Name',
																					'Last_Name'))));
			$applications = $this->Application->find('all', array('conditions' => $conditions,
																	'fields' => array('Application.Application_ID',
																						'Application.tblPerson_Person_ID',
																						'Application.Year'),
																	'recursive' => 1,
																	'order' => array('Person.Last_Name',
																					'Person.First_Name')));
//			debug($applications);
			for ($i = 0; $i < count($applications); $i++) {
				if ($applications[$i]['Application']['Application_ID'] == $application_id) {
					$next_application['application_id'] = $applications[$i + $offset]['Application']['Application_ID'];
					$next_application['person_id'] = $applications[$i + $offset]['Application']['tblPerson_Person_ID'];
					$next_application['year'] = $applications[$i + $offset]['Application']['Year'];
					break;
				}
			}
//			debug($next_application);
			$this->redirect(array('controller' => 'applications',
									'action' => 'helper',
									$next_application['application_id'],
									$next_application['person_id'],
									$next_application['year']));
		}
 */	}
	
    
	public function editnotes($application_id = null) {
		$this->Application->id = $application_id;
		
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid reference'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//debug($this->request->data);
			//$this->log($this->request->data, 'debug');
			if ($this->Application->save($this->request->data)) {
				$this->Session->setFlash(__('The application notes have been updated'));
				$this->redirect(array('controller' => 'applications',
												'action' => 'helper',
												$this->Session->read('Current.Application'),
												$this->Session->read('Current.Person'),
												$this->Session->read('Filter.Year')));
			} else {
				$this->Session->setFlash(__('The application notes could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Application->read(null, $application_id);
		}
	}
    
	public function editcrb($application_id = null) {
		$this->Application->id = $application_id;
		
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid reference'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//debug($this->request);
			if ($this->Application->save($this->request->data)) {
				$this->Session->setFlash(__('The application CRB details have been updated'));
				$this->redirect(array('controller' => 'applications',
												'action' => 'helper',
												$this->Session->read('Current.Application'),
												$this->Session->read('Current.Person'),
												$this->Session->read('Filter.Year')));
			} else {
				$this->Session->setFlash(__('The application CRB details could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Application->read(null, $application_id);
		}
		
		$this->set('crbValidYears', $this->crbValidYears);
	}
	
	/**
	* copycrb method
	*
	* copys the crb fields from previous year's application to current application
	* then returns to calling page
	* 
	* @param string $to_id, string $from_id
	* @return void
	*/
	public function copycrb($to_id = null, $from_id = null) {
		$this->Application->id = $from_id;
		//check old application exists
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid reference'));
		}
		$crbfields =  array('Application.CRB',
							'Application.CRB_date',
							'Application.CRB_note',
							'Application.CRB_number');
		//get crb fields from old application
 		$oldapplication = $this->Application->find('first', array('conditions' => array('Application.Application_ID' => $from_id),
 																	'fields' => $crbfields,
 																	'recursive' => 0));
		//debug($oldapplication);
		
		$this->Application->id = $to_id;
		//check current application exists
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid reference'));
		}
		//copy crb from old record to current application
		$this->Application->set(array('CRB' => $oldapplication['Application']['CRB'],
										'CRB_date' => $oldapplication['Application']['CRB_date'],
										'CRB_note' => $oldapplication['Application']['CRB_note'],
										'CRB_number' => $oldapplication['Application']['CRB_number']));
		if ($this->Application->save()) {
			$this->Session->setFlash(__('The application CRB details have been copied'));
		} else {
			$this->Session->setFlash(__('The application CRB details could not be saved. Please, try again.'));
		}
		//go back to calling page
		$this->redirect($this->referer());
	}

	/**
	* delete method
	*
	* @param string $id
	* @return void
	*/
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Application->id = $id;
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid Application'));
		}
		if ($this->Application->delete()) {
			$this->Session->setFlash(__('Application deleted'));
			//go back to helper list page
			$this->redirect(array('action' => 'helperlist'));
		}
		$this->Session->setFlash(__('Application was not deleted'));
		$this->redirect($this->referer());
	}
	
	
	public function test($id = null) {
		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		
			}
	
	 
	function clearsession() {
		$this->Session->delete('Filter');
		$this->redirect(array('controller' => 'applications', 'action' => 'index'));
	}
}