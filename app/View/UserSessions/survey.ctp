<?php $this->extend('navigation'); ?>
<h2>Survey</h2>
<?php echo $this->Form->create('SatisfactionSurvey');?>
    <fieldset>
    <?php
		echo $this->Form->input('ideation_block_id', array('options' => $IdeationBlocks));
		
		echo $this->Form->input('ideation_method_id', array('options' => $IdeationMethods));

        $options=array('low'=>'Low','med'=>'Medium', 'high' =>'High');
		$attributes=array('legend'=>'Are your functional requirements satisfied?', 'default' => 'low');
		echo $this->Form->radio('functional_requirements_satisfied',$options,$attributes);
		
		$attributes=array('legend'=>'Are your non-functional requirements satisfied?', 'default' => 'low');
		echo $this->Form->radio('non_functional_requirements_satisfied',$options,$attributes);
		
		$attributes=array('legend'=>'Are your ergonomic requirements satisfied?', 'default' => 'low');
		echo $this->Form->radio('ergonomic_requirements_satisfied',$options,$attributes);
		
		$attributes=array('legend'=>'Time spent in this idea generation cycle?', 'default' => 'low');
		echo $this->Form->radio('time_spent',$options,$attributes);
		
		$options=array('Not at all'=>'Not at all','No'=>'No', 'Maybe' =>'Maybe', 'Yes' => 'Yes', 'Of course, Yes' => 'Of course, Yes');
		$attributes=array('legend'=>'Would you recommend using this ideation strategy again fro the same ideation block?', 'default' => 'Not at all');
		echo $this->Form->radio('recommendation',$options,$attributes);
		
		$options=array('Very poor'=>'Very poor','Poor'=>'Poor', 'Neutral' =>'Neutral', 'Rich' => 'Rich', 'Very Rich' => 'Very Rich');
		$attributes=array('legend'=>'How was the richness of data in the ideation tool?', 'default' => 'Very poor');
		echo $this->Form->radio('richness',$options,$attributes);
		
		echo $this->Form->input('state_of_mind', array(
			'label' => 'Describe your state of mind in a few words (Perception of problem, satisfaction with outcomes):'));
		
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>