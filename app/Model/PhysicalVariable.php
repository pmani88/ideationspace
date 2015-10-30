<?php
// app/Model/Model.php
class PhysicalVariable extends AppModel {
	
    public $name = 'PhysicalVariable';

	public $belongsTo = "PhysicalParameter";
	
	public $hasAndBelongsToMany = array(
		'WorkingPrinciple' =>
			array(
				'classname' => 'WorkingPrinciples',
				'joinTable' => 'physical_variables_working_principles',
				'foreignKey' => 'physical_variable_id',
				'associationForeignKey' => 'working_principle_id',
				'unique' => true
			)
	);

}