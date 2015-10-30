<?php
// app/Model/Model.php
class MorphChartImage extends AppModel {
	
    public $name = 'MorphChartImage';

    public $belongsTo = array(
		'MorphChartSolution' => array(
            'className'    => 'MorphChartSolution',
            'foreignKey'   => 'morph_chart_solution_id'
        )
    );


}