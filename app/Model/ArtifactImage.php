<?php
// app/Model/Model.php
class ArtifactImage extends AppModel {
	
    public $name = 'ArtifactImage';

	public $belongsTo = array(
		'Artifact' => array(
			'className' => 'Artifact',
			'foreignKey' => 'artifact_id'
		)
	);
}