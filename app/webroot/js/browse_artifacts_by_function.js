var artifacts;
var functions;

$(document).ready(function() {
	
	// variable for working principles
	$.getJSON('../../subfunction_types/index.json', function(data) {
		functions = data['SubfunctionTypes'];
		populate_functions_menu();
	});
	
	$('#functions').change(function(){
		fid = $('#functions').val();
		
		if(fid == -1){
			clear_artifact();
			$('#artifacts').html("");
		}
		else{
			var options = $("#artifacts");
			options.html("");
			
			options.append($("<option />").val(-1).text(""));
			
			$.each(functions[fid]['OsuFunctions'],function(index,element){
				$.getJSON('../../artifacts/view/' + element['describes_artifact'] + '.json', function(data) {
					if($('#artifacts option[value="' + data['Artifact']['Artifact']['id'] + '"]').length == 0)
						options.append($("<option />").val(data['Artifact']['Artifact']['id']).text(data['Artifact']['Artifact']['name']));
				});
			});
		}
	});

	// bind with the select menu
	$("#artifacts").change(function(){
		clear_artifact();
		
		id = $('#artifacts').val();
		
		if(id == -1)
			clear_artifact();
		else{
			$.getJSON('../../artifacts/view/' + id + '.json', function(data) {
				
				if(data['Artifact']['Artifact']['parent_artifact']){
					$('#parent_artifact').html(data['Artifact']['ParentArtifact']['name']);
				}
				
				$('#description').html(data['Artifact']['Artifact']['description']);
				
				$('#component').html(data['Artifact']['CompBasis']['component']);
				
				if(data['Artifact']['ArtifactImage']['image_file_name'])
					$('#artifact_image').html("<img width='400px' src='../../app/webroot/img/osu_images/" + data['Artifact']['ArtifactImage']['image_file_name'] + ".jpg'</img>");
			
				console.log("image should have loaded");
				$('#subfunctions').html("<ul></ul>");
				$.each(data['Artifact']['Functions'], function(index,element){
					$.getJSON('../../subfunction_types/view/' + element['subfunction_type'] + '.json', function(data) {
						if($('#subfunctions ul li:contains("' + data['SubfunctionType']['SubfunctionType']['subfunction'] + ': ' + 
							data['SubfunctionType']['SubfunctionType']['definition'] + '")').length == 0){
							$('#subfunctions ul').append("<li>" + data['SubfunctionType']['SubfunctionType']['subfunction'] + ': ' + 
								data['SubfunctionType']['SubfunctionType']['definition'] + "</li>");
						}
					});
				});
				
				$('#manufacturing_information').html(data['Artifact']['Artifact']['manufacturer']);
				
				$('#failure_information').html("<ul></ul>");
				$.each(data['Artifact']['Failures'], function(index,element){
					$.getJSON('../../failure_types/view/' + element['failure'] + '.json', function(data) {
						if($('#failure_information ul li:contains("' + data['FailureType']['FailureType']['failure'] + ': ' + data['FailureType']['FailureType']['definition'] + '")').length == 0)
							$('#failure_information ul').append('<li>' + data['FailureType']['FailureType']['failure'] + ': ' + data['FailureType']['FailureType']['definition'] + '</li>');
					});
				});
				
				$('#input_artifacts').html("<ul></ul>");
				$('#input_flows').html("<ul></ul>");
				$('#output_artifacts').html("<ul></ul>");
				$('#output_flows').html("<ul></ul>");
				$.each(data['Artifact']['Functions'],function(index,element){
					$.getJSON('../../osu_functions/view/' + element['id'] + '.json', function(data) {
						$.each(data['OsuFunction']['Flows'], function(index,element){
							$.getJSON('../../artifacts/view/' + element['input_artifact'] + '.json', function(data) {
								if($('#input_artifacts ul li:contains("' + data['Artifact']['Artifact']['name'] + '")').length == 0)
									$('#input_artifacts ul').append("<li>" + data['Artifact']['Artifact']['name'] + "</li>");
							});
							$.getJSON('../../artifacts/view/' + element['output_artifact'] + '.json', function(data) {
								if($('#output_artifacts ul li:contains("' + data['Artifact']['Artifact']['name'] + '")').length == 0)
									$('#output_artifacts ul').append("<li>" + data['Artifact']['Artifact']['name'] + "</li>");
							});
							$.getJSON('../../flow_types/view/' + element['input_flow'] + '.json', function(data) {
								if($('#input_flows ul li:contains("' + data['FlowType']['FlowType']['flow'] + ": " + data['FlowType']['FlowType']['definition'] + '")').length == 0)
								$('#input_flows ul').append("<li>" + data['FlowType']['FlowType']['flow'] + ": " + data['FlowType']['FlowType']['definition'] + "</li>");
							});
							$.getJSON('../../flow_types/view/' + element['output_flow'] + '.json', function(data) {
								if($('#output_flows ul li:contains("' + data['FlowType']['FlowType']['flow'] + ": " + data['FlowType']['FlowType']['definition'] + '")').length == 0)
								$('#output_flows ul').append("<li>" + data['FlowType']['FlowType']['flow'] + ": " + data['FlowType']['FlowType']['definition'] + "</li>");
							});
						});
					});
				});
			
			});
		}
	});
	
	function clear_artifact(){
		//$('#artifact_name').html("");
		$('#parent_artifact').html("");
		$('#description').html("");
		$('#components').html("");
		$('#artifact_image').html("");
		$('#input_artifacts').html("");
		$('#input_flows').html("");
		$('#subfunctions').html("");
		$('#output_flows').html("");
		$('#output_artifacts').html("");
		$('#manufacturing_information').html("");
		$('#failure_information').html("");
	}
	
	function populate_functions_menu(){
		var options = $("#functions");
		options.html("");
		options.append($("<option />").val(-1).text(""));
		$.each(functions, function(index, element) {
		    options.append($("<option />").val(index).text(element['SubfunctionType']['subfunction']));
		});
	}
	
	function populate_menu(){
		clear_artifact();
		var options = $("#artifacts");
		options.html("");
		options.append($("<option />").val(-1).text(""));
		$.each(artifacts, function(index, element) {
		    options.append($("<option />").val(element['Artifact']['id']).text(element['Artifact']['name']));
		});
	}
});