<?php 

class LogEntry extends AppModel {

	public $belongsTo = array(
	    'UserSession' => array(
	        'className'    => 'UserSession',
			'foreignKey'   => 'session_id'
	    )
    );

}