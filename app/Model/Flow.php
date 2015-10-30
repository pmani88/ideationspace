<?php
// app/Model/Model.php
class Flow extends AppModel {
	
    public $name = 'Flow';
	
	/*
	public $hasMany = array(
		'Artifacts' => array(
			'className' => 'Artifact',
			'foreignKey' => 'comp_basis_name'
		)
	);
	*/
	
	public $belongsTo = array(
		'Function' => array(
			'className' => 'OsuFunction',
			'foreignKey' => 'describes_function'
		),
		'InputArtifact' => array(
			'className' => 'Artifact',
			'foreignKey' => 'input_artifact'
		),
		'OutputArtifact' => array(
			'className' => 'Artifact',
			'foreignKey' => 'output_artifact'
		),
		'InputFlowType' => array(
			'className' => 'FlowType',
			'foreignKey' => 'input_flow'
		),
		'OutputFlowType' => array(
			'className' => 'FlowType',
			'foreignKey' => 'output_flow'
		)
	);
	
	
}