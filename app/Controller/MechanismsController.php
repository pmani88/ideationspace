<?php
App::uses ( 'AppController', 'Controller' );
/**
 * Mechanisms Controller
 *
 * @property Mechanism $Mechanism
 */
class MechanismsController extends AppController {
	var $components = array ('Filter.Filter');
	
	var $filters = array (
			'find' => array (
					'Mechanism' => array (
							'Mechanism.Name' => array (
									'condition' => 'like', 
									'label' => 'Find Mechanisms by Keyword'
							),
							'Mechanism.NAME' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.NAME ASC'
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Find Mechanisms by Name',
									'filterField' => 'Mechanism.NAME'
							),
							'Mechanism.GROUP' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.GROUP ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Find Mechanisms by Group',
									'filterField' => 'Mechanism.GROUP'
							),
							'Mechanism.MCI' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.MCI ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Find Mechanisms by Machine Components Involved',
									'filterField' => 'Mechanism.MCI'
							),
							'Mechanism.Function' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.Function ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Find Mechanisms by Function',
									'filterField' => 'Mechanism.Function'
							)
					)
					 
			),
			'select' => array (
					'Mechanism' => array (
							'Mechanism.IPTYPE' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.IPTYPE ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Input Type',
									'filterField' => 'Mechanism.IPTYPE',
							),
							'Mechanism.OPTYPE' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.OPTYPE ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Output Type',
									'filterField' => 'Mechanism.OPTYPE'
							),
							'Mechanism.IPSPEED' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.IPSPEED ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Input Speed',
									'filterField' => 'Mechanism.IPSPEED'
							),
							'Mechanism.OPSPEED' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.OPSPEED ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Output Speed',
									'filterField' => 'Mechanism.OPSPEED'
							),
							'Mechanism.IPVELOCITYDIRECTION' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.IPVELOCITYDIRECTION ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Input Velocity Direction',
									'filterField' => 'Mechanism.IPVELOCITYDIRECTION'
							),
							'Mechanism.OPVELOCITYDIRECTION' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.OPVELOCITYDIRECTION ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Output Velocity Direction',
									'filterField' => 'Mechanism.OPVELOCITYDIRECTION'
							),
							'Mechanism.REVERSIBILITY' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.REVERSIBILITY ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Reversibility',
									'filterField' => 'Mechanism.REVERSIBILITY'
							),
							'Mechanism.RELBETWNIPAX' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.RELBETWNIPAX ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Relation Between Input and Output Line of Motion',
									'filterField' => 'Mechanism.RELBETWNIPAX'
							),
							'Mechanism.Dimension' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.Dimension ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Dimension',
									'filterField' => 'Mechanism.Dimension'
							),
							'Mechanism.DOF' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.DOF ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Mechanisms by Degree of Freedom',
									'filterField' => 'Mechanism.DOF'
							),
					)
			) 
	);
	
	public function isAuthorized($user){
		if(in_array($this->action, array('find','select'))){
			return true;
		}

		// The owner of a session can access the necessary actions
		if (in_array($this->action, array('edit', 'delete', 'add_solution', 'add', 'view'))) {
			$sessionId = $this->request->params['pass'][0];
			$this->loadModel('UserSession');
			if ($this->UserSession->isOwnedBy($sessionId, $user['id'])) {
					return true;
			}
		}
		
		return parent::isAuthorized($user);
	}
	
	/**
	 * find method
	 *
	 * @return void
	 */
	public function find($session, $pid=null) {
		$this->Mechanism->recursive = 0;
		$this->set ( 'mechanisms', $this->paginate() );
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $session);
		}
	}
	
	public function select($session, $pid=null) {
		$this->Mechanism->recursive = 0;
		$this->set ( 'mechanisms', $this->paginate() );
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $session);
		}
	}
	
	/**
	 * view method
	 *
	 * @param string $id        	
	 * @return void
	 */
	public function view($id = null) {
		$this->Mechanism->id = $id;
		if (! $this->Mechanism->exists ()) {
			throw new NotFoundException ( __ ( 'Invalid mechanism' ) );
		}
		$this->set ( 'mechanism', $this->Mechanism->read ( null, $id ) );
	}
	
	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is ( 'post' )) {
			$this->Mechanism->create ();
			if ($this->Mechanism->save ( $this->request->data )) {
				$this->Session->setFlash ( __ ( 'The mechanism has been saved' ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'The mechanism could not be saved. Please, try again.' ) );
			}
		}
	}
	
	/**
	 * edit method
	 *
	 * @param string $id        	
	 * @return void
	 */
	public function edit($id = null) {
		$this->Mechanism->id = $id;
		if (! $this->Mechanism->exists ()) {
			throw new NotFoundException ( __ ( 'Invalid mechanism' ) );
		}
		if ($this->request->is ( 'post' ) || $this->request->is ( 'put' )) {
			if ($this->Mechanism->save ( $this->request->data )) {
				$this->Session->setFlash ( __ ( 'The mechanism has been saved' ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'The mechanism could not be saved. Please, try again.' ) );
			}
		} else {
			$this->request->data = $this->Mechanism->read ( null, $id );
		}
	}
	
	/**
	 * delete method
	 *
	 * @param string $id        	
	 * @return void
	 */
	public function delete($id = null) {
		if (! $this->request->is ( 'post' )) {
			throw new MethodNotAllowedException ();
		}
		$this->Mechanism->id = $id;
		if (! $this->Mechanism->exists ()) {
			throw new NotFoundException ( __ ( 'Invalid mechanism' ) );
		}
		if ($this->Mechanism->delete ()) {
			$this->Session->setFlash ( __ ( 'Mechanism deleted' ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Mechanism was not deleted' ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
}
