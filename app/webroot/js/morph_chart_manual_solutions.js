// script for add problem button, add solution button and saving solutions manually

var url = window.location.pathname.split( '/' );
var session = url[url.length - 2];
var pid = url[url.length - 1];

$(function(){
	initialize_modals();
	save_solutions();
});

function initialize_modals(){
	$( "#add_problem" ).button();
	$( "#add_problem" ).click(function() { 
		$( "#modal_dialog" ).load('../../../morph_chart_problems/add/' + session, function(){
				$("#MorphChartProblemAddForm select").val(pid);
			}).dialog({
			height: 450,
			width: 600,
			modal: true,
			draggable: false,
			resizable: false,
			title: "Add Problem"
		});
		
	});
	
	$( "#add_solution" ).button();
	$( "#add_solution" ).click(function() { 
		$( "#modal_dialog" ).load('../../../morph_chart_solutions/add/' + session, function(){
				//$("#MorphChartSolutionAddForm select").val(pid);
			}).dialog({
				height: 450,
				width: 600,
				modal: true,
				draggable: false,
				resizable: false,
				title: "Add Solution"
		});
	});
}

function save_solutions() {
	$("#save_soln").button();
	$("#save_soln").click(function(){ 
		var selectionArr = []; i=0;
		var soln_count = parseInt($('#soln_set_count').val());
		$("input#sub_prob_solns").each(function(){
			if($(this).is(":checked")){
				var soln_ids = $(this).val().split(',');
				for(var x = 0; x < soln_ids.length; x++){
					selectionArr[i] = [];
					selectionArr[i]['sid'] = soln_ids[x];
					selectionArr[i]['mid'] = pid+"_"+soln_count;
					i++;
				}
			} 
		});
		if(selectionArr.length){
			$('#soln_set_count').val(soln_count+1);
			for(var key in selectionArr) {
				$.get("../../../morph_chart_manual_solutions/save_solutions_manually/"+session+"/"+pid+"/"+selectionArr[key]['sid']+"/"+selectionArr[key]['mid'], function(d){
                                         location.reload();
                                });
			}
		} else {
			alert("Please select one solution for each problem.");
			return false;
		}
	});
}