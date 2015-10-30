<?php
// Controller/AttributesController.php
class FunctionCadEntitiesController extends AppController {
	
	public $components = array('RequestHandler');
	public $uses = array('FunctionCadEntity', 'FunctionCadLink', 'Func', 'FlowVariable');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $FunctionCadEntities = $this->FunctionCadEntity->find('all');
        $this->set(compact('FunctionCadEntities'));
		$this->set('_serialize', array('FunctionCadEntities'));
    }

    public function view($id) {
        $FunctionCadEntity = $this->FunctionCadEntity->findById($id);
        $this->set(compact('FunctionCadEntity'));
		$this->set('_serialize', array('FunctionCadEntity'));
    }

	public function add($id){
		
		$funcs = $this->Func->find('all', array('recursive'=> 0));
		$flow_variables = $this->FlowVariable->find('all', array('recursive'=> 0));
		
		$func_options = Array();
		$func_options[""] = "";
		
		foreach($funcs as &$fun){
			$func_options[$fun['Func']['name']] = $fun['Func']['name'];
		}
		
		$flow_options = Array();
		$flow_options[""] = "";
		
		foreach($flow_variables as &$flow){
			$flow_options[$flow['FlowVariable']['name']] = $flow['FlowVariable']['name'];
		}
		
		
		$this->set(compact('id', 'func_options', 'flow_options'));
		
		if(!empty($this->request->data)){			
			$this->request->data['FunctionCadEntity']['session_id'] = $id;
			$this->request->data['FunctionCadEntity']['x'] = '10';
			$this->request->data['FunctionCadEntity']['y'] = '10';

	        if ($this->FunctionCadEntity->save($this->request->data)) {
				$message = $this->FunctionCadEntity->findById($this->FunctionCadEntity->id);
			} else {
	            $message = 'Error';
	        }
		    $this->set(compact("message"));
			$this->set('_serialize', array('message'));
		}
	}
	
    public function edit($id) {
		$funcs = $this->Func->find('all', array('recursive'=> 0));
		$flow_variables = $this->FlowVariable->find('all', array('recursive'=> 0));
		
		$func_options = Array();
		$func_options[""] = "";
		
		foreach($funcs as &$fun){
			$func_options[$fun['Func']['name']] = $fun['Func']['name'];
		}
		
		$flow_options = Array();
		$flow_options[""] = "";
		
		foreach($flow_variables as &$flow){
			$flow_options[$flow['FlowVariable']['name']] = $flow['FlowVariable']['name'];
		}
		
		
		$this->set(compact('id', 'func_options', 'flow_options'));
        $this->FunctionCadEntity->id = $id;
		if ($this->request->is('get')) {
	        $message = $this->FunctionCadEntity->read();
			$this->request->data = $message;
	    } else {
	        if ($this->FunctionCadEntity->save($this->request->data)) {
	            $message = $this->FunctionCadEntity->findById($this->FunctionCadEntity->id);
			} else {
	            $message = 'Error';
	        }
		}
        $this->set(compact("message"));
		$this->set('_serialize', array('message'));
    }

   public function delete($id) {
		// begin sql transaction
		$this->FunctionCadEntity->begin();
		$failure = false;
		// conditions for links related to entity
		$condition = array('OR' => array('FunctionCadLink.from_function_cad_entity_id' => (int)$id,
										 'FunctionCadLink.to_function_cad_entity_id' => (int)$id
									));

		// get all the dependent links
		$dependentLinks = $this->FunctionCadLink->find('all', array(
		        'conditions' => $condition
		));

		// delete each link
		foreach($dependentLinks as &$v){
			//print_r($v['Link']['id']);
			if(!$this->FunctionCadLink->delete($v['FunctionCadLink']['id']))
				$failure = true;
		}
		//print_r($dependentLinks[1]['Link']);

		// find the entity
		$entity = $this->FunctionCadEntity->findById($id);

		// extract entity details for log output
		/*
		$pmap_id = $entity['Entity']['problem_map_id'];
		$type = $entity['Entity']['type'];
		$eid = $entity['Entity']['id'];
		$name = $entity['Entity']['name'];
		*/

		// check if entity deleted
		if(!$this->FunctionCadEntity->delete($id))
			$failure = true;

		// check if any failures
		if(!$failure){
			// commit the sql transaction
			$this->FunctionCadEntity->commit();
            $message = 'Deleted';
			// output log information
			//parent::log_entry($pmap_id, "Deleted " . $type . "(" . $eid . ", " . $name . ")");
        } else {
			// rollback the sql transaction
			$this->FunctionCadEntity->rollback();
            $message = 'Error';
        }

		// set the view variable
        $this->set(compact("message"));
		// set for JSON and XMl display
		$this->set('_serialize', array('message'));
    }

}