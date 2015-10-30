<?php
// app/Model/Model.php
class WorkingPrinciple extends AppModel {
	
    public $name = 'WorkingPrinciple';

	
	public $hasAndBelongsToMany = array(
		'PhysicalEffect' =>
			array(
				'classname' => 'PhysicalEffect',
				'joinTable' => 'physical_effects_working_principles',
				'foreignKey' => 'working_principle_id',
				'associationForeignKey' => 'physical_effect_id',
				'unique' => true
			),
		'WpComponent' =>
			array(
				'classname' => 'WpComponent',
				'joinTable' => 'working_principles_wp_components',
				'foreignKey' => 'working_principle_id',
				'associationForeignKey' => 'wp_component_id',
				'unique' => true
			),
		'PhysicalVariable' =>
			array(
				'classname' => 'PhysicalVariable',
				'joinTable' => 'physical_variables_working_principles',
				'foreignKey' => 'working_principle_id',
				'associationForeignKey' => 'physical_variable_id',
				'unique' => true
			)
	);
	
	public $hasMany = array(
		'HighFunctionsWorkingPrinciple' => array(
			'className' => 'HighFunctionsWorkingPrinciple',
			'foreignKey' => 'working_principle_id'
		),
		'LowFunctionsWorkingPrinciple' => array(
			'className' => 'LowFunctionsWorkingPrinciple',
			'foreignKey' => 'working_principle_id'
		)
	);

}