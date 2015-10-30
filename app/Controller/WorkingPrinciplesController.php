<?php
// Controller/AttributesController.php
class WorkingPrinciplesController extends AppController {
	
	public $components = array('RequestHandler');
	public $uses = array('WorkingPrinciple', 'PhysicalVariable');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $WorkingPrinciples = $this->WorkingPrinciple->find('all');
        $this->set(compact('WorkingPrinciples'));
		$this->set('_serialize', array('WorkingPrinciples'));
    }

    public function view($id) {
        $WorkingPrinciple = $this->WorkingPrinciple->findById($id);
        $this->set(compact('WorkingPrinciple'));
		$this->set('_serialize', array('WorkingPrinciple'));
    }

	public function track_by_keyword($keyword, $depth) {
		$WorkingPrincipleId = $this->WorkingPrinciple->find('list', array('fields' => 'id',
																		  'conditions' => array("WorkingPrinciple.description LIKE" => "%" . $keyword . "%"),
		                                                                  'order' => 'RANDOM()',
		                                                                  'limit' => 1));
		
		$WorkingPrinciple = $this->WorkingPrinciple->find('first', array('conditions' => array('WorkingPrinciple.id' => $WorkingPrincipleId)));
		
		if($depth == 0){
			if(!$WorkingPrinciple['WorkingPrinciple']){
				$this->track_by_keyword($keyword,$depth);
			}
			else{
				$this->set(compact('WorkingPrinciple'));
				$this->set('_serialize', array('WorkingPrinciple'));
			}
		}
		else{
			$commonWords = array($keyword, 'all', 'another', 'any', 'anybody', 'anyone', 'anything', 'both', 'each', 'other', 'everybody', 'everyone', 'everything', 'few', 'he', 'her', 'hers', 'herself', 'him', 'himself', 'his', 'I', 'it', 'its', 'itself', 'little', 'many', 'me', 'mine', 'more', 'most', 'much', 'myself', 'my', 'neither', 'no one', 'nobody', 'none', 'nothing', 'one', 'others', 'ours', 'ourselves', 'several', 'she', 'some', 'somebody', 'someone', 'something', 'that', 'theirs', 'them', 'themselves', 'these', 'they', 'their', 'this', 'those', 'us', 'we', 'what', 'whatever', 'which', 'whichever', 'who', 'whoever', 'whom', 'whomever', 'whose', 'you', 'your', 'yours', 'yourself', 'yourselves', 'null', 'the', 'either');
			$description = $WorkingPrinciple['WorkingPrinciple']['description'];
			$cleaned_description = preg_replace('/\b('.implode('|',$commonWords).')\b/','',$description);
			$potential_keywords = preg_split('/[^\w]+/', $cleaned_description);
			$newKeyword = $potential_keywords[array_rand($potential_keywords)];
			$this->track_by_keyword($newKeyword, $depth - 1);
		}
	}
	
	public function track_by_id($id, $depth) {
        $WorkingPrinciple = $this->WorkingPrinciple->findById($id);
		
		if($depth == 0){
			$this->set(compact('WorkingPrinciple'));
			$this->set('_serialize', array('WorkingPrinciple'));
		}
		else{
			$PhysicalVariableId = $WorkingPrinciple['PhysicalVariable'][array_rand($WorkingPrinciple['PhysicalVariable'])]['id'];
			$PhysicalVariable = $this->PhysicalVariable->findById($PhysicalVariableId);
			$NewId = $PhysicalVariable['WorkingPrinciple'][array_rand($PhysicalVariable['WorkingPrinciple'])]['id'];
			$this->track_by_id($NewId,$depth - 1);
		}
	}

}