<?php
	
// app/Model/Model.php
class MorphChartProblem extends AppModel {
	
    public $name = 'MorphChartProblem';

    public $belongsTo = array(
		'ParentMorphChartProblem' => array(
            'className'    => 'MorphChartProblem',
            'foreignKey'   => 'morph_chart_problem_id'
        ),
		'Session' => array(
	        'className'    => 'Session',
	        'foreignKey'   => 'session_id'
	    )
    );

	public $hasMany = array(
		'ChildrenMorphChartProblems' => array(
			'className' 	=> 'MorphChartProblem',
			'foreignKey'	=> 'morph_chart_problem_id'
		),
		'MorphChartSolution' => array(
			'className' 	=> 'MorphChartSolution',
			'foreignKey'	=> 'morph_chart_problem_id'
		)
	);
	
	public $validate = array(
		'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
		)
	);
	
	// encrypt data before save using the PHP openssl_encrypt function
	public function beforeSave() {
		$encryptionMethod = "AES-256-CBC"; 
		//$this->data['MorphChartProblem']['name'] = openssl_encrypt($this->data['MorphChartProblem']['name'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
		$this->data['MorphChartProblem']['name'] = trim(base64_encode(mcrypt_encrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), $this->data['MorphChartProblem']['name'], MCRYPT_MODE_CBC, "8werjsdf")));

		return true;
	}
	
	// decrypt data after it is retrieved from the database using the PHP open_ssl_decrypt function
	public function afterFind($results) {
		$encryptionMethod = "AES-256-CBC"; 

	    foreach ($results as $key => $val) {
	        if (isset($val['MorphChartProblem']['name'])) {
	            //$results[$key]['MorphChartProblem']['name'] = openssl_decrypt($results[$key]['MorphChartProblem']['name'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
				$results[$key]['MorphChartProblem']['name'] = trim(mcrypt_decrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), base64_decode($results[$key]['MorphChartProblem']['name']), MCRYPT_MODE_CBC, "8werjsdf"));
			}
	    }

	    return $results;
	}

}
