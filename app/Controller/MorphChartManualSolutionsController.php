<?php
App::uses('AppController', 'Controller');
/**
 * MorphChartManualSolutions Controller
 *
 * @property MorphChartManualSolution $MorphChartManualSolution
 */
class MorphChartManualSolutionsController extends AppController {

	public function isAuthorized($user){
		if(in_array($this->action, array('index','view', 'delete_solution_set'))){
			return true;
		}

	    // The owner of a session can access the necessary actions
	    if (in_array($this->action, array('add', 'edit', 'save_solutions_manually'))) {
	        $sessionId = $this->request->params['pass'][0];
			echo $sessionId;
			$this->loadModel('UserSession');
	        if ($this->UserSession->isOwnedBy($sessionId, $user['id'])) {
	            	return true;
	        }
	    }
		
		return parent::isAuthorized($user);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MorphChartManualSolution->recursive = 0;
		$this->set('morphChartManualSolutions', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->MorphChartManualSolution->id = $id;
		if (!$this->MorphChartManualSolution->exists()) {
			throw new NotFoundException(__('Invalid morph chart manual solution'));
		}
		$this->set('morphChartManualSolution', $this->MorphChartManualSolution->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MorphChartManualSolution->create();
			if ($this->MorphChartManualSolution->save($this->request->data)) {
				$this->Session->setFlash(__('The morph chart manual solution has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The morph chart manual solution could not be saved. Please, try again.'));
			}
		}
		$morphChartProblems = $this->MorphChartManualSolution->MorphChartProblem->find('list');
		$morphChartSolutions = $this->MorphChartManualSolution->MorphChartSolution->find('list');
		$sessions = $this->MorphChartManualSolution->Session->find('list');
		$solutionSets = $this->MorphChartManualSolution->SolutionSet->find('list');
		$this->set(compact('morphChartProblems', 'morphChartSolutions', 'sessions', 'solutionSets'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->MorphChartManualSolution->id = $id;
		if (!$this->MorphChartManualSolution->exists()) {
			throw new NotFoundException(__('Invalid morph chart manual solution'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MorphChartManualSolution->save($this->request->data)) {
				$this->Session->setFlash(__('The morph chart manual solution has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The morph chart manual solution could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->MorphChartManualSolution->read(null, $id);
		}
		$morphChartProblems = $this->MorphChartManualSolution->MorphChartProblem->find('list');
		$morphChartSolutions = $this->MorphChartManualSolution->MorphChartSolution->find('list');
		$sessions = $this->MorphChartManualSolution->Session->find('list');
		$solutionSets = $this->MorphChartManualSolution->SolutionSet->find('list');
		$this->set(compact('morphChartProblems', 'morphChartSolutions', 'sessions', 'solutionSets'));
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
		$this->MorphChartManualSolution->id = $id;
		if (!$this->MorphChartManualSolution->exists()) {
			throw new NotFoundException(__('Invalid morph chart manual solution'));
		}
		if ($this->MorphChartManualSolution->delete()) {
			$this->Session->setFlash(__('Morph chart manual solution deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Morph chart manual solution was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function save_solutions_manually($id, $pid, $sid, $mid){
		$session = $this->Session->read();
		$data = array('session_id'=> $id, 'morph_chart_problem_id' => $pid, 'morph_chart_solution_id' => $sid, 'manualSolutionSet' => $mid);
		$this->MorphChartManualSolution->save($data);
		$this->Session->setFlash(__('Solution set created.'));
		$this->autoRender = false;
	}
	
	public function delete_solution_set($set_id){
		if($this->MorphChartManualSolution->deleteAll(array('MorphChartManualSolution.manualSolutionSet' => $set_id), false)){
			$this->Session->setFlash(__('Morph chart manual solution set was deleted'));
			$this->autoRender = false;
		} else {
			$this->Session->setFlash(__('Morph chart solution set was not deleted. Please try again.'));
		}
	}
}
