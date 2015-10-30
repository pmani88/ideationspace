<?php
// Controller/AttributesController.php
class LogEntriesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $LogEntries = $this->LogEntry->find('all');
        $this->set(compact('LogEntries'));
		$this->set('_serialize', array('LogEntries'));
    }

    public function view($id) {
        $LogEntry = $this->LogEntry->findById($id);
        $this->set(compact('LogEntry'));
		$this->set('_serialize', array('LogEntry'));
    }

	public function add(){
		if ($this->request->is('post')) {
			$this->LogEntry->create();
			$data = Array(
			        'problem_map_id' => $problem_map_id,
					'entry' => $entry
			    );
			if($this->LogEntry->save($this->request->data)){
				$message = $this->LogEntry->read();
			}
			else
				$message = "Error";
			$this->set(compact('message'));
			$this->set('_serialize', array('message'));
		}
	}

}