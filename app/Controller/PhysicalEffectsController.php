<?php
// Controller/AttributesController.php
class PhysicalEffectsController extends AppController {
	
	public $components = array('RequestHandler');
	public $uses = array('PhysicalEffect', 'Equation', 'PhysicalParameter');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $PhysicalEffects = $this->PhysicalEffect->find('all');
        $this->set(compact('PhysicalEffects'));
		$this->set('_serialize', array('PhysicalEffects'));
    }

    public function view($id) {
        $PhysicalEffect = $this->PhysicalEffect->findById($id);
        $this->set(compact('PhysicalEffect'));
		$this->set('_serialize', array('PhysicalEffect'));
    }

	public function track_by_keyword($keyword, $depth) {
		$PhysicalEffectId = $this->PhysicalEffect->find('list', array('fields' => 'id',
																		  'conditions' => array("PhysicalEffect.description LIKE" => "%" . $keyword . "%"),
		                                                                  'order' => 'RANDOM()',
		                                                                  'limit' => 1));
		
		$PhysicalEffect = $this->PhysicalEffect->find('first', array('conditions' => array('PhysicalEffect.id' => $PhysicalEffectId)));
		
		if($depth == 0){
			if(!$PhysicalEffect['PhysicalEffect']){
				$this->track_by_keyword($keyword,$depth);
			}
			else{
				$this->set(compact('PhysicalEffect'));
				$this->set('_serialize', array('PhysicalEffect'));
			}
		}
		else{
			$commonWords = array($keyword, 'all', 'another', 'any', 'anybody', 'anyone', 'anything', 'both', 'each', 'other', 'everybody', 'everyone', 'everything', 'few', 'he', 'her', 'hers', 'herself', 'him', 'himself', 'his', 'I', 'it', 'its', 'itself', 'little', 'many', 'me', 'mine', 'more', 'most', 'much', 'myself', 'my', 'neither', 'no one', 'nobody', 'none', 'nothing', 'one', 'others', 'ours', 'ourselves', 'several', 'she', 'some', 'somebody', 'someone', 'something', 'that', 'theirs', 'them', 'themselves', 'these', 'they', 'their', 'this', 'those', 'us', 'we', 'what', 'whatever', 'which', 'whichever', 'who', 'whoever', 'whom', 'whomever', 'whose', 'you', 'your', 'yours', 'yourself', 'yourselves', 'null', 'the', 'either');
			$description = $PhysicalEffect['PhysicalEffect']['description'];
			$cleaned_description = preg_replace('/\b('.implode('|',$commonWords).')\b/','',$description);
			$potential_keywords = preg_split('/[^\w]+/', $cleaned_description);
			$newKeyword = $potential_keywords[array_rand($potential_keywords)];
			$this->track_by_keyword($newKeyword, $depth - 1);
		}
	}
	
	public function track_by_id($id, $depth) {
        $PhysicalEffect = $this->PhysicalEffect->findById($id);
		
		if($depth == 0){
			$this->set(compact('PhysicalEffect'));
			$this->set('_serialize', array('PhysicalEffect'));
		}
		else{
			$EquationId = $PhysicalEffect['Equation'][array_rand($PhysicalEffect['Equation'])]['id'];
			$Equation = $this->Equation->findById($EquationId);
			
			$ParameterId = $Equation['PhysicalParameter'][array_rand($Equation['PhysicalParameter'])]['id'];
			$PhysicalParameter = $this->PhysicalParameter->findById($ParameterId);
			
			$secondEquationId = $PhysicalParameter['Equation'][array_rand($PhysicalParameter['Equation'])]['id'];
			$secondEquation = $this->Equation->findById($secondEquationId);
			
			$NewId = $secondEquation['PhysicalEffect'][array_rand($secondEquation['PhysicalEffect'])]['id'];
			
			$this->track_by_id($NewId,$depth - 1);
		}
	}

}