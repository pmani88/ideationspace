<?php
// app/Model/Model.php
class WpComponent extends AppModel {
	
    public $name = 'WpComponent';

	
	public $hasAndBelongsToMany = array(
		'WorkingPrinciple' =>
			array(
				'classname' => 'WorkingPrinciple',
				'joinTable' => 'working_principles_wp_components',
				'foreignKey' => 'wp_component_id',
				'associationForeignKey' => 'working_principle_id',
				'unique' => true
			)
	);

}