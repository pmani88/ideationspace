<?php
App::uses('AppController', 'Controller');
/**
 * MorphChartSolutions Controller
 *
 * @property MorphChartSolution $MorphChartSolution
 */
class MorphChartSolutionsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MorphChartSolution->recursive = 0;
		$this->set('morphChartSolutions', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->MorphChartSolution->id = $id;
		if (!$this->MorphChartSolution->exists()) {
			throw new NotFoundException(__('Invalid morph chart solution'));
		}
		$this->set('morphChartSolution', $this->MorphChartSolution->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MorphChartSolution->create();
			if ($this->MorphChartSolution->save($this->request->data)) {
				$this->Session->setFlash(__('The morph chart solution has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The morph chart solution could not be saved. Please, try again.'));
			}
		}
		$morphChartProblems = $this->MorphChartSolution->MorphChartProblem->find('list');
		$sessions = $this->MorphChartSolution->Session->find('list');
		$solutionSets = $this->MorphChartSolution->SolutionSet->find('list');
		$this->set(compact('morphChartProblems', 'sessions', 'solutionSets'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->MorphChartSolution->id = $id;
		if (!$this->MorphChartSolution->exists()) {
			throw new NotFoundException(__('Invalid morph chart solution'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MorphChartSolution->save($this->request->data)) {
				$this->Session->setFlash(__('The morph chart solution has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The morph chart solution could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->MorphChartSolution->read(null, $id);
		}
		$morphChartProblems = $this->MorphChartSolution->MorphChartProblem->find('list');
		$sessions = $this->MorphChartSolution->Session->find('list');
		$solutionSets = $this->MorphChartSolution->SolutionSet->find('list');
		$this->set(compact('morphChartProblems', 'sessions', 'solutionSets'));
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
		$this->MorphChartSolution->id = $id;
		if (!$this->MorphChartSolution->exists()) {
			throw new NotFoundException(__('Invalid morph chart solution'));
		}
		if ($this->MorphChartSolution->delete()) {
			$this->Session->setFlash(__('Morph chart solution deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Morph chart solution was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
