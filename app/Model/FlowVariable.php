<?php
// app/Model/Model.php
class FlowVariable extends AppModel {
	
    public $name = 'FlowVariable';

	public $hasAndBelongsToMany = array(
		'PhysicalEffect' =>
			array(
				'classname' => 'PhysicalEffect',
				'joinTable' => 'flow_variables_physical_effects',
				'foreignKey' => 'flow_variable_id',
				'associationForeignKey' => 'physical_effect_id',
				'unique' => true
			)
	);
	
	public $hasMany = array(
		'HighFunctionsWorkingPrinciple' => array(
			'className' => 'HighFunctionsWorkingPrinciple',
			'foreignKey' => 'flow_variable_id'
		),
		'LowFunctionsWorkingPrinciple' => array(
			'className' => 'LowFunctionsWorkingPrinciple',
			'foreignKey' => 'flow_variable_id'
		)
	);

}