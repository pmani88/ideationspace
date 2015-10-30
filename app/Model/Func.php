<?php
// app/Model/Model.php
class Func extends AppModel {
	
    public $name = 'Func';

	public $belongsTo = array(
		'ParentFunc' => array(
			'className' => 'Func',
			'foreignKey' => 'parent_func_id'
		)
	);

	public $hasMany = array(
		'HighFunctionsWorkingPrinciples' => array(
			'className' => 'HighFunctionsWorkingPrinciple',
			'foreignKey' => 'func_id'
		),
		'FunctionTrizs' => array(
			'className' => 'FunctionTriz',
			'foreignKey' => 'func_id'
		),
		'ChildrenFuncs' => array(
			'className' => 'Func',
			'foreignKey' => 'parent_func_id'
		)
	);
}