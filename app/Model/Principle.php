<?php
// app/Model/Model.php
class Principle extends AppModel {
	
    public $name = 'Principle';

	public $hasMany = array(
		'BioTriz' =>
			array(
				'className' => 'BioTriz',
				'foreignKey' => 'principle_id'
			),
		'FunctionTriz' =>
			array(
				'className' => 'FunctionTriz',
				'foreignKey' => 'principle_id'
			),
		'TrizMatrices' =>
			array(
				'className' => 'TrizMatrix',
				'foreignKey' => 'principle_id'
			)
	);
}