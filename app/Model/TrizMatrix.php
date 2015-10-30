<?php
// app/Model/Model.php
class TrizMatrix extends AppModel {
	
    public $name = 'TrizMatrix';

    public $belongsTo = array(
        'ImprovingTrizParameter' => array(
            'className'    => 'TrizParameter',
            'foreignKey'   => 'improving_triz_parameter_id'
        ),
		'WorseningTrizParameter' => array(
            'className'    => 'TrizParameter',
            'foreignKey'   => 'worsening_triz_parameter_id'
        ),
		'Principle' => array(
            'className'    => 'Principle',
            'foreignKey'   => 'principle_id'
        )
    );

}