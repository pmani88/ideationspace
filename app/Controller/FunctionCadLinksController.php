<?php
// Controller/AttributesController.php
class FunctionCadLinksController extends AppController {
	
	public $components = array('RequestHandler');
	public $uses = array('FunctionCadEntity', 'FunctionCadLink');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $FunctionCadLinks = $this->FunctionCadLink->find('all');
        $this->set(compact('FunctionCadLinks'));
		$this->set('_serialize', array('FunctionCadLinks'));
    }

    public function view($id) {
        $FunctionCadLink = $this->FunctionCadLink->findById($id);
        $this->set(compact('FunctionCadLink'));
		$this->set('_serialize', array('FunctionCadLink'));
    }

	// delete a link the submitted data must include the 'from_entity_id' and 'to_entity_id'
    public function delete() {
		// check if there is a from and to entity ids
		if(isset($this->request->data['from_function_cad_entity_id']) && isset($this->request->data['to_function_cad_entity_id'])){
			// extract the ids
			$from = $this->request->data['from_function_cad_entity_id'];
			$to = $this->request->data['to_function_cad_entity_id'];
			
			// find link that match the ids
			$link = $this->FunctionCadLink->find('first', array(
			        'conditions' => array('FunctionCadLink.from_function_cad_entity_id' => $this->request->data['from_function_cad_entity_id'], 
					'FunctionCadLink.to_function_cad_entity_id' => $this->request->data['to_function_cad_entity_id'])));
			
			$id = $link['FunctionCadLink']['id'];

			// extract link info for log output
			/*
			$session_id = $link['FunctionCadLink']['session_id'];
			*/
			
			// check if there is an id and if the link was deleted successfully
	        if ($id && $this->FunctionCadLink->delete($id)) {
	            $message = 'Deleted';
				// write log output
				//parent::log_entry($pmap_id, "Deleted link(" . $id . ", " . $from . ", " . $to . ")");
	        } else {
	            $message = 'Error';
	        }
		}
		else
			$message = $this->request->data;
		
		// set the view variable
        $this->set(compact("message"));
		// set for XML and JSON display
		$this->set('_serialize', array('message'));
    }

	public function add($id){
			
		$entities = $this->FunctionCadEntity->find('all', array(
			'conditions' => array('session_id' => $id)
		));
		
		$options = Array();
		$options["-1"] = "";
		
		foreach($entities as &$e){
			$options[$e['FunctionCadEntity']['id']] = $e['FunctionCadEntity']['name'] . " : " . $e['FunctionCadEntity']['flow'];
		}
			
		$this->set(compact('id', 'options'));
		if(!empty($this->request->data)){			
			$this->request->data['FunctionCadLink']['session_id'] = $id;

	        if ($this->FunctionCadLink->save($this->request->data)) {
				$message = $this->FunctionCadLink->findById($this->FunctionCadLink->id);
			} else {
	            $message = 'Error';
	        }
		    $this->set(compact("message"));
			$this->set('_serialize', array('message'));
		}
	}

}