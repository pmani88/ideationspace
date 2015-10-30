<?php
// app/Model/Model.php
class MorphChartSolution extends AppModel {
	
    public $name = 'MorphChartSolution';

	public $hasMany = array(
		'MorphChartImage' => array(
			'className'		=>	'MorphChartImage',
			'foreignKey'	=>	'morph_chart_solution_id',
			'dependent'		=> true
		)
	);

    public $belongsTo = array(
		'MorphChartProblem' => array(
            'className'    => 'MorphChartProblem',
            'foreignKey'   => 'morph_chart_problem_id'
        ),
		'Session' => array(
	        'className'    => 'Session',
	        'foreignKey'   => 'session_id'
	    )
    );

	public $hasAndBelongsToMany = array(
		'SolutionSet' =>
			array(
				'classname' => 'SolutionSet',
				'joinTable' => 'morph_chart_solutions_solution_sets',
				'foreignKey' => 'morph_chart_solution_id',
				'associationForeignKey' => 'solution_set_id',
				'unique' => true,
				'dependent' => true
			)
	);

    public $validate = array(
		'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
		),
		'morph_chart_problem_id' => array(
			'required' => array(
			    'rule' => array('notEmpty'),
                'message' => 'A parent problem is required'
            )
		)
    );
	
	// encrypt data before save using the PHP openssl_encrypt function
	public function beforeSave() {
		$encryptionMethod = "AES-256-CBC"; 
		if(!empty($this->data['MorphChartSolution']['name'])){
			//$this->data['MorphChartSolution']['name'] = openssl_encrypt($this->data['MorphChartSolution']['name'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
			$this->data['MorphChartSolution']['name'] = trim(base64_encode(mcrypt_encrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), $this->data['MorphChartSolution']['name'], MCRYPT_MODE_CBC, "8werjsdf")));
		}
		if(!empty($this->data['MorphChartSolution']['soi'])){
			//$this->data['MorphChartSolution']['name'] = openssl_encrypt($this->data['MorphChartSolution']['name'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
			$this->data['MorphChartSolution']['soi'] = trim(base64_encode(mcrypt_encrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), $this->data['MorphChartSolution']['soi'], MCRYPT_MODE_CBC, "8werjsdf")));
		
		}
		if(!empty($this->data['MorphChartSolution']['text_document'])){
			//$this->data['MorphChartSolution']['text_document'] = openssl_encrypt($this->data['MorphChartSolution']['text_document'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
			$this->data['MorphChartSolution']['text_document'] = trim(base64_encode(mcrypt_encrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), $this->data['MorphChartSolution']['text_document'], MCRYPT_MODE_CBC, "8werjsdf")));
		}
		if(!empty($this->data['MorphChartSolution']['graphic_document'])){
			//$this->data['MorphChartSolution']['graphic_document'] = openssl_encrypt($this->data['MorphChartSolution']['graphic_document'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
			$this->data['MorphChartSolution']['graphic_document'] = trim(base64_encode(mcrypt_encrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), $this->data['MorphChartSolution']['graphic_document'], MCRYPT_MODE_CBC, "8werjsdf")));
		}

		return true;
	}
	
	// decrypt data after it is retrieved from the database using the PHP open_ssl_decrypt function
	public function afterFind($results) {
	
		$encryptionMethod = "AES-256-CBC"; 
		
	    foreach ($results as $key => $val) {
			if(!empty($results[$key]['MorphChartSolution']['name'])){
	    		//$results[$key]['MorphChartSolution']['name'] = openssl_decrypt($results[$key]['MorphChartSolution']['name'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
				$results[$key]['MorphChartSolution']['name'] = trim(mcrypt_decrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), base64_decode($results[$key]['MorphChartSolution']['name']), MCRYPT_MODE_CBC, "8werjsdf"));
			}
			if(!empty($results[$key]['MorphChartSolution']['soi'])){
				//$results[$key]['MorphChartSolution']['name'] = openssl_decrypt($results[$key]['MorphChartSolution']['name'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
				$results[$key]['MorphChartSolution']['soi'] = trim(mcrypt_decrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), base64_decode($results[$key]['MorphChartSolution']['soi']), MCRYPT_MODE_CBC, "8werjsdf"));
			}
			if(!empty($results[$key]['MorphChartSolution']['text_document'])){
				//$results[$key]['MorphChartSolution']['text_document'] = openssl_decrypt($results[$key]['MorphChartSolution']['text_document'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
				$results[$key]['MorphChartSolution']['text_document'] = trim(mcrypt_decrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), base64_decode($results[$key]['MorphChartSolution']['text_document']), MCRYPT_MODE_CBC, "8werjsdf"));
			}
			if(!empty($results[$key]['MorphChartSolution']['graphic_document'])){
				//$results[$key]['MorphChartSolution']['graphic_document'] = openssl_decrypt($results[$key]['MorphChartSolution']['graphic_document'], $encryptionMethod, $this->getEncryptionKey(), false, "8werjsdfj00932sd");
				$results[$key]['MorphChartSolution']['graphic_document'] = mcrypt_decrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), base64_decode($results[$key]['MorphChartSolution']['graphic_document']), MCRYPT_MODE_CBC, "8werjsdf");			
			}    
		}

	    return $results;
	}

}
