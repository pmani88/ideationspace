$( document ).ready(function() {
	/* Auto-Populate Solution in Morph Chart */
	$('#MorphChartSolutionSubmit').button();
	$('#MorphChartSolutionSubmit').click(function() { 
		var session_id = $(".add_solution_form").attr("session_id");
		var pid = $("#MorphChartSolutionProblemId").val();
		var name = $("#MorphChartSolutionName").val();
		var type = $("#MorphChartSolutionSOI").attr("alt");
		var soi = $("#MorphChartSolutionSOI").val();
		if(!name){
			alert("Please enter Name for solution.");
			return false;
		}
		if(!soi){
			alert("Please select a solution for the problem.");
			return false;
		}
		var url = location.pathname.split("/");
		if(url.length == 6)	url = "../../../";
		else if(url.length == 7) url = "../../../../";
		
		$.get(url+"user_sessions/auto_add_solution/"+session_id+"/"+pid+"/"+name+"/"+type+"/"+encodeURIComponent(soi), function(d){
			location.reload();
		});
	});
});
