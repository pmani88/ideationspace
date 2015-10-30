<?php
// app/Model/Model.php
class PhysicalEffect extends AppModel {
	
    public $name = 'PhysicalEffect';

	public $hasAndBelongsToMany = array(
		'Equation' =>
			array(
				'classname' => 'Equation',
				'joinTable' => 'equations_physical_effects',
				'foreignKey' => 'physical_effect_id',
				'associationForeignKey' => 'equation_id',
				'unique' => true
			),
		'FlowVariable' =>
			array(
				'classname' => 'FlowVariable',
				'joinTable' => 'flow_variables_physical_effects',
				'foreignKey' => 'physical_effect_id',
				'associationForeignKey' => 'flow_variable_id',
				'unique' => true
			),
		'WorkingPrinciple' =>
			array(
				'classname' => 'WorkingPrinciple',
				'joinTable' => 'physical_effects_working_principles',
				'foreignKey' => 'physical_effect_id',
				'associationForeignKey' => 'working_principle_id',
				'unique' => true
			)
	);

}