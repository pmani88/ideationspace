<?php
// app/Model/Model.php
class ManufacturingProcess extends AppModel {
	
    public $name = 'ManufacturingProcess';
	
	public $belongsTo = array(
		'Artifact' => array(
			'className' => 'Artifact',
			'foreignKey' => 'describes_artifact'
		),
		'ManufacturingProcessType' => array(
			'className' => 'ManufacturingProcessType',
			'foreignKey' => 'manufac_process_type'
		)
	);
	
	
}