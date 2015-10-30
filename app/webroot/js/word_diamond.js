$(function(){

	$("#generate_button").button();
	
	$("#num_words_input").change(function(){
		populate_menu($('#num_words_input').val());
	});
	
	$("#generate_button").click(function(){
		var selected = [];
		$('#result').html("");
		for(var i = 0; i < parseInt($("#num_words_to_select").val()); i++){
			var done = false;
			while(!done){
				var word_number = Math.floor((Math.random()*parseInt($("#num_words_input").val())) + 1);
				if(!contains(selected, $('#word' + word_number).val())){
					selected.push($('#word' + word_number).val());
					$('#result').append($('#word' + word_number).val() + " ");
					done = true;
				}
			}
		}
		
		
		
	});
	
});

function populate_menu(value){	
	$('#word_input').html("");
	var options = $("#num_words_to_select");
	options.html("");
	options.append($("<option />").val(0).text(""));
	for(var i = 1; i <= value; i++){
		$('#word_input').append('<input id="word' + i + '"></input>');
		options.append($("<option />").val(i).text("" + i));
	}
}

function contains(a, obj) {
    var i = a.length;
    while (i--) {
       if (a[i] === obj) {
           return true;
       }
    }
    return false;
}