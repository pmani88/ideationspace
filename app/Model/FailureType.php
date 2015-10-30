<?php
// app/Model/Model.php
class FailureType extends AppModel {
	
    public $name = 'FailureType';

	
	public $hasMany = array(
		'Failures' => array(
			'className' => 'Failure',
			'foreignKey' => 'failure'
		)
	);
	
	/*
	public $belongsTo = array(
		'' => array(
			'className' => 'Artifact',
			'foreignKey' => 'describes_artifact'
		)
	);
	*/
	
}