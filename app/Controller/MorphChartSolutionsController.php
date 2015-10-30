<?php
// Controller/AttributesController.php
class MorphChartSolutionsController extends AppController {
	
	public $components = array('RequestHandler');
	public $uses = array('MorphChartSolution', 'MorphChartProblem', 'MorphChartImages','Mechanism','Cot','PhysicalEffect','WorkingPrinciple','Principle', 'MorphChartManualSolution');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
	
        $MorphChartSolutions = $this->MorphChartSolution->find('all');
        $this->set(compact('MorphChartSolutions'));
		$this->set('_serialize', array('MorphChartSolutions'));
    }

    public function view($id) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
			
        $MorphChartSolution = $this->MorphChartSolution->findById($id);
        $this->set(compact('MorphChartSolution'));
		$this->set('_serialize', array('MorphChartSolution'));
    }

	public function add($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
				
		$Problems = $this->MorphChartProblem->find('all', array(
			'conditions' => array('MorphChartProblem.session_id' => $id)
		));
		
		$problem_options = Array();
		//$problem_options[""] = "";
		
		foreach($Problems as &$p){
			$problem_options[$p['MorphChartProblem']['id']] = $p['MorphChartProblem']['name'];
		}
		
		$this->set(compact('id', 'problem_options'));
		//echo json_encode($this->request->data);
		if(!empty($this->request->data)){			
			$this->request->data['MorphChartSolution']['session_id'] = $id;

	        if ($this->MorphChartSolution->save($this->request->data)) {
				$message = $this->MorphChartSolution->findById($this->MorphChartSolution->id);
			} else {
	            $message = 'Error';
	        }
		    $this->set(compact("message"));
			$this->set('_serialize', array('message'));
		}
	}
	
	public function edit($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->id = $id;
		$Solution = $this->MorphChartSolution->read();
		
		$Problems = $this->MorphChartProblem->find('all', array(
			'conditions' => array('MorphChartProblem.session_id' => $Solution['MorphChartSolution']['session_id'])
		));
		$Mechs = $this->Mechanism->find('all');		
		$Cots = $this->Cot->find('all');
		$Wp = $this->WorkingPrinciple->find('all');
		$Pe = $this->PhysicalEffect->find('all');
		$Principles = $this->Principle->find('all');

		$cot_options = Array();
			//$cot_options['null'] = '-- Select --';
		foreach($Cots as &$p){
			$cot_options['Cots:'.$p['Cot']['NAME']] = 'Cots:'.$p['Cot']['NAME'];
		}
		foreach($Mechs as &$p){
			$cot_options['Mechanism:'.$p['Mechanism']['NAME']] = 'Mechanism:'.$p['Mechanism']['NAME'];
		}
		foreach($Wp as &$p){
			$cot_options['WorkingPrinciple:'.$p['WorkingPrinciple']['name']] = 'WorkingPrinciple:'.$p['WorkingPrinciple']['name'];
		}
		foreach($Pe as &$p){
			$cot_options['PhysicalEffect:'.$p['PhysicalEffect']['name']] = 'PhysicalEffect:'.$p['PhysicalEffect']['name'];
		}
		foreach($Principles as &$p){
			$cot_options['TRIZ:'.$p['Principle']['name']] = 'TRIZ:'.$p['Principle']['name'];
		}
		
		
		$this->set(compact('id', 'cot_options', 'Solution'));
		
		
		$problem_options = Array();
		
		foreach($Problems as &$p){
			$problem_options[$p['MorphChartProblem']['id']] = $p['MorphChartProblem']['name'];
		}
		
		$this->set(compact('id', 'problem_options', 'Solution'));
		
		
		if ($this->request->is('get')) {
			$this->request->data = $Solution;
	    } else {
			$this->MorphChartSolution->begin();
			$failed = false;
	        if ($this->MorphChartSolution->save($this->request->data)) {
				$solution = $this->MorphChartSolution->read();
				if(isset($this->request->data['MorphChartImages']['file_name'])){
					$fileOK = $this->uploadFiles('img/user_images', $this->request->data['MorphChartImages']['file_name'], $solution['MorphChartSolution']['session_id']);
					if(isset($fileOK['urls'][0])){
						$this->MorphChartImages->create();
						$image_data = Array('morph_chart_solution_id' => $solution['MorphChartSolution']['id'], 
											 'file_name' => $fileOK['urls'][0]);
						if(!$this->MorphChartImages->save($image_data)){
							$this->MorphChartSolution->rollback();
							$failed = true;
						}				
					}
				}

				if($failed){
					$this->MorphChartSolution->rollback();
					$message = 'Error';
				}
				else{
					$this->MorphChartSolution->commit();
					$message = $this->MorphChartSolution->findById($this->MorphChartSolution->id);
				}
				$this->redirect(array('controller' => 'UserSessions', 'action' => 'morph_chart', $message['MorphChartSolution']['session_id']));
			} else {
				$this->MorphChartSolution->rollback();
	            $message = 'Error';
	        }
		}
        $this->set(compact("message"));
		$this->set('_serialize', array('message'));
		
		$this->set('UserSession', $Solution['MorphChartSolution']['session_id']);
	}
	
	public function delete($id) {
		// cannot delete with a get request (only POST).
	    /*
		if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
		*/
	
		$this->MorphChartSolution->id = $id;
		$solution = $this->MorphChartSolution->read();
		$session = $solution['MorphChartSolution']['session_id'];
	
		// delete the problem and redirect to user session.
        if ($this->MorphChartSolution->delete($id)) {
			
			// delete solution from Manual Solution sets as well
			$this->MorphChartManualSolution->deleteAll(array('MorphChartManualSolution.morph_chart_solution_id' => $id), false);
			
			$this->Session->setFlash('The solution with id: ' . $id . ' has been deleted.');
	        $this->redirect(array('controller' => 'user_sessions', 'action' => 'morph_chart', $session));
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }

		// this is for JSON and XML requests. 
        $this->set(compact("message"));
		$this->set('_serialize', array('message'));
    }
	
	function uploadFiles($folder, $formdata, $itemId = null) {
		// setup dir names absolute and relative
		$folder_url = WWW_ROOT.$folder;
		$rel_url = $folder;

		// create the folder if it does not exist
		if(!is_dir($folder_url)) {
			mkdir($folder_url);
		}

		// if itemId is set create an item folder
		if($itemId) {
			// set new absolute folder
			$folder_url = WWW_ROOT.$folder.'/'.$itemId; 
			// set new relative folder
			$rel_url = $folder.'/'.$itemId;
			// create directory
			if(!is_dir($folder_url)) {
				mkdir($folder_url);
			}
		}

		// list of permitted file types, this is only images but documents can be added
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');

		// loop through and deal with the files
		//print_r($formdata);
		//foreach($formdata as $file) {
			$file = $formdata;
			// replace spaces with underscores
			$filename = str_replace(' ', '_', $file['name']);
			// assume filetype is false
			$typeOK = false;
			// check filetype is ok
			foreach($permitted as $type) {
				if($type == $file['type']) {
					$typeOK = true;
					break;
				}
			}

			// if file type ok upload the file
			if($typeOK) {
				// switch based on error code
				switch($file['error']) {
					case 0:
						// check filename already exists
						if(!file_exists($folder_url.'/'.$filename)) {
							// create full filename
							$full_url = $folder_url.'/'.$filename;
							$url = $rel_url.'/'.$filename;
							// upload the file
							$success = move_uploaded_file($file['tmp_name'], $url);
						} else {
							// create unique filename and upload file
							ini_set('date.timezone', 'Europe/London');
							$now = date('Y-m-d-His');
							$full_url = $folder_url.'/'.$now.$filename;
							$url = $rel_url.'/'.$now.$filename;
							$success = move_uploaded_file($file['tmp_name'], $url);
						}
						// if upload was successful
						if($success) {
							// save the url of the file
							$result['urls'][] = $url;
						} else {
							$result['errors'][] = "Error uploaded $filename. Please try again.";
						}
						break;
					case 3:
						// an error occured
						$result['errors'][] = "Error uploading $filename. Please try again.";
						break;
					default:
						// an error occured
						$result['errors'][] = "System error uploading $filename. Contact webmaster.";
						break;
				}
			} elseif($file['error'] == 4) {
				// no file was selected for upload
				$result['nofiles'][] = "No file Selected";
			} else {
				// unacceptable file type
				$result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
			}
		//}
		return $result;
	}
}
