<?php
// Controller/UserSessionsController.php
App::uses ( 'AppController', 'Controller' );
class UserSessionsController extends AppController {
	
	public $components = array('RequestHandler','Filter.Filter','Paginator');

	
	public $uses = array('UserSession', 'IdeationBlock', 'IdeationMethod', 'SatisfactionSurvey', 'MorphChartProblem', 'MorphChartSolution','MorphChartImage', 'Mechanism', 'MorphChartManualSolution', 'SolutionSet');

	public $filters = array (
			'index' => array (
					'Mechanism' => array (
								
							'Mechanism.GROUP' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.GROUP ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Group',
									'filterField' => 'Mechanism.GROUP'
							),
								
							'Mechanism.NAME' => array (
									'condition' => 'like',
									'label' => 'Search Mechanism by its name'
							),
								
							'Mechanism.IPTYPE' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.IPTYPE ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Input Type',
									'filterField' => 'Mechanism.IPTYPE'
							),
								
							'Mechanism.IPSPEED' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.IPSPEED ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Input Speed',
									'filterField' => 'Mechanism.IPSPEED'
							),
	
							'Mechanism.IPVELOCITYDIRECTION' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.IPVELOCITYDIRECTION ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Input Velocity Direction',
									'filterField' => 'Mechanism.IPVELOCITYDIRECTION'
							),
	
	
							'Mechanism.OPTYPE' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.OPTYPE ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Output Type',
									'filterField' => 'Mechanism.OPTYPE'
							),
	
							'Mechanism.OPSPEED' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.OPSPEED ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Output Speed',
									'filterField' => 'Mechanism.OPSPEED'
							),
								
							'Mechanism.OPVELOCITYDIRECTION' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.OPVELOCITYDIRECTION ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Output Velocity Direction',
									'filterField' => 'Mechanism.OPVELOCITYDIRECTION'
							),
								
							'Mechanism.REVERSIBILITY' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.REVERSIBILITY ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Reversibility',
									'filterField' => 'Mechanism.REVERSIBILITY'
							),
	
							'Mechanism.RELBETWNIPAX' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.RELBETWNIPAX ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Relation Between Input and Output Line of Motion',
									'filterField' => 'Mechanism.RELBETWNIPAX'
							),
	
							'Mechanism.Dimension' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.Dimension ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Dimension',
									'filterField' => 'Mechanism.Dimension'
							),
	
							'Mechanism.MCI' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.MCI ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Machine Components Involved',
									'filterField' => 'Mechanism.MCI'
							),
	
							'Mechanism.DOF' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.DOF ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Degree of Freedom',
									'filterField' => 'Mechanism.DOF'
							),
	
							'Mechanism.Function' => array (
									'type' => 'select',
									'selectOptions' => array (
											'order' => 'Mechanism.Function ASC'
											/* other options too.. */
									),
									'required' => false,
									'multiple' => true,
									'label' => 'Select Function',
									'filterField' => 'Mechanism.Function'
							)
	
								
								
					)
	
			)
	);
	
	public function isAuthorized($user){
		if(in_array($this->action, array('index','add'))){
			return true;
		}

	    // The owner of a session can access the necessary actions
	    if (in_array($this->action, array('edit', 'delete', 'disclaimer', 'function_cad',
											'find_ideation_state', 'browse_physical_effects_by_function',
											'browse_physical_effects_by_name', 'search_triz_by_function',
											'browse_artifacts_by_name', 'browse_artifacts_by_function',
											'browse_working_principles_by_function', 'browse_working_principles_by_name',
											'search_triz_by_feature', 'bio_triz', 'morph_chart', 'show_subtable',
											'survey', 'relational_algorithm', 'word_diamond', 
											'browse_working_principles_by_tracking', 'browse_physical_effects_by_tracking',
											'functional_analysis', 'mechanisms', 'browse_mechanisms','sample_page','auto_add_solution'))) {
	        $sessionId = $this->request->params['pass'][0];
	        if ($this->UserSession->isOwnedBy($sessionId, $user['id'])) {
	            	return true;
	        }
	    }
		
		return parent::isAuthorized($user);
	}
	
    public function index() {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		
		if($this->Auth->user('admin') == 1){
			$UserSessions = $this->UserSession->find('all');
		}
		else{
		// get all the user sessions belonging to the user
	        $UserSessions = $this->UserSession->find('all', array(
			        'conditions' => array('UserSession.user_id' => $this->Auth->user('id'))));
		}
		// set them in a variable accessible in the view
        $this->set(compact('UserSessions'));

		// save them in a format accessible from JSON / XML
		$this->set('_serialize', array('UserSessions'));
    }

	public function view($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);

		//parent::log_entry($UserSession['UserSession']['id'], "Loaded disclaimer page");

        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
	}

    public function add() {
		$error = false;
	    if ($this->request->is('post')) {
			$this->request->data['UserSession']['user_id'] = $this->Auth->user('id');
			
			// start database transaction
			$this->UserSession->begin();
			
			// Save user session
            if (!$this->UserSession->save($this->request->data)) {
				$error = true;
			}
			
			// handle transaction and message
			if ($error){
				$this->UserSession->rollback();
	            $message = 'Error';
                $this->Session->setFlash('Unable to create user session.');
			}
			else{
				$this->UserSession->commit();
            	$message = 'Saved';
                $this->Session->setFlash('Your user session has been created.');
                $this->redirect(array('action' => 'index'));
			}

			// this is for JSON and XML requests. 
			$this->set(compact("message"));
			$this->set('_serialize', array('message'));
        }
    }

    public function edit($id) {
		// retrieve the current user session if loading the form.
        $this->UserSession->id = $id;
		if ($this->request->is('get')) {
		        $this->request->data = $this->UserSession->read();
		} else {
			
			// here if the data has been posted. Save the new data and return result.
		    if ($this->UserSession->save($this->request->data)) {
	            $this->Session->setFlash('Your user session has been updated.');
	            $this->redirect(array('action' => 'index'));
	            $message = 'Saved';
	        } else {
	            $this->Session->setFlash('Unable to update your post.');
	            $message = 'Error';
	        }
	    }
	
		// this is for JSON and XML requests. 
        $this->set(compact("message"));
		$this->set('_serialize', array('message'));
    }

    public function delete($id) {
		// cannot delete with a get request (only POST).
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	
		// delete the user session and return the result.
        if ($this->UserSession->delete($id)) {
			$this->Session->setFlash('The user session with id: ' . $id . ' has been deleted.');
	        $this->redirect(array('action' => 'index'));
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }

		// this is for JSON and XML requests. 
        $this->set(compact("message"));
		$this->set('_serialize', array('message'));
    }

    public function disclaimer($id) {
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);

		parent::log_entry($UserSession['UserSession']['id'], "Loaded disclaimer page");

        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
    }
    
    public function mechanisms($id) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		
    	// retrieve the user session and set it to a variable accessible in the view
    	$UserSession = $this->UserSession->findById($id);
    
    	parent::log_entry($UserSession['UserSession']['id'], "Loaded disclaimer page");
    
    	$this->set(compact('UserSession'));
    
    	// this is for JSON and XML requests.
    	$this->set('_serialize', array('UserSession'));
    	
    	$Mechanisms = $this->Mechanism->find('all');
    	$this->set(compact('Mechanisms'));
    	$this->set('_serialize', array('Mechanisms'));
    }

    public function function_cad($id) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded function CAD page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
    }

    public function find_ideation_state($id) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded find ideation state page");
        $this->set(compact('UserSession'));

		// if the ideation block survey is submited find and render (return) the results.
		if($this->request->is('post')){

			$Blocks = $this->IdeationBlock->find('all', array(
				'recursive' => '2',
				'conditions' => array(
					'IdeationBlock.problem_novelty' => $this->request['data']['Ideation_state']['problem_novelty'],
					'IdeationBlock.problem_complexity' => $this->request['data']['Ideation_state']['problem_complexity'],
					'IdeationBlock.problem_uncertainty' => $this->request['data']['Ideation_state']['problem_uncertainty'],
					'IdeationBlock.process_time' => $this->request['data']['Ideation_state']['process_time'],
					'IdeationBlock.outcome_quantity' => $this->request['data']['Ideation_state']['outcome_quantity'],
					'IdeationBlock.outcome_quality' => $this->request['data']['Ideation_state']['outcome_quality'],
					'IdeationBlock.outcome_novelty' => $this->request['data']['Ideation_state']['outcome_novelty'],
					'IdeationBlock.outcome_variety' => $this->request['data']['Ideation_state']['outcome_variety']
				)
			));
			
			$this->set(compact('Blocks'));
			$this->set('_serialize', array('UserSession', 'Blocks'));
						
			$this->render('find_ideation_state_result');
		}
		else{
			// this is for JSON and XML requests. 
			$this->set('_serialize', array('UserSession'));
		}
    }

    public function browse_physical_effects_by_function($id, $pid = null) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded browse physical effects by function page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
		
		/* Auto-Populate Solution in Morph Chart */
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $id);
		}
    }

	public function browse_physical_effects_by_name($id, $pid = null){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded browse physical effects by name page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
		
		/* Auto-Populate Solution in Morph Chart */
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $id);
		}
	}
		
	public function browse_physical_effects_by_tracking($id, $pid = null){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded browse physical effects by tracking page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
		
		/* Auto-Populate Solution in Morph Chart */
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $id);
		}
	}
/*
    public function browse_physical_effects_by_name($id) {
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
    }
*/
    public function browse_working_principles_by_function($id, $pid = null) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded browse working principles by function page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
		
		/* Auto-Populate Solution in Morph Chart */
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $id);
		}
    }

    public function browse_working_principles_by_name($id, $pid = null) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded browse working principles by name page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
		
		/* Auto-Populate Solution in Morph Chart */
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $id);
		}
    }
	
	public function browse_working_principles_by_tracking($id, $pid = null){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded browse working principles by tracking page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
		
		/* Auto-Populate Solution in Morph Chart */
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $id);
		}
	}
	
    public function search_triz_by_feature($id, $pid = null) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded search triz by features page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
		
		/* Auto-Populate Solution in Morph Chart */
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $id);
		}
    }

    public function search_triz_by_function($id, $pid = null) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded search triz by function page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
		
		/* Auto-Populate Solution in Morph Chart */
		if(!is_null($pid)){
			$this->set('pid', $pid);
			$this->set('session', $id);
		}
    }

    public function bio_triz($id) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded bio triz page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
    }

    public function browse_artifacts_by_function($id) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded browse artifacts by function page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
    }
    
    public function browse_mechanisms($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
    	$UserSession = $this->UserSession->findById($id);
    	parent::log_entry($UserSession['UserSession']['id'], "Loaded browse artifacts by function page");
    	$this->set(compact('UserSession'));
    	
    	// this is for JSON and XML requests.
    	$this->set('_serialize', array('UserSession'));
    	$data=$this->Paginator->paginate('Mechanism');
    	$this->set ( 'mechanisms', $data); 	
    }

    public function browse_artifacts_by_name($id) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded browse artifacts by name page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
    }

	public function morph_chart($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		$this->SolutionSet->setEncryptionKey($session['cryptkey']);
		
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded morph chart page");
        $this->set(compact('UserSession'));
		
		// original code
		$this->set('usersessions',$UserSession);
			
		// new code for images 
		$data = $this->MorphChartImage->find('all');
		$this->set('datas',$data);
		
		$rootProblems = $this->MorphChartProblem->find('all',array(
				'conditions' => array('MorphChartProblem.morph_chart_problem_id' =>'','MorphChartProblem.session_id' =>$id )
		));
		
		$this->set('rootproblems',$rootProblems);
		$this->set('uid',$id);

		$manualSolutions = $this->MorphChartManualSolution->find('all',array(
			'order' => array('MorphChartManualSolution.manualSolutionSet ASC')
    	));
		
		$setid = 0;
		$probid = 0;
		$manualSolutionSet = array();
	
		$sol_id = -1;
		foreach($manualSolutions as $manualSolution){
			$prid = $manualSolution['MorphChartManualSolution']['morph_chart_problem_id'];
			if($setid != $prid){
				$i = -1;
				$setid = $prid;
				$manualSolutionSet[$setid] = array();
			}
			
			if($sol_id != $manualSolution['MorphChartManualSolution']['manualSolutionSet']){
				$i++;
				$manualSolutionSet[$setid][$i] = array();
				$sol_id = $manualSolution['MorphChartManualSolution']['manualSolutionSet'];
			} 
			
			array_push($manualSolutionSet[$setid][$i],$manualSolution['MorphChartManualSolution']);
		}
		
		$this->set('manualsolutionset',$manualSolutionSet);
		$this->set('manualsolutions',$manualSolutions);
		//echo 
		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession', 'rootproblems'));
		
		$solnsets = $this->SolutionSet->find('all', array('conditions' => array('SolutionSet.session_id' => $id),
															'order' => array('SolutionSet.id DESC') ));
		$this->set('solnsets',$solnsets);
	}
	
	public function morph_modal(){
		// this is for JSON and XML requests. 
		$this->set('_serialize', array('rootProblems'));
	}
	
	public function show_subtable($id, $pid){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		
		// retrieve the user session and set it to a variable accessible in the view
		$UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded morph chart page");
		$this->set(compact('UserSession'));
		
		// this is for JSON and XML requests.
		$this->set('_serialize', array('UserSession'));
		
		// original code
		$this->set('usersessions',$UserSession);
		
		// new code for images
		$data = $this->MorphChartImage->find('all');
		$this->set('datas',$data);
		$parentProblem = $this->MorphChartProblem->findById($pid);
		$childProblems=$this->MorphChartProblem->find('all',array(
			'conditions' => array('MorphChartProblem.morph_chart_problem_id' => $pid)
    	));
		
		$this->set('parentProblem',$parentProblem);
		$this->set('childproblems',$childProblems);
		
		$manualSolutions = $this->MorphChartManualSolution->find('all',array(
			'order' => array('MorphChartManualSolution.manualSolutionSet ASC')
    	));
		
		$setid = 0;
		$probid = 0;
		$manualSolutionSet = array();
	
		$sol_id = -1;
		foreach($manualSolutions as $manualSolution){
			$prid = $manualSolution['MorphChartManualSolution']['morph_chart_problem_id'];
			if($setid != $prid){
				$i = -1;
				$setid = $prid;
				$manualSolutionSet[$setid] = array();
			}
			
			if($sol_id != $manualSolution['MorphChartManualSolution']['manualSolutionSet']){
				$i++;
				$manualSolutionSet[$setid][$i] = array();
				$sol_id = $manualSolution['MorphChartManualSolution']['manualSolutionSet'];
			} 
			
			array_push($manualSolutionSet[$setid][$i],$manualSolution['MorphChartManualSolution']);
		}
		
		$this->set('manualsolutionset',$manualSolutionSet);
		$this->set('manualsolutions',$manualSolutions);
				
		$this->set('uid',$id);
		$this->set('pbid',$pid);
	}

    public function survey($id) {
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
		$UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded survey page");
        $this->set(compact('UserSession'));

		// get the ideation blocks and methods and save them to view variables
		$IdeationBlocksInfo = $this->IdeationBlock->find('all', array('recursive' => 0));
		$IdeationBlocks = Array();
		
		foreach($IdeationBlocksInfo as $ib){
			$IdeationBlocks[$ib['IdeationBlock']['id']] = $ib['IdeationBlock']['name'];
		}
		
		$IdeationMethodsInfo = $this->IdeationMethod->find('all', array('recursive' => 0));
		$IdeationMethods = Array();
		
		foreach($IdeationMethodsInfo as $im){
			$IdeationMethods[$im['IdeationMethod']['id']] = $im['IdeationMethod']['name'];
		}
		
		$this->set(compact('IdeationBlocks'));
		$this->set(compact('IdeationMethods'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
		
		if($this->request->is('post')){
			$this->request->data['SatisfactionSurvey']['user_id'] = $this->Auth->user('id');
			$this->SatisfactionSurvey->create();
			if($this->SatisfactionSurvey->save($this->request->data)){
				$this->Session->setFlash(__('Survey submitted, thank you!'));
				$this->redirect(array('action' => 'survey', $id));
			}
			else{
				$this->Session->setFlash(__('Sorry, the survey could not be saved. Please try again.'));
			}
		}
    }

	public function relational_algorithm($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded relational algorithm page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
	}
	
	public function word_diamond($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded word diamond page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
	}

	public function functional_analysis($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded functional analysis page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
	}
	
	public function sample_page($id){
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		// retrieve the user session and set it to a variable accessible in the view
        $UserSession = $this->UserSession->findById($id);
		parent::log_entry($UserSession['UserSession']['id'], "Loaded sample page");
        $this->set(compact('UserSession'));

		// this is for JSON and XML requests. 
		$this->set('_serialize', array('UserSession'));
	}
	
	/* Auto-Populate Solution in Morph Chart */
	public function auto_add_solution($session_id, $pid, $sname, $type, $soi){
			
		//echo $session_id." - ".$pid." - ".$sname." - ".$type." - ".$soi;
		
		$session = $this->Session->read();
		$this->MorphChartProblem->setEncryptionKey($session['cryptkey']);
		$this->MorphChartSolution->setEncryptionKey($session['cryptkey']);
		
		$data = array('session_id'=> $session_id, 'morph_chart_problem_id' => $pid, 'name' => $sname, 'soi' => $type.':'.rawurldecode($soi));
		if ($this->MorphChartSolution->save($data)) {
			//$sid = $this->MorphChartSolution->id;
			$this->Session->setFlash(__('Solution was saved successfully'));
		} else {
			$this->Session->setFlash(__('Error: Solution was saved'));
		}
		$this->autoRender = false;
	}
}