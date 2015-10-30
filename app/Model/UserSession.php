<?php
// app/Model/Model.php
class UserSession extends AppModel {
	
    public $name = 'UserSession';
	public $useTable = 'sessions';
    public $belongsTo = array('User' => array('className' => 'User','foreignKey' => 'user_id'));
	
	public $hasMany = array(
	        'MorphChartProblem' => array(
				'className' => 'MorphChartProblem',
				'dependent' => true
			),
			'MorphChartSolution' => array(
				'className' => 'MorphChartSolution',
				'dependent' => true
			),
			'FunctionCadEntities' => array(
				'className' => 'FunctionCadEntity',
				'dependent' => true
			),
			'FunctionCadLinks' => array(
				'className' => 'FunctionCadLink',
				'dependent' => true
			),
			'LogEntry' => array(
				'className' => 'LogEntry',
				'dependent' => true
			),
			'SolutionSet' => array(
				'className' => 'SolutionSet',
				'dependent' => true
			)
	);

    public $validate = array(
		'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        )
    );

	public function isOwnedBy($id, $user) {
		//return true;
	    return $this->field('id', array('id' => $id, 'user_id' => $user)) === $id;
	}
	
}