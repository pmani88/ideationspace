var physical_effects;
var url;
$(document).ready(function() {
	url = location.pathname.split("/");
	if(url.length == 6)	url = "../../../";
	else url = "../../";
	
	$.getJSON(url+'physical_effects/index.json', function(data) {
		physical_effects = data['PhysicalEffects'];
	});
	
	$('input:radio[name=method]').change(function(){
		/* Auto-Populate Solution in Morph Chart */
		if($(".add_solution_form").length) $("#MorphChartSolutionSOI").val("");
		
		clear_physical_effect();
		if($('input:radio[name=method]:checked').val() == 'name'){
			$('#name_title_heading').html("Name");
			$('#name_title').html('<select id="physical_effect"></select><div id="search_button">Search</div>');
			populate_menu();
			$('#search_button').button();
			
			$('#search_button').click(function(){
				$.getJSON(url+'physical_effects/track_by_id/' + $('#physical_effect').val() + '/' + $('#distance').val() + '.json', function(data) {
					physical_effect = data['PhysicalEffect'];
					load_physical_effect(physical_effect);
				});
			});
		}
		else{
			$('#name_title_heading').html("Keyword");
			$('#name_title').html('<input id="keyword"/><div id="search_button">Search</div>');
			$('#search_button').button();
			
			$('#search_button').click(function(){
				$.getJSON(url+'physical_effects/track_by_keyword/' + $('#keyword').val() + '/' + $('#distance').val() + '.json', function(data) {
					physical_effect = data['PhysicalEffect'];
					load_physical_effect(physical_effect);
				});
			});
		}
	});
});

function load_physical_effect(pe){
	$('#name').html(pe['PhysicalEffect']['name']);
	$('#pe_description').html(pe['PhysicalEffect']['description']);
	$('#pe_equations').html("<ul>");
	$('#pe_parameters').html("<ul>");
	$.each(pe['Equation'], function(index, element) {
		$('#pe_equations ul').append("<li>" + element['name'] + "</li>");
		$.getJSON(url+'equations/view/' + element['id'] + '.json', function(data) {
			$.each(data['Equation']['PhysicalParameter'], function(index,element){
				if($('#pe_parameters ul li:contains("' + element['name'] + '")').length == 0)
					$('#pe_parameters ul').append("<li>" + element['name'] + "</li>");
			});
		});
	});
	
	$('#pe_medium').html(pe['PhysicalEffect']['medium']);
	$('#pe_working_principles').html("<ul>");
			$.each(pe['WorkingPrinciple'], function(index,element){
							$('#pe_working_principles ul').append("<li>" + element['name'] + "</li>");
					});
	
	/* Auto-Populate Solution in Morph Chart */
	if($(".add_solution_form").length){
		$("#MorphChartSolutionSOI").val(pe['PhysicalEffect']['name']);
	}
}

function clear_physical_effect(){
	//$('#pe_name').html("");
	$('#pe_description').html("");
	$('#pe_equations').html("");
	$('#pe_parameters').html("");
	$('#pe_medium').html("");
	$('#pe_working_principles').html("");
}

function populate_menu(){
	var options = $("#physical_effect");
	options.html("");
	options.append($("<option />").val(-1).text(""));

	$.each(physical_effects, function(index, element) {
    	options.append($("<option />").val(index).text(element['PhysicalEffect']['name']));
	});
}