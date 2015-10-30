<?php
// app/Model/Model.php
class ManufacturingProcessType extends AppModel {
	
    public $name = 'ManufacturingProcessType';

	public $hasMany = array(
		'ManufacturingProcess' => array(
			'className' => 'ManufacturingProcess',
			'foreignKey' => 'manufac_process_type'
		)
	);
	
}