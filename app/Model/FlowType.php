<?php
// app/Model/Model.php
class FlowType extends AppModel {
	
    public $name = 'FlowType';

	public $hasMany = array(
		'FlowTypes' => array(
			'className' => 'FlowType',
			'foreignKey' => 'child_of_flow'
		),
		'InFlow' => array(
			'className' => 'Flow',
			'foreignKey' => 'input_flow'
		),
		'OutFlow' => array(
			'className' => 'Flow',
			'foreignKey' => 'output_flow'
		)
	);
	
	public $belongsTo = array(
		'ParentFlowType' => array(
			'className' => 'FlowType',
			'foreignKey' => 'child_of_flow'
		)
	);
	
	
}