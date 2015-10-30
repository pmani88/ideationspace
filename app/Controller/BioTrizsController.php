<?php
// Controller/AttributesController.php
class BioTrizsController extends AppController {
	
	public $components = array('RequestHandler');

	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $BioTrizs = $this->BioTriz->find('all');
        $this->set(compact('BioTrizs'));
		$this->set('_serialize', array('BioTrizs'));
    }

    public function view($id) {
        $BioTriz = $this->BioTriz->findById($id);
        $this->set(compact('BioTriz'));
		$this->set('_serialize', array('BioTriz'));
    }

	public function get_principles($improving_category, $worsening_category){
        $BioTrizs = $this->BioTriz->find('all', array(
        	'conditions' => array(
				'BioTriz.improving_category' => $improving_category,
				'BioTriz.worsening_category' => $worsening_category)
        ));
        $this->set(compact('BioTrizs'));
		$this->set('_serialize', array('BioTrizs'));
	}
}