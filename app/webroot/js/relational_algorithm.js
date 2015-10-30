var conjunctions;

$(function(){
	// variable for working principles
	$.getJSON('../../conjunctions/index.json', function(data) {
		conjunctions = data['Conjunctions'];
		populate_menu();
	});
	
	$("#conjunctions").change(function(){
		$("#stimulus-word").html("");
		$("#stimulus-image").html("");
		
		var image_number = Math.floor((Math.random()*parseInt(conjunctions[$('#conjunctions').val()]['Conjunction']['number_of_images']))+1);
		var word_number = Math.floor((Math.random()*conjunctions.length));
		
		$("#stimulus_word").html(conjunctions[word_number]['Conjunction']['name']);
		$("#stimulus_image").html('<img width="300px" src="../../img/relational_algorithm/' + conjunctions[$('#conjunctions').val()]['Conjunction']['name'] + image_number + '.jpg"></img>');
		
	});
});

function populate_menu(){
	var options = $("#conjunctions");
	options.html("");
	options.append($("<option />").val(-1).text(""));
	$.each(conjunctions, function(index, element) {
	    options.append($("<option />").val(index).text(element['Conjunction']['name']));
	});
}