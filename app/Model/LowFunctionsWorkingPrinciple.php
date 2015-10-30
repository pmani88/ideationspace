<?php
// app/Model/Model.php
class LowFunctionsWorkingPrinciple extends AppModel {
	
    public $name = 'LowFunctionsWorkingPrinciple';

    public $belongsTo = array(
		'FlowVariable' => array(
            'className'    => 'FlowVariable'
        ),
		'WorkingPrinciple' => array(
            'className'    => 'WorkingPrinciple'
        )
    );

}