var funcs;
var flow_variables;
var working_principles;
var url;
$(document).ready(function() {
	url = location.pathname.split("/");
	if(url.length == 6)	url = "../../../";
	else url = "../../";
	
	// variable for working principles
	$.getJSON(url+'working_principles/index.json', function(data) {
		working_principles = data['WorkingPrinciples'];
		
		// variable for working principles
		$.getJSON(url+'funcs/index.json', function(data) {
			funcs = data['Funcs'];

			var options = $("#function_verb");
			options.html("");
			options.append($("<option />").val(-1).text(""));
			//console.log(physical_effects);
			$.each(funcs, function(index, element) {
			    options.append($("<option />").val(index).text(element['Func']['name']));
			});

		});

		$.getJSON(url+'flow_variables/index.json', function(data) {
			flow_variables = data['FlowVariables'];

			var options = $("#flow_variable");
			options.html("");
			options.append($("<option />").val(-1).text(""));
			//console.log(physical_effects);
			$.each(flow_variables, function(index, element) {
			    options.append($("<option />").val(index).text(element['FlowVariable']['name']));
			});
		});
	});
	
	$('#function_verb').change(function(){
		populate_menu();
	});
	
	$('#flow_variable').change(function(){
		populate_menu();
	});
	
	$('#high_relevance').change(function(){
		$('#low_relevance').val(-1);
		load_working_principle($('#high_relevance').val());
	});
	
	$('#low_relevance').change(function(){
		$('#high_relevance').val(-1);
		load_working_principle($('#low_relevance').val());
	});

	// bind with the select menu
	function load_working_principle(id){
		/* Auto-Populate Solution in Morph Chart */
		var auto_addsoln = false;
		if($(".add_solution_form").length){
			auto_addsoln = true;
		}
		
		if(id == -1){
			clear_working_principle();
			
			/* Auto-Populate Solution in Morph Chart */
			if(auto_addsoln) $("#MorphChartSolutionSOI").val("");
		}else{
			$('#description').html(working_principles[id]['WorkingPrinciple']['description']);
			
			$('#material').html(working_principles[id]['WorkingPrinciple']['material']);
			
			$('#picture').html("<img src='"+url+"img/wp_images/" + working_principles[id]['WorkingPrinciple']['picture'] + "'></img>");
			
			$('#related_physical_effects').html("<ul></ul>");
			$.each(working_principles[id]['PhysicalEffect'], function(index,element){
				$('#related_physical_effects ul').append("<li>" + element['name'] + "</li>");
			});
			
			$('#key_physical_variables').html("<ul></ul>");
			$.each(working_principles[id]['PhysicalVariable'], function(index,element){
				$.getJSON(url+'physical_parameters/view/' + element['physical_parameter_id'] + ".json", function(data) {
					$('#key_physical_variables ul').append("<li>" + data['PhysicalParameter']['PhysicalParameter']['name'] + "</li>");
				});
			});
			
			$('#example_components').html("<ul></ul>");
			$.each(working_principles[id]['WpComponent'], function(index,element){
				$('#example_components ul').append("<li>" + element['name'] + "</li>");
			});
			
			$('#functions').html(working_principles[id]['WorkingPrinciple']['functions']);
			
			$('#bio_example').html("<a href='http://www." + working_principles[id]['WorkingPrinciple']['bioexample_url'] + "' target='_blank'>" + working_principles[id]['WorkingPrinciple']['bioexample_url'] + "</a>");
			
			/* Auto-Populate Solution in Morph Chart */
			if(auto_addsoln) $("#MorphChartSolutionSOI").val(working_principles[id]['WorkingPrinciple']['name']);
		}
	}
	
	function clear_working_principle(){
		$('#description').html("");
		$('#material').html("");
		$('#picture').html("");
		$('#related_physical_effects').html("");
		$('#key_physical_variables').html("");
		$('#example_components').html("");
		$('#functions').html("");
		$('#bio_example').html("");
		
	}
	
	function populate_menu(){
		if($('#function_verb').val() == -1 || $('#flow_variable').val() == -1){
			return;
		}
		
		clear_working_principle();
		
		var highoptions = $("#high_relevance");
		highoptions.html("");
		highoptions.append($("<option />").val(-1).text(""));
		
		var lowoptions = $("#low_relevance");
		lowoptions.html("");
		lowoptions.append($("<option />").val(-1).text(""));
		
		
		$.each(funcs, function(index, element) {

			$.each(element['HighFunctionsWorkingPrinciples'], function(index, highfuncwp){
				for(var i = 0; i < working_principles.length; i++){
					if(working_principles[i]['WorkingPrinciple']['id'] == highfuncwp['working_principle_id']){
						if($('#high_relevance option[value=' + i + ']').size() == 0)
							highoptions.append($("<option />").val(i).text(working_principles[i]['WorkingPrinciple']['name']));
					}
				}
				/*
				$.getJSON(url+'working_principles/view/' + highfuncwp['working_principle_id'] + '.json', function(data) {
			    	if($('#high_relevance option[value=' + highfuncwp['working_principle_id'] + ']').size() == 0)
						highoptions.append($("<option />").val(highfuncwp['working_principle_id']).text(data['WorkingPrinciple']['WorkingPrinciple']['name']));
				});
				*/
			});

		});
		
		$.each(flow_variables, function(index, element) {

			$.each(element['HighFunctionsWorkingPrinciple'], function(index, highfuncwp){
				
				for(var j = 0; j < working_principles.length; j++){
					if(working_principles[j]['WorkingPrinciple']['id'] == highfuncwp['working_principle_id']){
						if($('#low_relevance option[value=' + j + ']').size() == 0)
							lowoptions.append($("<option />").val(j).text(working_principles[j]['WorkingPrinciple']['name']));
					}
				}
			});

			$.each(element['LowFunctionsWorkingPrinciple'], function(index, lowfuncwp){
				
				for(var k = 0; k < working_principles.length; k++){
					if(working_principles[k]['WorkingPrinciple']['id'] == lowfuncwp['working_principle_id']){
						if($('#low_relevance option[value=' + k + ']').size() == 0)
							lowoptions.append($("<option />").val(k).text(working_principles[k]['WorkingPrinciple']['name']));
					}
				}
				
				/*
				$.getJSON(url+'working_principles/view/' + highfuncwp['working_principle_id'] + '.json', function(data) {
			    	if($('#low_relevance option[value=' + highfuncwp['working_principle_id'] + ']').size() == 0)
						lowoptions.append($("<option />").val(highfuncwp['working_principle_id']).text(data['WorkingPrinciple']['WorkingPrinciple']['name']));
				});
				*/
			});

		});
		
	}
});