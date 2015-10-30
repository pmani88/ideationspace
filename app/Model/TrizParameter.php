<?php
// app/Model/Model.php
class TrizParameter extends AppModel {
	
    public $name = 'TrizParameter';

	public $hasAndBelongsToMany = array(
		'PhysicalParameter' =>
			array(
				'classname' => 'PhysicalParameter',
				'joinTable' => 'physical_parameters_improving_triz_parameters',
				'foreignKey' => 'triz_parameter_id',
				'associationForeignKey' => 'physical_parameter_id',
				'unique' => true
			),
		'PhysicalParameter' =>
			array(
				'classname' => 'PhysicalParameter',
				'joinTable' => 'physical_parameters_worsening_triz_parameters',
				'foreignKey' => 'triz_parameter_id',
				'associationForeignKey' => 'physical_parameter_id',
				'unique' => true
			),
	);

}