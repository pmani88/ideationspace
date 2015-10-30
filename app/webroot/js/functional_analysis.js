var formulas;
var variables = [];

$(document).ready(function() {

	$.getJSON('../../formulas/index.json', function(data) {
		formulas = data['Formulas'];
		populate_drop_down();
	});
	
	$("#predefined_functions").change(function(){
		if($("#predefined_functions").val() != -1){
			$("#function").val($("#predefined_functions").val());
			create_user_input();
		}
	});
	
	$("#function").change(function(){
		create_user_input();
	});
	
	$("#button").click(function(){
		var product = 1;
		$.each(variables,function(index,element){
			product = product * $("#variable_" + element).val();
		});
		
		console.log(product);
	})
	
});

function populate_drop_down(){
	var options = $("#predefined_functions");
	options.append($("<option />").val(-1).text(""));
	$.each(formulas, function(index, element) {
	    options.append($("<option />").val(element['Formula']['equation']).text(element['Formula']['name']));
	});
}

function create_user_input(){
	equation = $('#function').val();
	right_side = equation.split('=')[1];
	console.log(right_side);
	
	$('#user_specified_values').html("");
	create_variable_input("M");
	create_variable_input("A");
}

function create_variable_input(name){
	variables.push(name);
	$('#user_specified_values').append(name + ': ');
	$('#user_specified_values').append("<input id='variable_" + name + "'/>");
}

