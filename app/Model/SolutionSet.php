<?php
// app/Model/Model.php
class SolutionSet extends AppModel {
	
    public $name = 'SolutionSet';

	public $hasAndBelongsToMany = array(
		'MorphChartSolution' =>
			array(
				'classname' => 'MorphChartSolution',
				'joinTable' => 'morph_chart_solutions_solution_sets',
				'foreignKey' => 'solution_set_id',
				'associationForeignKey' => 'morph_chart_solution_id',
				'unique' => true
			)
	);
	
	public $belongsTo = array(
		'UserSession' =>
			array(
				'classname' => 'UserSession',
				'foreignKey' => 'session_id'
			)
	);
	
	// decrypt data after it is retrieved from the database using the PHP open_ssl_decrypt function
	public function afterFind($results) {
	    foreach ($results as $key => $val) {
			foreach($results[$key]["MorphChartSolution"] as $k => $v){
				if(!empty($results[$key]["MorphChartSolution"][$k]['name'])){
					$results[$key]["MorphChartSolution"][$k]['name'] = trim(mcrypt_decrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), base64_decode($results[$key]["MorphChartSolution"][$k]['name']), MCRYPT_MODE_CBC, "8werjsdf"));
				}
				if(!empty($results[$key]["MorphChartSolution"][$k]['text_document'])){
					$results[$key]["MorphChartSolution"][$k]['text_document'] = trim(mcrypt_decrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), base64_decode($results[$key]["MorphChartSolution"][$k]['text_document']), MCRYPT_MODE_CBC, "8werjsdf"));
				}
				if(!empty($results[$key]["MorphChartSolution"][$k]['soi'])){
					$results[$key]["MorphChartSolution"][$k]['soi'] = trim(mcrypt_decrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), base64_decode($results[$key]["MorphChartSolution"][$k]['soi']), MCRYPT_MODE_CBC, "8werjsdf"));
				}
				if(!empty($results[$key]["MorphChartSolution"][$k]['graphic_document'])){
					$results[$key]["MorphChartSolution"][$k]['graphic_document'] = trim(mcrypt_decrypt(MCRYPT_3DES, substr($this->getEncryptionKey(),0,24), base64_decode($results[$key]["MorphChartSolution"][$k]['graphic_document']), MCRYPT_MODE_CBC, "8werjsdf"));
				}
			}
		}
	    return $results;
	}
}