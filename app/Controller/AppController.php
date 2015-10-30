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
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $helpers = array('Js','Html','Form','Session');
	public $uses = array('LogEntry');
	
	public $components = array(
	        'Session',
	        'Auth' => array(
				'authenticate' => array(
					'Form' => array(
						'fields' => array('username' => 'email')
					)
				),
				'authorize' => 'Controller',
	            'loginRedirect' => array('controller' => 'user_sessions', 'action' => 'index'),
	            'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
	        )
	);
	
	public function isAuthorized($user = null) {
		// admin can access every page
	    if (isset($user['admin']) && $user['admin'] == 1) {
	        return true;
	    }

        // Default deny
        return false;
    }
	
	public function beforeRender(){
		$this->set('authUser', $this->Auth->user());
	}
	
	public function log_entry($session_id, $entry){
		$this->LogEntry->create();
		$data = Array(
		        'session_id' => $session_id,
				'entry' => $entry
		    );
		$this->LogEntry->save($data);
	}

}
