<?php
// app/Model/Model.php
class PhysicalParameter extends AppModel {
	
    public $name = 'PhysicalParameter';

	public $hasAndBelongsToMany = array(
		'Equation' =>
			array(
				'classname' => 'Equation',
				'joinTable' => 'equations_physical_parameters',
				'foreignKey' => 'physical_parameter_id',
				'associationForeignKey' => 'equation_id',
				'unique' => true
			),
		'TrizParameter' =>
			array(
				'classname' => 'TrizParameter',
				'joinTable' => 'physical_parameters_improving_triz_parameters',
				'foreignKey' => 'physical_parameter_id',
				'associationForeignKey' => 'triz_parameter_id',
				'unique' => true
			),
		'TrizParameter' =>
			array(
				'classname' => 'TrizParameter',
				'joinTable' => 'physical_parameters_improving_triz_parameters',
				'foreignKey' => 'physical_parameter_id',
				'associationForeignKey' => 'triz_parameter_id',
				'unique' => true
			)
	);
	
	public $hasMany = "PhysicalVariables";

}