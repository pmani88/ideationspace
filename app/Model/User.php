<?php
// app/Model/User.php
class User extends AppModel {
    public $name = 'User';
	public $hasMany = array(
	        'Sessions' => array(
	            'className'     => 'Session',
	            'foreignKey'    => 'user_id',
	            'order'         => 'problem_maps.name DESC',
	            'dependent'     => true
	        ),
			'SatisfactionSurveys' => array(
				'className'		=> 'SatisfactionSurvey',
				'foreignKey' 	=> 'user_id',
				'dependent'		=> true
			)
	    );

    public $validate = array(
		'email' => array(
        	'validEmail' => array(
	            'rule' => 'email',
				'message' => "A valid email is required"
	        ),
	        'uniqueEmail' => array(
	            'rule' => 'isUnique',
				'message' => "Email address already registered with our system"
	            // extra keys like on, required, etc. go here...
	        )
		),
		'firstname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A firstname is required'
            ),
			'maxLength' => array(
				'rule' => array('maxLength', 50),
				'message' => 'Firstname must be less than 50 characters long'
			)
        ),
		'lastname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A lastname is required'
            ),
			'maxLength' => array(
				'rule' => array('maxLength', 50),
				'message' => 'Lastname must be less than 50 characters long'
			)
        ),
		'organization' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Organization is required'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Organization name must be less than 100 characters long'
			)
		),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        )
    );

	public function beforeSave() {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}
}