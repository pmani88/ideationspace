$(function(){

	var sketchpad = Raphael.sketchpad("editor", {
		width: 400,
		height: 400,
		strokes: eval($("#MorphChartSolutionGraphicDocument").val()),
		editing: true
	});

	// When the sketchpad changes, update the input field.
	sketchpad.change(function() {
		if(sketchpad.json()!= "[]")
			$("#MorphChartSolutionGraphicDocument").val(sketchpad.json());
		else
			$("#MorphChartSolutionGraphicDocument").val('');
	});
	
	$('#undo').button();
	$('#undo').click(function(){
		sketchpad.undo();
	});
	
	$('#redo').button();
	$('#redo').click(function(){
		sketchpad.redo();
	});
	
	$('#clear').button();
	$('#clear').click(function(){
		sketchpad.clear();
	});
	
	$('#eraser').button();
	$('#eraser').click(function(){
		sketchpad.editing("erase");
	});
	
	$('#pen').button();
	$('#pen').click(function(){
		sketchpad.editing(true);
	});
});
