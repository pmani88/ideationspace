// Global variables
var selectionid;
var json_data;
var problems;
var new_rootid;

function getRootId(){
	for(var key in problems){
		if(problems[key]["MorphChartProblem"]["id"] == selectionid){
			if(problems[key]["MorphChartProblem"]["root_id"] != null){
				new_rootid = problems[key]["MorphChartProblem"]["root_id"];
			} else {
				new_rootid = problems[key]["MorphChartProblem"]["id"];
			}
			break;
		}
	}
}

function findRootIdPrbAddForm(){
	selectionid = $("#MorphChartProblemAddForm select").val();
	if(selectionid == ""){
		new_rootid = null;
		$("#MorphChartProblemAddForm #MorphChartProblemRootId").val(new_rootid);
		return;
	}
	json_data = $("#MorphChartProblemAddForm #MorphChartProblemProblemsArray").val();

	problems = JSON.parse(json_data);

	getRootId();
	
	$("#MorphChartProblemAddForm #MorphChartProblemRootId").val(new_rootid);
}

function findRootIdPrbEditForm() {
	selectionid = $("#MorphChartProblemEditForm select").val();
	if(selectionid == ""){
		new_rootid = null;
		$("#MorphChartProblemEditForm #MorphChartProblemRootId").val(new_rootid);
		return;
	}
	json_data = $("#MorphChartProblemEditForm #MorphChartProblemProblemsArray").val();

	problems = JSON.parse(json_data);

	getRootId();
	
	$("#MorphChartProblemEditForm #MorphChartProblemRootId").val(new_rootid);
}



