<?php
// app/Model/Model.php
class MiniStrategy extends AppModel {
	
    public $name = 'MiniStrategy';

	public $hasAndBelongsToMany = array(
		'IdeationBlock' =>
			array(
				'classname' => 'IdeationBlock',
				'joinTable' => 'ideation_blocks_mini_strategies',
				'foreignKey' => 'mini_strategy_id',
				'associationForeignKey' => 'ideation_block_id',
				'unique' => true
			),
		'IdeationMethod' =>
			array(
				'classname' => 'IdeationMethod',
				'joinTable' => 'ideation_methods_mini_strategies',
				'foreignKey' => 'mini_strategy_id',
				'associationForeignKey' => 'ideation_method_id',
				'unique' => true
			)
	);

}