<?php
// app/Model/Model.php
class CompBasisType extends AppModel {
	
    public $name = 'CompBasisType';

	public $hasMany = array(
		'Artifacts' => array(
			'className' => 'Artifact',
			'foreignKey' => 'comp_basis_name'
		)
	);
	
	public $belongsTo = array(
		'ParentCompBasisType' => array(
			'className' => 'CompBasisType',
			'foreignKey' => 'parent_component'
		)
	);
	
	
}