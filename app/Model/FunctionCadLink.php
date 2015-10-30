<?php
// app/Model/Model.php
class FunctionCadLink extends AppModel {
	
    public $name = 'FunctionCadLink';

	public $belongsTo = array(
		'Session' => array(
			'className' => 'UserSession',
			'foreignKey' => 'session_id'
		),
		'FromEntity' => array(
			'className' => 'FunctionCadEntity',
			'foreignKey' => 'from_function_cad_entity_id'
		),
		'ToEntity' => array(
			'className' => 'FunctionCadEntity',
			'foreignKey' => 'from_function_cad_entity_id'
		)
	);
}