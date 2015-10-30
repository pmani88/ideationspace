<?php
App::uses('AppController', 'Controller');
/**
 * Cots Controller
 *
 * @property Cot $Cot
 */
class CotsController extends AppController {

	var $components = array (
			'Filter.Filter'
	);
	
	//NAME,CATEGORY,MACHINEELEMENTCATEGORY,FUNCTION,IPTYPE,IPSPEED,IPVELOCITYDIRECTION,OPTYPE,OPSPEED,OPVELOCITYDIRECTION,RELATION,IMAGE
	
	var $filters = array (
			'find' => array (
					'Cot' => array (
							'Cot.Name' => array (
									'condition' => 'like', 
									'label' => 'Find Machine Elements by Keyword'
							),
							'Cot.NAME' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.NAME ASC'
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Find Machine Elements by Name',
									'filterField' => 'Cot.NAME'
							),
							'Cot.CATEGORY' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.CATEGORY ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Find Machine Elements by Category',
									'filterField' => 'Cot.CATEGORY'
							),
							'Cot.MACHINEELEMENTCATEGORY' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.MACHINEELEMENTCATEGORY ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Find Machine Elements by Machine Element Category',
									'filterField' => 'Cot.MACHINEELEMENTCATEGORY'
							),
							'Cot.FUNCTION' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.FUNCTION ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Find Machine Elements by Function',
									'filterField' => 'Cot.FUNCTION'
							)			
					)
			),
			'select' => array (
					'Cot' => array (
							'Cot.IPTYPE' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.IPTYPE ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Machine Elements by Type',
									'filterField' => 'Cot.IPTYPE'
							),
							'Cot.OPTYPE' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.OPTYPE ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Machine Elements by Output Type',
									'filterField' => 'Cot.OPTYPE'
							),
							'Cot.IPSPEED' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.IPSPEED ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Machine Elements by Input Speed',
									'filterField' => 'Cot.IPSPEED'
							),
							'Cot.OPSPEED' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.OPSPEED ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Machine Elements by Output Speed',
									'filterField' => 'Cot.OPSPEED'
							),
							'Cot.IPVELOCITYDIRECTION' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.IPVELOCITYDIRECTION ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Machine Elements by Input Velocity Direction',
									'filterField' => 'Cot.IPVELOCITYDIRECTION'
							),
							'Cot.OPVELOCITYDIRECTION' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.OPVELOCITYDIRECTION ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Machine Elements by Output Velocity Direction',
									'filterField' => 'Cot.OPVELOCITYDIRECTION'
							),
							'Cot.RELATION' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Cot.RELATION ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Machine Elements by Relation Between Input and Output Line of Motion',
									'filterField' => 'Cot.RELATION'
							)
								
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
		$this->Cot->recursive = 0;
		$this->set('cots', $this->paginate());
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $session);
		}
	}
	public function select($session, $pid=null) {
		$this->Cot->recursive = 0;
		$this->set('cots', $this->paginate());
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
		$this->Cot->id = $id;
		if (!$this->Cot->exists()) {
			throw new NotFoundException(__('Invalid cot'));
		}
		$this->set('cot', $this->Cot->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cot->create();
			if ($this->Cot->save($this->request->data)) {
				$this->Session->setFlash(__('The cot has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cot could not be saved. Please, try again.'));
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
		$this->Cot->id = $id;
		if (!$this->Cot->exists()) {
			throw new NotFoundException(__('Invalid cot'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cot->save($this->request->data)) {
				$this->Session->setFlash(__('The cot has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cot could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Cot->read(null, $id);
		}
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
		$this->Cot->id = $id;
		if (!$this->Cot->exists()) {
			throw new NotFoundException(__('Invalid cot'));
		}
		if ($this->Cot->delete()) {
			$this->Session->setFlash(__('Cot deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Cot was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
