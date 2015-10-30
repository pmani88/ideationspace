<?php
// Controller/AttributesController.php
class MorphChartImagesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}
	public function morph_chart($id){
		$MorphChartImages = $this->MorphChartImage->find('all');
		$this->set(compact('MorphChartImages'));
		$this->set('_serialize', array('MorphChartImages'));
		$this->set('morphchartimage',$MorphChartImages);
	}

    public function index() {
		//$session = $this->Session->read();
		//$this->MorphChartImage->setEncryptionKey($session['cryptkey']);

        $MorphChartImages = $this->MorphChartImage->find('all');
        $this->set(compact('MorphChartImages'));
		$this->set('_serialize', array('MorphChartImages'));
		
    }

    public function view($id) {
		//$session = $this->Session->read();
		//$this->MorphChartImage->setEncryptionKey($session['cryptkey']);

        $MorphChartImage = $this->MorphChartImage->findById($id);
        $this->set(compact('MorphChartImage'));
		$this->set('_serialize', array('MorphChartImage'));
    }

	/*
	public function add($id){
		//$session = $this->Session->read();
		//$this->MorphChartImage->setEncryptionKey($session['cryptkey']);
		
		$Problems = $this->MorphChartImage->find('all', array(
			'conditions' => array('MorphChartImage.session_id' => $id)
		));
		
		$problem_options = Array();
		$problem_options[""] = "";
		
		foreach($Problems as &$p){
			$problem_options[$p['MorphChartImage']['id']] = $p['MorphChartImage']['name'];
		}
		
		$this->set(compact('id', 'problem_options'));
		
		if(!empty($this->request->data)){			
			$this->request->data['MorphChartImage']['session_id'] = $id;

	        if ($this->MorphChartImage->save($this->request->data)) {
				$message = $this->MorphChartImage->findById($this->MorphChartImage->id);
			} else {
	            $message = 'Error';
	        }
		    $this->set(compact("message"));
			$this->set('_serialize', array('message'));
		}

	}
			*/
	
	public function delete($id) {
		// cannot delete with a get request (only POST).
	    /*
		if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
		*/
	
		$this->MorphChartImage->id = $id;
		$image = $this->MorphChartImage->read();
		//print_r($image);
		$session = $image['MorphChartSolution']['session_id'];
		//print_r($session);
		$url = $image['MorphChartImage']['file_name'];
	
		// delete the user session and return the result.
        if ($this->MorphChartImage->delete($id)) {
			unlink(WWW_ROOT.$url);
			$this->Session->setFlash('The image with id: ' . $id . ' has been deleted.');
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