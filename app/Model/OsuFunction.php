<?php
// app/Model/Model.php
class OsuFunction extends AppModel {
	
    public $name = 'OsuFunction';

	public $hasMany = array(
		'Flows' => array(
			'className' => 'Flow',
			'foreignKey' => 'describes_function'
		)
	);
	
	public $belongsTo = array(
		'ParentFunction' => array(
			'className' => 'OsuFunction',
			'foreignKey' => 'subfunction_type'
		),
		'Artifact' => array(
			'className' => 'Artifact',
			'foreignKey' => 'describes_artifact'
		),
		'SubfunctionType' => array(
			'className' => 'SubfunctionType',
			'foreignKey' => 'subfunction_type'
		)
	);
	
	
}