<?php
// app/Model/Model.php
class FunctionTriz extends AppModel {
	
    public $name = 'FunctionTriz';

    public $belongsTo = array(
		'Principle' => array(
            'className'    => 'Principle',
            'foreignKey'   => 'principle_id'
        ),
		'Func' => array(
			'className'	   => 'Func',
			'foreignKey'   => 'func_id'
		)
    );

}