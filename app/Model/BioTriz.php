<?php
// app/Model/Model.php
class BioTriz extends AppModel {
	
    public $name = 'BioTriz';

    public $belongsTo = array(
		'Principle' => array(
            'className'    => 'Principle',
            'foreignKey'   => 'principle_id'
        )
    );

}