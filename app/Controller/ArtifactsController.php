<?php
// Controller/AttributesController.php
class ArtifactsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Artifacts = $this->Artifact->find('all', array(
        	'recursive' => 0,
			'fields' => array(
				'Artifact.id',
				'Artifact.name'
			)
        ));
        $this->set(compact('Artifacts'));
		$this->set('_serialize', array('Artifacts'));
    }

    public function view($id) {
        $Artifact = $this->Artifact->findById($id);
        $this->set(compact('Artifact'));
		$this->set('_serialize', array('Artifact'));
    }

/*
	// TODO the current artifacts page loads extremely slowly, could probably
	// write a better method for getting the data that only takes one AJAX
	// call instead of multiple calls and would consequently be much quicker.
	public function view_verbose($id){
		$Artifact = $this->Artifact->findById($id);
        $this->set(compact('Artifact'));
		$this->set('_serialize', array('Artifact'));
	}
*/

}