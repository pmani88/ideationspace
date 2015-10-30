var url;
$(document).ready(function() {
	url = location.pathname.split("/");
	if(url.length == 6)	url = "../../../";
	else url = "../../";
	
	// variable for physical effects
	var physical_effects;
	$.getJSON(url+'physical_effects/index.json', function(data) {
		physical_effects = data['PhysicalEffects'];
	});
	
	// bind with the radio buttons
	$(".view").on("click", "#mechanical", function(event) {
		populate_menu("Mechanical");
	});
	$(".view").on("click", "#electrical", function(event) {
		populate_menu("Electrical");
	});
	$(".view").on("click", "#thermal_fluid", function(event) {
		populate_menu("Thermal/Fluid");
	});

	// bind with the select menu
	$("#physical_effects").change(function(){
		id = $('#physical_effects').val();
		
		/* Auto-Populate Solution in Morph Chart */
		var auto_addsoln = false;
		if($(".add_solution_form").length){
			auto_addsoln = true;
		}
		
		if(id == -1) {
			clear_physical_effect();
			/* Auto-Populate Solution in Morph Chart */
			if(auto_addsoln) $("#MorphChartSolutionSOI").val("");
		} else {
			//$('#pe_name').html(physical_effects[id]['PhysicalEffect']['name']);
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
			
			$('#pe_working_principles').html("<ul>:");
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
	
	function populate_menu(type){
		clear_physical_effect();
		var options = $("#physical_effects");
		options.html("");
		options.append($("<option />").val(-1).text(""));

		$.each(physical_effects, function(index, element) {

			if(element['PhysicalEffect']['field'] == type)
		    	options.append($("<option />").val(index).text(element['PhysicalEffect']['name']));
		});
	}
});