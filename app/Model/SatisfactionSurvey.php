<?php
// app/Model/Model.php
class SatisfactionSurvey extends AppModel {
	
    public $name = 'SatisfactionSurvey';

	public $belongsTo = array(
		'IdeationBlock' =>
			array(
				'classname' => 'IdeationBlock',
				'foreignKey' => 'ideation_block_id'
			),
		'IdeationMethod' =>
			array(
				'classname' => 'IdeationMethod',
				'foreignKey' => 'ideation_method_id'
			),
		'User' =>
			array(
				'classname' => 'User',
				'foreignKey' => 'user_id'
			)
	);

}