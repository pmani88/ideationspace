var triz_parameters;
var triz_matrices;
var url;
$(document).ready(function() {
	url = location.pathname.split("/");
	if(url.length == 6)	url = "../../../";
	else url = "../../";
	
	// variable for working principles
	$.getJSON(url+'triz_parameters/index.json', function(data) {
		triz_parameters = data['TrizParameters'];
		
		populate_feature_menues();

	});

	$('#improving_feature').change(function(){
		if($('#improving_feature').val() != -1 &&
		   $('#worsening_feature').val() != -1){
			clear_principle();
			populate_recommendations();
		}
	});
	
	$('#worsening_feature').change(function(){
		if($('#improving_feature').val() != -1 &&
		   $('#worsening_feature').val() != -1){
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
	
	function populate_feature_menues(){
		var improving_options = $('#improving_feature');
		var worsening_options = $('#worsening_feature');
		
		improving_options.html("");
		worsening_options.html("");
		
		improving_options.append($("<option />").val(-1).text(""));
		worsening_options.append($("<option />").val(-1).text(""));
		
		$.each(triz_parameters, function(index, element) {
		    improving_options.append($("<option />").val(element['TrizParameter']['id']).text(element['TrizParameter']['name']));
			worsening_options.append($("<option />").val(element['TrizParameter']['id']).text(element['TrizParameter']['name']));
		});
	}
	
	function populate_recommendations(){
		var options = $('#triz_recommendations');
		
		options.html("");
		
		options.append($("<option />").val(-1).text(""));
		
		improving = $('#improving_feature').val();
		worsening = $('#worsening_feature').val();
		
		$.getJSON(url+'triz_matrices/get_principles/' + improving + '/' + worsening + '.json', function(data) {
			triz_matrices = data['TrizMatrices'];
			
			$.each(triz_matrices, function(index, element) {
				options.append($("<option />").val(element['Principle']['id']).text(element['Principle']['name']));
			});
			
		});
		

	}
	
	function populate_menu(){
		clear_working_principle();
		var options = $("#working_principle");
		options.html("");
		options.append($("<option />").val(-1).text(""));
		//console.log(physical_effects);
		$.each(working_principles, function(index, element) {
			//console.log(this);
			//console.log(element);
		    options.append($("<option />").val(index).text(element['WorkingPrinciple']['name']));
		});
	}
});