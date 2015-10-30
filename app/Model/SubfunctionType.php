<?php
// app/Model/Model.php
class SubfunctionType extends AppModel {
	
    public $name = 'SubfunctionType';

	public $hasMany = array(
		'OsuFunctions' => array(
			'className' => 'OsuFunction',
			'foreignKey' => 'subfunction_type'
		)
	);
	
	public $belongsTo = array(
		'ParentSubfunction' => array(
			'className' => 'SubfunctionType',
			'foreignKey' => 'parent_subfunction'
		)
	);
	
}