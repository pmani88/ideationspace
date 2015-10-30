<?php
// app/Model/Model.php
class IdeationBlock extends AppModel {
	
    public $name = 'IdeationBlock';

	public $hasAndBelongsToMany = array(
		'MiniStrategy' =>
			array(
				'classname' => 'MiniStrategy',
				'joinTable' => 'ideation_blocks_mini_strategies',
				'foreignKey' => 'ideation_block_id',
				'associationForeignKey' => 'mini_strategy_id',
				'unique' => true
			)
	);

}