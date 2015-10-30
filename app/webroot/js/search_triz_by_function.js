var functions;
var function_triz;
var url;
$(document).ready(function() {
	url = location.pathname.split("/");
	if(url.length == 6)	url = "../../../";
	else url = "../../";
	
	// variable for working principles
	$.getJSON(url+'funcs/index.json', function(data) {
		functions = data['Funcs'];
		
		populate_functions();

	});

	$('#function_verb').change(function(){
		if($('#function_verb').val() != -1){
			clear_principle();
			populate_recommendations();
		}
	});

	$('#triz_recommendations').change(function(){
		if($('#triz_recommendations').val() != -1){
			load_principle();
		}
	});
	
	// TODO -- add this information to the database and query it there.
	function load_principle(){
		var id = parseInt($('#triz_recommendations').val());
		$('#pictures').html("<img src='"+url+"app/webroot/img/triz_data/" + id + ".JPG'></img>");
		
		$.get(url+'app/webroot/img/triz_data/' + id + ".txt", function(data) {
		  $('#description').html(data);
		});
		
		$.get(url+'app/webroot/img/triz_data/bio_' + id + ".txt", function(data) {
		  $('#biological_solution').html(data);
		});
		
		/* Auto-Populate Solution in Morph Chart */
		if($(".add_solution_form").length){
			$("#MorphChartSolutionSOI").val($("#triz_recommendations option:selected").text());
		}
	}
	
	function clear_principle(){
		$('#description').html("");
		$('#biological_solution').html("");
		$('#pictures').html("");
		
		/* Auto-Populate Solution in Morph Chart */
		if($(".add_solution_form").length) $("#MorphChartSolutionSOI").val("");
	}
	
	function populate_functions(){
		var options = $('#function_verb');
		
		options.html("");
		
		options.append($("<option />").val(-1).text(""));
		
		$.each(functions, function(index, element) {
			//console.log(element);
			options.append($("<option />").val(element['Func']['id']).text(element['Func']['name']));
		});

	}
	
	function populate_recommendations(){
		var options = $('#triz_recommendations');
		
		options.html("");
		
		options.append($("<option />").val(-1).text(""));
		
		function_id = $('#function_verb').val();
		
		$.getJSON(url+'function_trizs/get_principles/' + function_id + '.json', function(data) {
			function_trizs = data['FunctionTrizs'];
			
			$.each(function_trizs, function(index, element) {
				options.append($("<option />").val(element['Principle']['id']).text(element['Principle']['name']));
			});
			
		});
	}
});