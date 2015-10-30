var UserSession;
var RootProblems;
var current_solution_set = [];
var solution_sets = {};

$(function(){
	initialize_modals();
	load_morph_chart();
});

function initialize_modals(){
	$("#MorphChartProblemAddForm select").change(function(){
		alert($(this).val());
	});
	$( "#add_problem" ).button();
	$( "#add_problem" ).click(function() { 
		$( "#modal_dialog" ).load('../../morph_chart_problems/add/' + UserSession['UserSession']['id']).dialog({
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
		$( "#modal_dialog" ).load('../../morph_chart_solutions/add/' + UserSession['UserSession']['id']).dialog({
				height: 450,
				width: 600,
				modal: true,
				draggable: false,
				resizable: false,
				title: "Add Solution"
		});
	});
	
	$( '#select_random_solution_set' ).button();
	$( '#select_random_solution_set' ).click(function(){
		//select_random_solution_set();
		$(".tbl_solutions").each(function () {
			var radios = $(this).find("input[type=radio]");
			//console.log(radios);
			if (radios.length > 0) {
				var randomnumber = Math.floor(Math.random() * radios.length);
				radios[randomnumber].checked = true;
			}
		});
	});
	/*
	$( '#save_solution' ).button();
	$( '#save_solution' ).click(function(){
		
		data = {};
		
		for(var i = 0; i < current_solution_set.length; i++){
			solutions[i] = {};
			solutions[i]['id'] = current_solution_set[i];
		}
		
		//console.log(solutions);
		
		if($('#solution_name').val() != ""){
			var data = {};
			data['SolutionSet[session_id]'] = UserSession['UserSession']['id'];
		 	data['SolutionSet[name]'] = $('#solution_name').val();
			for(var i = 0; i < current_solution_set.length; i++){
				data['MorphChartSolution[MorphChartSolution[' + i + ']]'] = {'id' : current_solution_set[i]};
			}
			
			$.post('../../solution_sets/add.json',data, function(response){
				if(response['message'] != 'Error'){
					$('#saved_solutions').prepend('<div class="solution-set" id="ss-' + response['message']['SolutionSet']['id'] + '"><h6>' + $('#solution_name').val() + '<a href="../../solution_sets/delete/' + response['message']['SolutionSet']['id'] + '" onclick="return confirm(\'Are you sure?\');">(delete)</a>' + '</h6></div>');
					solution_sets[response['message']['SolutionSet']['id']] = current_solution_set;
					$('#ss-' + response['message']['SolutionSet']['id']).append($('#current_solution').html()	);
					$('#ss-' + response['message']['SolutionSet']['id']).on('click',function(event){
						select_set(response['message']['SolutionSet']['id']);
					});
				}
				
			});
		}
	});*/
	
	$( '#save_complete_soln' ).button();
	$( '#save_complete_soln' ).click(function(){
		save_complete_soln();
	});
}

function select_set(data){
	//console.log(data);
	//console.log(solution_sets[data]);
	$.each(solution_sets[data],function(index,element){
		$('#solution-' + element + ' input').click();
		update_solution_set();
	});
}

function load_morph_chart(){
	var url = window.location.pathname + '.json';
	$.getJSON(url, function(data) {
		UserSession = data['UserSession'];
		RootProblems = data['rootproblems'];
		
		//console.log(JSON.stringify(data));
		//console.log(JSON.stringify(UserSession['MorphChartProblem']));
		
		$('#morph_chart').html("");
		/*
		$.each(UserSession['MorphChartProblem'], function(index, element){
			//console.log(index+' => '+JSON.stringify(element));
			if(element['morph_chart_problem_id'] == null){
				$('#morph_chart').append('<li class="problem"><a id="problem-link-' + element['id'] + '">' + element['name'] + '</a><a href="../../morph_chart_problems/delete/' + element['id'] + '" onclick="return confirm(\'Are you sure?\');">(delete)</a> <ul class="style-free" id="problem-' + element['id'] + '"></ul></li>');
				
				$( "#problem-link-" + element['id'] ).click(function() { 
					$( "#modal_dialog" ).load('../../MorphChartProblems/edit/' + element['id']).dialog({
							height: 450,
							width: 600,
							modal: true,
							draggable: false,
							resizable: false,
							title: "Edit Problem"
					});
				});
				
				load_morph_chart_helper(element['id']);
			}
		});
		*/
		/*
		//console.log(JSON.stringify(UserSession['SolutionSet']));
		$.each(UserSession['SolutionSet'],function(index, element){
			//console.log(JSON.stringify(element));
			
			 $('#saved_solutions').prepend('<div class="solution-set" id="ss-' + element['id'] + '"><h6>' + element['name'] + '<a href="../../solution_sets/delete/' + element['id'] + '" onclick="return confirm(\'Are you sure?\');">(delete)</a>' +'</h6></div>');
						
			// $('#ss-' + element['id']).on('click',function(event){
				// select_set(element['id']);
			// });			
			
			// $.getJSON('../../SolutionSets/view/' + element['id'] + '.json', function(data){
				// var s = []
				// $.each(data['SolutionSet']['MorphChartSolution'], function(i2,e2){
					// $.getJSON('../../MorphChartSolutions/view/' + e2['id'] + '.json', function(data2){
						// // console.log(JSON.stringify(data2['MorphChartSolution']['MorphChartSolution']));
						// $('#ss-' + element['id'] ).append('<span>' + data2['MorphChartSolution']['MorphChartSolution']['name'] + '</span><br/>');
						// s.push(e2['id']);
					// });
				// })
				// solution_sets[element['id']] = s;
			// });
			var html_str = "";
			html_str += "<tr>";
			html_str += "<td>"+element['name']+"</td>";
			html_str += "<td>";
			html_str += "<table>";
			html_str += "<tr><th>Solution Name</th><th>Description</th><th>Source of Inspiration</th></tr>";
			
			$.getJSON('../../SolutionSets/view/' + element['id'] + '.json', function(data){
				//console.log(JSON.stringify(data));
				$.each(data['SolutionSet']['MorphChartSolution'], function(i2,e2){
					//console.log(JSON.stringify(data['SolutionSet']['MorphChartSolution']));
					$.getJSON('../../MorphChartSolutions/view/' + e2['id'] + '.json', function(data2){
						html_str += "<tr>";
							html_str +="<td>"+data2['MorphChartSolution']['MorphChartSolution']['name']+"</td>";
							html_str +="<td>"+data2['MorphChartSolution']['MorphChartSolution']['text_document']+"</td>";
							html_str +="<td>"+data2['MorphChartSolution']['MorphChartSolution']['soi']+"</td>";
						html_str += "</tr>";
					});
					//console.log(html_str);
				});
			});
			html_str += "</table>";
			html_str += "</td>";
			html_str += "</tr>";
			
			$("#complete_soln_sets table#outer_table").append(html_str);
		});*/
	});
}

function update_solution_set(){
	$('#current_solution').html("");
	current_solution_set = [];
	
	$.each($('input:radio:checked'),function(index, element){
		current_solution_set.push($(element).parent().attr('id').replace('solution-',''));
		$('#current_solution').append($(element).parent().find('span').clone());
		$('#current_solution').append('<br/>');
	});
}

function load_morph_chart_helper(id){

	var html_str;
	var elm_id ='', strokes = '';
	
	// Solutions
	$.each(UserSession['MorphChartSolution'], function(index, element){
		if(element['morph_chart_problem_id'] == id){
			$.getJSON('../../morph_chart_solutions/view/' + element['id'] + '.json', function(data) {
				html_str = '';
				html_str += '<li class="solution" id="solution-' + element['id'] + '">';
				html_str += '<input name="' + element['morph_chart_problem_id'] + '" type="radio"/>';
				html_str += '<a href="../../MorphChartSolutions/edit/' + element['id'] + '" id="solution-link-' + element['id'] + '">';
				
				// Display sketch or image
				if(element['graphic_document']){
					strokes = element['graphic_document'];
					elm_id = "editor_"+element['id'];
					html_str += '<div id="'+elm_id+'" style="display: inline-block; height: 100px; width: 100px;"></div>';
				} else if(data['MorphChartSolution']['MorphChartImage'].length > 0) {
					html_str += '<img width="100px" src="../../' + data['MorphChartSolution']['MorphChartImage'][0]['file_name'] + '"></img>';
				}
				html_str += '<span>' + element['name'] + '</span></a>';
				html_str += '<a href="../../morph_chart_solutions/delete/' + element['id'] + '" onclick="return confirm(\'Are you sure?\');">(delete)</a>';
				html_str += '</li>';
				
				$("#problem-" + id).append(html_str);
				
				// Display sketch if present
				if(element['graphic_document']){
					var svg = Raphael(elm_id);
					var path_str = element['graphic_document'];
					var path = svg.path(path_str);
					var box = path.getBBox();    
					var margin = Math.max( box.width, box.height ) * 0.1;
					svg.setViewBox(box.x - margin, box.y - margin, box.width + margin * 2, box.height + margin * 2);
				}

				$("input[name='" + element['morph_chart_problem_id'] + "']").click(function(){
					//console.log(element);
					back_propogate(element['morph_chart_problem_id']);
					clear(element['morph_chart_problem_id']);
					update_solution_set();
				});
				
			});
		/*
			$( "#solution-link-" + element['id'] ).click(function() { 
				$( "#modal" ).load('../../MorphChartSolutions/edit/' + element['id']).dialog({
						height: 450,
						width: 600,
						modal: true,
						draggable: false,
						resizable: false,
						title: "Edit Solution"
				});
			});
			*/
		}
	});
	
	//Problems
	$.each(UserSession['MorphChartProblem'], function(index, element){
		if(element['morph_chart_problem_id'] == id){
			html_str = '';
			html_str += '<li class="problem">';
			html_str += '<a id="problem-link-' + element['id'] + '"><span>' + element['name'] + '</span></a>';
			html_str += '<a href="../../morph_chart_problems/delete/' + element['id'] + '" onclick="return confirm(\'Are you sure?\');">(delete)</a>';
			html_str += '<ul class="style-free" id="problem-' + element['id'] + '"></ul>';
			html_str += '</li>';
			
			$("#problem-" + id).append(html_str);
			
			$( "#problem-link-" + element['id'] ).click(function() { 
				$( "#modal_dialog" ).load('../../MorphChartProblems/edit/' + element['id']).dialog({
						height: 450,
						width: 600,
						modal: true,
						draggable: false,
						resizable: false,
						title: "Edit Problem"
				});
			});
			
			load_morph_chart_helper(element['id']);
		}
	});
}


function select_random_solution_set(){
	for(var i=0; i < UserSession['MorphChartProblem'].length; i++) {
		if(UserSession['MorphChartProblem'][i]['morph_chart_problem_id'] == null) {
			select_random_solution_set_helper(UserSession['MorphChartProblem'][i]['id']);
		}
	}
	update_solution_set();
}

function select_random_solution_set_helper(problemId){
	var solutions = [];
	var problems = [];
	
	for(var i=0; i < UserSession['MorphChartSolution'].length; i++) {
		if(UserSession['MorphChartSolution'][i]['morph_chart_problem_id'] == problemId) {
			solutions.push(UserSession['MorphChartSolution'][i]['id']);
		}
	}
	
	for(var i=0; i < UserSession['MorphChartProblem'].length; i++) {
		if(UserSession['MorphChartProblem'][i]['morph_chart_problem_id'] == problemId) {
			problems.push(UserSession['MorphChartProblem'][i]['id']);
		}
	}

	if(problems.length > 0)
		choice = Math.floor((Math.random()*(solutions.length+1))+1)-1;
	else
		choice = Math.floor((Math.random()*solutions.length)+1)-1;

	if(choice == solutions.length) {
		for(var i=0; i < problems.length; i++) {
			select_random_solution_set_helper(problems[i]);
		}
	}
	else {
		//console.log("selecting" + solutions[choice]);
		$('#solution-' + solutions[choice] + ' input').click();
	}
}



function get_solution_sets(){
	subsets = [];
	for(var i=0; i < UserSession['MorphChartProblem'].length; i++){
		if(UserSession['MorphChartProblem'][i]['morph_chart_problem_id'] == null){
			subset = get_solution_sets_helper(UserSession['MorphChartProblem'][i]['id']);
			subsets.push(subset);
		}
	}
	counters = []
	output = []
	for(var i = 0; i < subsets.length; i++){
		if(subsets[i].length == 0)
			return [];
		else{
			counters.push(0);
		}
	}
	
	//console.log(counters);
	//console.log(subsets);
	while(counters[0] < subsets[0].length){
		jointSet = [];
		for(var i = 0; i < subsets.length; i++){
			jointSet.push(subsets[i][counters[i]]);
			if(counters[i] == subsets[i].length && i > 0 && counters[i-1] < subsets[i-1].length){
				counters[i-1] += 1;
			}	
			if(i == subsets.length-1){
				counters[i] += 1;
			}	
		}
		output.push(jointSet);
	}
	return output;
}

function get_solution_sets_helper(problemId){
	return ['1', '2'];
	subsets = [];
	for(var i=0; i < UserSession['MorphChartProblem'].length; i++){
		if(UserSession['MorphChartProblem'][i]['morph_chart_problem_id'] == problemId){
			subset = get_solution_sets_helper(UserSession['MorphChartProblem'][i]['id']);
			subsets.push(subset);
		}
	}
	
	counters = []
	output = []
	for(var i = 0; i < subsets.length; i++){
		if(subsets[i].length == 0)
			return [];
		else{
			counters.push(0);
		}
	}
	
	if(subsets.length > 0){
		while(counters[0] < subsets[0].length){
			jointSet = [];
			for(var i = 0; i < subsets.length; i++){
				jointSet.push(subsets[i][counters[i]]);
				if(counters[i] == subsets[i].length && i > 0 && counters[i-1] < subsets[i-1].length){
					counters[i-1] += 1;
				}		
			}
			output.push(jointSet);
		}
	}
	
	for(var i=0; i < UserSession['MorphChartSolution'].length; i++){
		if(UserSession['MorphChartSolution'][i]['morph_chart_problem_id'] == problemId){
			output.push([UserSession['MorphChartSolution'][i]['name']]);
		}
	}
	
	return output;
}


function calculate_num_solution_sets(){
	total = 1;
	for(var i=0; i < UserSession['MorphChartProblem'].length; i++){
		if(UserSession['MorphChartProblem'][i]['morph_chart_problem_id'] == null)
			total *= calculate_num_solution_sets_helper(UserSession['MorphChartProblem'][i]['id']);
	}

	return total;
}

function calculate_num_solution_sets_helper(problemId){
	var total = 0;
	var subtotal = 1;
	var found = false;
	for(var i=0; i < UserSession['MorphChartProblem'].length; i++){
		if(UserSession['MorphChartProblem'][i]['morph_chart_problem_id'] == problemId){
			found = true;
			subtotal *= calculate_num_solution_sets_helper(UserSession['MorphChartProblem'][i]['id']);
		}
	}
	if(!found){
		subtotal = 0;
	}
	
	total += subtotal;
	
	for(var i=0; i < UserSession['MorphChartSolution'].length; i++){
		if(UserSession['MorphChartSolution'][i]['morph_chart_problem_id'] == problemId)
			total += 1;
	}
	
	return total;
}

function back_propogate(id){
	for(var i=0; i < UserSession['MorphChartProblem'].length; i++){
		if(UserSession['MorphChartProblem'][i]['id'] == id){
			//console.log(UserSession['MorphChartProblem'][i]['morph_chart_problem_id']);
			$('input[name="' + UserSession['MorphChartProblem'][i]['morph_chart_problem_id'] + '"]').prop('checked', false);
			back_propogate(UserSession['MorphChartProblem'][i]['morph_chart_problem_id']);
		}
	}
}

function clear(parentProblemId){
	for(var i=0; i < UserSession['MorphChartProblem'].length; i++){
		if(UserSession['MorphChartProblem'][i]['morph_chart_problem_id'] == parentProblemId){
			//console.log(UserSession['MorphChartProblem'][i]['morph_chart_problem_id']);
			$('input[name="' + UserSession['MorphChartProblem'][i]['id'] + '"]').prop('checked', false);
			clear(UserSession['MorphChartProblem'][i]['id']);
		}
	}
}

/* Delete manual solution set */
function delete_soln_set(set_id){
	if(confirm("Are you sure you want to delete this solution set?")){
		$.get("../../morph_chart_manual_solutions/delete_solution_set/"+set_id, function(){
			location.reload();
		});
	}
}

/* Save complete solution set */
function save_complete_soln(){
	var data = {};
	var solns_arr = [];
	var flag;
	
	$(".tbl_solutions").each(function () {
		flag = 0;
		var soln_ids = $(this).find("input[type=radio]:checked").val();
		if(!soln_ids){
			flag = 1;
			alert("Please select one solution for each problem.");
			return false;
		}
		var soln_ids_arr = soln_ids.split(',');
		
		for(var x = 0; x < soln_ids_arr.length; x++){
			solns_arr.push(soln_ids_arr[x]);
		}
	});
	
	if(flag) return false;
	
	data['SolutionSet[session_id]'] = UserSession['UserSession']['id'];
	data['SolutionSet[name]'] = prompt("Please enter a name for the solution set:", "");
	
	if(data['SolutionSet[name]'] == "" || data['SolutionSet[name]'] == null){
		alert("Please enter a name for the solution set.");
		return false;
	}
	
	for(var i = 0; i < solns_arr.length; i++){
		data['MorphChartSolution[MorphChartSolution[' + i + ']]'] = {'id' : solns_arr[i]};
	}
	
	$.post('../../solution_sets/add.json',data, function(response){
			location.reload();
	});
}