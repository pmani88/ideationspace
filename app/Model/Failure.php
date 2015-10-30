<?php
// app/Model/Model.php
class Failure extends AppModel {
	
    public $name = 'Failure';

	/*
	public $hasMany = array(
		'' => array(
			'className' => 'Artifact',
			'foreignKey' => 'comp_basis_name'
		)
	);
	*/
	
	public $belongsTo = array(
		'Artifact' => array(
			'className' => 'Artifact',
			'foreignKey' => 'describes_artifact'
		),
		'FailureType' => array(
			'className' => 'FailureType',
			'foreignKey' => 'failure'
		)
	);
	
	
}