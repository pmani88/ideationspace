var working_principles;
var url;
$(document).ready(function() {
	url = location.pathname.split("/");
	if(url.length == 6)	url = "../../../";
	else url = "../../";
	
	// variable for working principles
	$.getJSON(url+'working_principles/index.json', function(data) {
		working_principles = data['WorkingPrinciples'];
		populate_menu();
	});

	// bind with the select menu
	$("#working_principle").change(function(){
		/* Auto-Populate Solution in Morph Chart */
		var auto_addsoln = false;
		if($(".add_solution_form").length){
			auto_addsoln = true;
		}
		
		id = $('#working_principle').val();
		
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
					console.log(data);
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
	});
	
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
		clear_working_principle();
		var options = $("#working_principle");
		options.html("");
		options.append($("<option />").val(-1).text(""));
		$.each(working_principles, function(index, element) {
		    options.append($("<option />").val(index).text(element['WorkingPrinciple']['name']));
		});
	}
});