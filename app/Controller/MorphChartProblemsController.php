<?php
// Controller/AttributesController.php
class MorphChartProblemsController extends AppController {
	
	public $components = array('RequestHandler');
	public $uses = array('MorphChartProblem', 'MorphChartSolution');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);

        $MorphChartProblems = $this->MorphChartProblem->find('all');
        $this->set(compact('MorphChartProblems'));
		$this->set('_serialize', array('MorphChartProblems'));
    }

    public function view($id) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);

        $MorphChartProblem = $this->MorphChartProblem->findById($id);
        $this->set(compact('MorphChartProblem'));
		$this->set('_serialize', array('MorphChartProblem'));
    }

	public function add($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		
		$Problems = $this->MorphChartProblem->find('all', array(
			'conditions' => array('MorphChartProblem.session_id' => $id)
		));
		
//		print_r($Problems);
		
		$problem_options = Array();
		$problem_options[""] = "";
		
		foreach($Problems as &$p){
			$problem_options[$p['MorphChartProblem']['id']] = $p['MorphChartProblem']['name'];
		}
		
		$this->set(compact('id', 'problem_options'));
		
		$this->set('Problems',$Problems);
		
		if(!empty($this->request->data)){			
			$this->request->data['MorphChartProblem']['session_id'] = $id;

	        if ($this->MorphChartProblem->save($this->request->data)) {
				$message = $this->MorphChartProblem->findById($this->MorphChartProblem->id);
			} else {
	            $message = 'Error';
	        }
		    $this->set(compact("message"));
			$this->set('_serialize', array('message'));
		}
	}
	
	public function edit($id){
				
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		
		$this->MorphChartProblem->id = $id;
		$message = $this->MorphChartProblem->read();
		
		$Problems = $this->MorphChartProblem->find('all', array(
			'conditions' => array('MorphChartProblem.session_id' => $message['MorphChartProblem']['session_id'])
		));
		
//		print_r($Problems);

		$this->set('Problems',$Problems);
		
		$problem_options = Array();
		$problem_options[""] = "";
		
		foreach($Problems as &$p){
			if(strcmp($p['MorphChartProblem']['name'],$message['MorphChartProblem']['name']) != 0)
				$problem_options[$p['MorphChartProblem']['id']] = $p['MorphChartProblem']['name'];
		}
		
		$this->set(compact('id', 'problem_options'));
		
		if ($this->request->is('get')) {
			$this->request->data = $message;
	    } else {
	        if ($this->MorphChartProblem->save($this->request->data)) {
	            $message = $this->MorphChartProblem->findById($this->MorphChartProblem->id);
			} else {
	            $message = 'Error';
	        }
		}
        $this->set(compact("message"));
		$this->set('_serialize', array('message'));
		
		$Problem = $this->MorphChartProblem->read();
		//print_r($Problem);
		$this->set('UserSession', $Problem['MorphChartProblem']['session_id']);
	}

	public function delete($id) {
		// cannot delete with a get request (only POST).
	    /*
		if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
		*/
	
		$this->MorphChartProblem->id = $id;
		$problem = $this->MorphChartProblem->read();
		$session = $problem['MorphChartProblem']['session_id'];
	
		// delete the problem and redirect to user session.
        if ($this->MorphChartProblem->delete($id)) {
			$this->Session->setFlash('The problem with id: ' . $id . ' has been deleted.');
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