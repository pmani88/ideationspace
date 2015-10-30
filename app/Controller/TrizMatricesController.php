<?php
// Controller/AttributesController.php
class TrizMatricesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $TrizMatrices = $this->TrizMatrix->find('all');
        $this->set(compact('TrizMatrices'));
		$this->set('_serialize', array('TrizMatrices'));
    }

    public function view($id) {
        $TrizMatrix = $this->TrizMatrix->findById($id);
        $this->set(compact('TrizMatrix'));
		$this->set('_serialize', array('TrizMatrix'));
    }

	public function get_principles($improving_id, $worsening_id){
		$TrizMatrices = $this->TrizMatrix->find('all', array('conditions' => array('TrizMatrix.improving_triz_parameter_id' => $improving_id, 'TrizMatrix.worsening_triz_parameter_id' => $worsening_id)));
        $this->set(compact('TrizMatrices'));
		$this->set('_serialize', array('TrizMatrices'));
	}

}