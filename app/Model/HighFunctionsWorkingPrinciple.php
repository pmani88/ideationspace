<?php
// app/Model/Model.php
class HighFunctionsWorkingPrinciple extends AppModel {
	
    public $name = 'HighFunctionsWorkingPrinciple';

    public $belongsTo = array(
        'Func' => array(
            'className'    => 'Func'
        ),
		'FlowVariable' => array(
            'className'    => 'FlowVariable'
        ),
		'WorkingPrinciple' => array(
            'className'    => 'WorkingPrinciple'
        )
    );

}