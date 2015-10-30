<?php
// app/Model/Model.php
class FunctionCadEntity extends AppModel {
	
    public $name = 'FunctionCadEntity';

	public $hasMany = array(
		'FromLinks' => array(
			'className' => 'FunctionCadLink',
			'foreignKey' => 'from_function_cad_entity_id'
		),
		'ToLinks' => array(
			'className' => 'FunctionCadLink',
			'foreignKey' => 'to_function_cad_entity_id'
		)
	);

	public $belongsTo = array(
		'Session' => array(
			'className' => 'UserSession',
			'foreignKey' => 'session_id'
		)
	);
}