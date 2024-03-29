<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * This is a placeholder class.
 * Create the same file in app/Controller/AppController.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       Cake.Controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
	public $helpers = array('Html','Form','Session','Js');
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'applications', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
    		'authorize' => array('Controller')
        )
    );
    
    public function isAuthorized($user = null) {
    	// Admin can access every action
	    if (isset($user['role']) && $user['role'] === 'admin') {
	        return true;
	    }
	    // Default deny
	    $this->Session->setflash('Sorry, you\'re not permitted to view that page' );
	    	  
	    return false;
    }

    function beforeFilter() {
        $this->Auth->allow('display');
    }
    
    function getsessiondata() {
    	//a helper function to check for information in the session
    	//if there is none then sensible default is added
    	//session data is returned in $data
    		
    		
    	if ($this->Session->check('Filter.Years') == false) {
    		//debug('Filter.years not set');
    		$sql = 'SELECT DISTINCT (`Application`.`Year`) AS lhyear ';
    		$sql = $sql . 'FROM `reg_helpers_application` AS `Application` ';
    		$sql = $sql . 'WHERE `Application`.`Year` > 2000 ';
    		$sql = $sql . 'ORDER BY `Application`.`Year` DESC ';
    
    		$lhyearsobj = $this->Application->query($sql);
    
    		foreach ($lhyearsobj as $lhyearobj):
    		$lhyears[$lhyearobj['Application']['lhyear']] = $lhyearobj['Application']['lhyear'];
    		//debug($lhyearobj['Application']['lhyear']);
    		endforeach;
    		$this->Session->write('Filter.Years', $lhyears);
    		//print_r($lhyearsobj);
    		$this->Session->write('Filter.Year', $lhyearsobj[0]['Application']['lhyear']);
    		//debug('Years in session ');
    		//print_r($lhyears);
    	}
    	else {
    		//debug('Filter.years is setxxx');
    	}
    	
    	//print_r($this->Session->read('Filter.Years'));
    	//print_r($this->Session->read('Filter.Year'));
    
    
    	if ($this->Session->check('Filter.Year')) {
    		$lhyear = $this->Session->read('Filter.Year');
    		//debug('Year in session '.$lhyear);
    	}
    	else {
    		$lhyearsobj = $this->Session->read('Filter.Years');
    
    		$lhyear = $lhyearsobj[0]['Application']['lhyear'];
    		//debug('No Year in session');
    		$this->Session->write('Filter.Year', $lhyear);
    	}

    	if ($this->Session->check('Filter.Problem')) {
    		$applicationProblem = $this->Session->read('Filter.Problem');
    		//debug('Year in session '.$lhyear);
    	}
    	else {
    		$applicationProblem = '0';
    		$this->Session->write('Filter.Problem', $applicationProblem);
    	}

    	$data = array('lhyear' => $lhyear,
        				'lhyears' => $this->Session->read('Filter.Years'),
        				'applicationProblem' => $applicationProblem
        				);
    		
    	return $data;
    }
    
    
}
