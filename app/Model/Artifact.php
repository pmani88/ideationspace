<?php
// app/Model/Model.php
class Artifact extends AppModel {
	
    public $name = 'Artifact';

	public $hasMany = array(
		'Artifacts' => array(
			'className' => 'Artifact',
			'foreignKey' => 'parent_artifact'
		),
		'InFlow' => array(
			'className' => 'Flow',
			'foreignKey' => 'input_artifact'
		),
		'OutFlow' => array(
			'className' => 'Flow',
			'foreignKey' => 'output_artifact'
		),
		'Functions' => array(
			'className' => 'OsuFunction',
			'foreignKey' => 'describes_artifact'
		),
		'Failures' => array(
			'className' => 'Failure',
			'foreignKey' => 'describes_artifact'
		)
	);
	
	public $hasOne = array(
		'ArtifactImage' => array(
			'className' => 'ArtifactImage',
			'foreignKey' => 'artifact_id'
		)
	);

	public $belongsTo = array(
		'ParentArtifact' => array(
			'className' => 'Artifact',
			'foreignKey' => 'parent_artifact'
		),
		'CompBasis' => array(
			'className' => 'CompBasisType',
			'foreignKey' => 'comp_basis_name'
		)
	);
}