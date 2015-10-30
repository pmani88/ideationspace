// variable for physical effects
var physical_effects;
var function_verbs;
var flow_variables;
var url;
$(document).ready(function() {
	url = location.pathname.split("/");
	if(url.length == 6)	url = "../../../";
	else url = "../../";
	
	// get data
	$.getJSON(url+'physical_effects/index.json', function(data) {
		physical_effects = data['PhysicalEffects'];
	});
	
	$.getJSON(url+'funcs/index.json', function(data) {
		function_verbs = data['Funcs'];
		var options = $("#function_verb");
		options.html("");
		options.append($("<option />").val(-1).text(""));

		$.each(function_verbs, function(index, element) {
	    	options.append($("<option />").val(index).text(element['Func']['name']));
		});
	});
	$.getJSON(url+'flow_variables/index.json', function(data) {
	 	flow_variables = data['FlowVariables'];
	});
	
	// bind flow_variable_type radio
	$("input:radio[name=flow_variable_type]").change(function(event) {
		populate_flow_variables();
	});
	
	// bind the change of either function of flow
	$("#function_verb").change(function(){
		//populate_menu();
		populate_flow_variables();
	});
	$("#flow_variable").change(function(){
		populate_menu();
	});
	
	function populate_flow_variables(){
		// clear a currently selected physical effect
		clear_physical_effect();
		
		// clear out the physical effects selector because it depends on the flow variable
		$('#physical_effects').html('');
		
		// get the flow variable type
		flow_variable_type = $("input:radio[name=flow_variable_type]:checked").val();
		
		// get selected function verb
		selected_function_verb = $('#function_verb').val();
		
		// if the flow variable type is undefined or function verb not selected then return nothing.
		if(flow_variable_type == undefined || selected_function_verb == -1)
			return;
			
		// get list of flow variables
		var acceptable = [];
		
		for(var i = 0; i < function_verbs[selected_function_verb]['HighFunctionsWorkingPrinciples'].length; i++){
			acceptable.push(function_verbs[selected_function_verb]['HighFunctionsWorkingPrinciples'][i]['flow_variable_id']);
		}
			
		var options = $("#flow_variable");
		options.html("");
		options.append($("<option />").val(-1).text(""));
		$.each(flow_variables, function(index, element) {
			if(element['FlowVariable']['category'] == flow_variable_type && contains(element['FlowVariable']['id'], acceptable))
		    	options.append($("<option />").val(index).text(element['FlowVariable']['name']));
		});

	}

	// bind with the select menu
	$("#physical_effects").change(function(){
		
		pe_id = $('#physical_effects').val();
		var id = -1;
		
		for(var i = 0; i < physical_effects.length; i++){
			if(physical_effects[i]['PhysicalEffect']['id'] == pe_id){
				id = i;
				break;
			}		
		}
		
		/* Auto-Populate Solution in Morph Chart */
		var auto_addsoln = false;
		if($(".add_solution_form").length){
			auto_addsoln = true;
		}
		
		if(id == -1){
			clear_physical_effect();
			/* Auto-Populate Solution in Morph Chart */
			if(auto_addsoln) $("#MorphChartSolutionSOI").val("");
		}else{
			$('#pe_name').html(physical_effects[id]['PhysicalEffect']['name']);
			$('#pe_description').html(physical_effects[id]['PhysicalEffect']['description']);
			$('#pe_equations').html("<ul>");
			$('#pe_parameters').html("<ul>");
			$.each(physical_effects[id]['Equation'], function(index, element) {
				$('#pe_equations ul').append("<li>" + element['name'] + "</li>");
				$.getJSON(url+'equations/view/' + element['id'] + '.json', function(data) {
					$.each(data['Equation']['PhysicalParameter'], function(index,element){
						if($('#pe_parameters ul li:contains("' + element['name'] + '")').length == 0)
							$('#pe_parameters ul').append("<li>" + element['name'] + "</li>");
					});
				});
			});

			$('#pe_medium').html(physical_effects[id]['PhysicalEffect']['medium']);
//			alert(physical_effects[id]['WorkingPrinciple']);


			$('#pe_working_principles').html("<ul>");
			$.each(physical_effects[id]['WorkingPrinciple'], function(index,element){
							$('#pe_working_principles ul').append("<li>" + element['name'] + "</li>");
					});
			
			
			
					
			/* Auto-Populate Solution in Morph Chart */
			if(auto_addsoln) $("#MorphChartSolutionSOI").val(physical_effects[id]['PhysicalEffect']['name']);
		}
	});
	
	function clear_physical_effect(){
		//$('#pe_name').html("");
		$('#pe_description').html("");
		$('#pe_equations').html("");
		$('#pe_parameters').html("");
		$('#pe_medium').html("");
		$('#pe_working_principles').html("");
	}
	
	function populate_menu(){
		clear_physical_effect();
		
		var func_id = function_verbs[$('#function_verb').val()]['Func']['id'];
		var flow_variable_index = $('#flow_variable').val()
		//var flow_variable_id = flow_variables[flow_variable_index]['FlowVariable']['id'];
		
		var options = $("#physical_effects");
		options.html("");
		options.append($("<option />").val(-1).text(""));
		
		$.each(flow_variables[flow_variable_index]['PhysicalEffect'], function(index, element) {
	    	options.append($("<option />").val(element['id']).text(element['name']));
		});
	}
	
	// helper function
	function contains(e, arr){
		for(var i = 0; i < arr.length; i++){
			if(e == arr[i])
				return true;
		}
		return false;
	}
});