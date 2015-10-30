<?php
// Controller/AttributesController.php
class PronounsController extends AppController {
	
	public $components = array('RequestHandler');

	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Pronouns = $this->Pronoun->find('all');
        $this->set(compact('Pronouns'));
		$this->set('_serialize', array('Pronouns'));
    }

    public function view($id) {
        $Pronoun = $this->Pronoun->findById($id);
        $this->set(compact('Pronoun'));
		$this->set('_serialize', array('Pronoun'));
    }

}