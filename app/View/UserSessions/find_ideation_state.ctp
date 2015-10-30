

<?php $this->extend('navigation'); ?>
<h2>Find ideation state</h2>
<h3>Ideation state determinator</h3>
<h4>How does your problem rate on the following measures?</h4>
<div class="ideation-state-determinator">
<?php echo $this->Form->create('Ideation_state');?>
    <fieldset>
    <?php
        $options=array('low'=>'Low','med'=>'Medium', 'high' =>'High');
		$attributes=array('legend'=>'Novelty of the problem', 'default' => 'low');
		echo $this->Form->radio('problem_novelty',$options,$attributes);
		
		$attributes=array('legend'=>'Complexity of the problem (number of relations/parameters)', 'default' => 'low');
		echo $this->Form->radio('problem_complexity',$options,$attributes);
		
		$attributes=array('legend'=>'Uncertainty of the problem', 'default' => 'low');
		echo $this->Form->radio('problem_uncertainty',$options,$attributes);
		
		$options=array('low'=>'little', 'high' =>'a lot');
		$attributes=array('legend'=>'How much time have you spent during the ideation generation process?', 'default' => 'low');
		echo $this->Form->radio('process_time',$options,$attributes);
		
		/*
		$options=array('1'=>'1', '2' =>'2', '3' =>'3', '4' =>'4', '5' =>'5',
		 				'6' =>'6', '7' =>'7', '8' =>'8', '9' =>'9', '10' =>'10');
		*/
		
		$options=array('low'=>'Low','med'=>'Medium', 'high' =>'High');
		$attributes=array('legend'=>'How will you score your outcome based on quantity?', 'default' => 'low');
		echo $this->Form->radio('outcome_quantity',$options,$attributes);
		
		$attributes=array('legend'=>'How will you score your outcome based on quality?', 'default' => 'low');
		echo $this->Form->radio('outcome_quality',$options,$attributes);
		
		$attributes=array('legend'=>'How will you score your outcome based on novelty?', 'default' => 'low');
		echo $this->Form->radio('outcome_novelty',$options,$attributes);
		
		$attributes=array('legend'=>'How will you score your outcome based on variety?', 'default' => 'low');
		echo $this->Form->radio('outcome_variety',$options,$attributes);
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>