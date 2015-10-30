<?php
// app/Model/Model.php
class Equation extends AppModel {
	
    public $name = 'Equation';

	public $hasAndBelongsToMany = array(
		'PhysicalEffect' =>
			array(
				'classname' => 'PhysicalEffect',
				'joinTable' => 'equations_physical_effects',
				'foreignKey' => 'equation_id',
				'associationForeignKey' => 'physical_effect_id',
				'unique' => true
			),
		'PhysicalParameter' =>
			array(
				'classname' => 'PhysicalParameter',
				'joinTable' => 'equations_physical_parameters',
				'foreignKey' => 'equation_id',
				'associationForeignKey' => 'physical_parameter_id',
				'unique' => true
			)
	);

}