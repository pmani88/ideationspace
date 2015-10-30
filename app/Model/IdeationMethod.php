<?php
// app/Model/Model.php
class IdeationMethod extends AppModel {
	
    public $name = 'IdeationMethod';

	public $hasAndBelongsToMany = array(
		'MiniStrategy' =>
			array(
				'classname' => 'MiniStrategy',
				'joinTable' => 'ideation_methods_mini_strategies',
				'foreignKey' => 'ideation_method_id',
				'associationForeignKey' => 'mini_strategy_id',
				'unique' => true
			)
	);
	
}