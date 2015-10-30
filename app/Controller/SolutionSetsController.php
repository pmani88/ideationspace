<?php
// Controller/AttributesController.php
class SolutionSetsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $SolutionSets = $this->SolutionSet->find('all');
        $this->set(compact('SolutionSets'));
		$this->set('_serialize', array('SolutionSets'));
    }

    public function view($id) {		
        $SolutionSet = $this->SolutionSet->findById($id);
        $this->set(compact('SolutionSet'));
		$this->set('_serialize', array('SolutionSet'));
    }

	public function add() {
		if($this->request->is('post')){
			$this->SolutionSet->create();
			
			if($this->SolutionSet->saveAll($this->request->data)){
				$this->Session->setFlash('New solution set has been created.');
				$message = $this->SolutionSet->read();			
			}
			else
				$message = "Error";
				
			$this->set(compact('message'));
			$this->set('_serialize', array('message'));
		}
		$this->autoRender = false;
	}
	
	public function delete($id) {
		// cannot delete with a get request (only POST).
	    /*
		if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
		*/
	
		$this->SolutionSet->id = $id;
		$solution = $this->SolutionSet->read();
		$session = $solution['SolutionSet']['session_id'];
	
		// delete the problem and redirect to user session.
        if ($this->SolutionSet->delete($id)) {
			$this->Session->setFlash('The solution set with id: ' . $id . ' has been deleted.');
	        $this->redirect(array('controller' => 'user_sessions', 'action' => 'morph_chart', $session));
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }

		// this is for JSON and XML requests. 
        $this->set(compact("message"));
		$this->set('_serialize', array('message'));
    }

}