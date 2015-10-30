var working_principles;
var url;
$(document).ready(function() {
	url = location.pathname.split("/");
	if(url.length == 6)	url = "../../../";
	else url = "../../";
		
	// variable for working principles
	$.getJSON(url+'working_principles/index.json', function(data) {
		working_principles = data['WorkingPrinciples'];
	});
	
	$('input:radio[name=method]').change(function(){
		/* Auto-Populate Solution in Morph Chart */
		if($(".add_solution_form").length) $("#MorphChartSolutionSOI").val("");
		
		clear_working_principle();
		if($('input:radio[name=method]:checked').val() == 'name'){
			$('#name_title_heading').html("Name");
			$('#name_title').html('<select id="working_principle"></select><div id="search_button">Search</div>');
			populate_menu();
			$('#search_button').button();
			$('#search_button').click(function(){
				$.getJSON(url+'working_principles/track_by_id/' + $('#working_principle').val() + '/' + $('#distance').val() + '.json', function(data) {
					working_principle = data['WorkingPrinciple'];
					load_working_principle(working_principle);
				});
			});
		}
		else{
			$('#name_title_heading').html("Keyword");
			$('#name_title').html('<input id="keyword"/><div id="search_button">Search</div>');
			$('#search_button').button();
			
			$('#search_button').click(function(){
				$.getJSON(url+'working_principles/track_by_keyword/' + $('#keyword').val() + '/' + $('#distance').val() + '.json', function(data) {
					working_principle = data['WorkingPrinciple'];
					load_working_principle(working_principle);
				});
			});
		}
		
		// bind with the select menu
		// $("#working_principle").change(function(){
			// $.getJSON(url+'working_principles/track_by_id/' + $('#working_principle').val() + '/' + $('#distance').val() + '.json', function(data) {
				// working_principle = data['WorkingPrinciple'];
				// load_working_principle(working_principle);
			// });
		// });
	});
	
	function load_working_principle(wp){
		
		$('#name').html(wp['WorkingPrinciple']['name']);

		$('#description').html(wp['WorkingPrinciple']['description']);
		
		$('#material').html(wp['WorkingPrinciple']['material']);
		
		$('#picture').html("<img src='"+url+"img/wp_images/" + wp['WorkingPrinciple']['picture'] + "'></img>");
		
		$('#related_physical_effects').html("<ul></ul>");
		$.each(wp['PhysicalEffect'], function(index,element){
			$('#related_physical_effects ul').append("<li>" + element['name'] + "</li>");
		});
		
		$('#key_physical_variables').html("<ul></ul>");
		$.each(wp['PhysicalVariable'], function(index,element){
			$.getJSON(url+'physical_parameters/view/' + element['physical_parameter_id'] + ".json", function(data) {
				$('#key_physical_variables ul').append("<li>" + data['PhysicalParameter']['PhysicalParameter']['name'] + "</li>");
			});
		});
		
		$('#example_components').html("<ul></ul>");
		$.each(wp['WpComponent'], function(index,element){
			$('#example_components ul').append("<li>" + element['name'] + "</li>");
		});
		
		$('#functions').html(wp['WorkingPrinciple']['functions']);
		
		$('#bio_example').html("<a href='http://www." + wp['WorkingPrinciple']['bioexample_url'] + "' target='_blank'>" + wp['WorkingPrinciple']['bioexample_url'] + "</a>");
		
		/* Auto-Populate Solution in Morph Chart */
		if($(".add_solution_form").length){
			$("#MorphChartSolutionSOI").val(wp['WorkingPrinciple']['name']);
		}
	}
	
	function clear_working_principle(){
		$('#name').html("");
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
		    options.append($("<option />").val(element['WorkingPrinciple']['id']).text(element['WorkingPrinciple']['name']));
		});
	}
});