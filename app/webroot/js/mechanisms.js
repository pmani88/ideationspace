var triz_parameters;
var triz_matrices;

$(document).ready(function() {
	
	
	// variable for working principles
	$.getJSON('../../mechanism/index.json', function(data) {
		alert("data=".data);
		triz_parameters = data['Mechanism'];
			
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
		$('#pictures').html("<img src='../../app/webroot/img/triz_data/" + id + ".JPG'></img>");
		
		$.get('../../app/webroot/img/triz_data/' + id + ".txt", function(data) {
		  $('#description').html(data);
		});
		
		$.get('../../app/webroot/img/triz_data/bio_' + id + ".txt", function(data) {
		  $('#biological_solution').html(data);
		});
	}
	
	function clear_principle(){
		$('#description').html("");
		$('#biological_solution').html("");
		$('#pictures').html("");
	}
	
	function populate_feature_menues(){
		var improving_options = $('#improving_feature');
		var worsening_options = $('#worsening_feature');
		
		improving_options.html("");
		worsening_options.html("");
		
		improving_options.append($("<option />").val(-1).text(""));
		worsening_options.append($("<option />").val(-1).text(""));
		
		$.each(triz_parameters, function(index, element) {
		    improving_options.append($("<option />").val(index).text(element['TrizParameter']['name']));
			worsening_options.append($("<option />").val(index).text(element['TrizParameter']['name']));
		});
	}
	
	function populate_recommendations(){
		var options = $('#triz_recommendations');
		
		options.html("");
		
		options.append($("<option />").val(-1).text(""));
		
		improving = triz_parameters[$('#improving_feature').val()]['TrizParameter']['category'];
		worsening = triz_parameters[$('#worsening_feature').val()]['TrizParameter']['category'];
		
		$.getJSON('../../bio_trizs/get_principles/' + improving + '/' + worsening + '.json', function(data) {
			bio_trizs = data['BioTrizs'];
			
			$.each(bio_trizs, function(index, element) {
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