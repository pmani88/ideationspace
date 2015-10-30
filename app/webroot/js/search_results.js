var dataArray;

$( document ).ready(function() {
    dataArray = JSON.parse($('div#search_result').text());
});

function mechanisms_results(id, element){
	$('div#search_results').html('');
	var result = dataArray[id]['Mechanism'];
	var htmlstr = '';
	
	htmlstr += '<table style="width: 70%;">';

	htmlstr += '<tr><th>RESULT</th></tr>'
	htmlstr += '<tr><td><b>Name</b></td><td>: '+result["NAME"]+'</td></tr>';
	htmlstr += '<tr><td><b>Link</b></td><td>: <a href="'+result["LINK"]+'" target="_blank">'+result["LINK"]+'</td></tr>';
	htmlstr += '<tr><td><b>Group</b></td><td>: '+result["GROUP"]+'</td></tr>';
	htmlstr += '<tr><td><b>Components</b></td><td>: '+result["MCI"]+'</td></tr>';
	htmlstr += '<tr><td><b>Function</b></td><td>: '+result["Function"]+'</td></tr>';

	htmlstr += '</table><table style="width: 70%;">'

	htmlstr += '<tr><td><b>Input Type</b></td><td>: '+result["IPTYPE"]+'</td><td><b>Output Type</b></td><td>: '+result["OPTYPE"]+'</td></tr>';
	htmlstr += '<tr><td><b>Input Speed</b></td><td>: '+result["IPSPEED"]+'</td><td><b>Output Speed</b></td><td>: '+result["OPSPEED"]+'</td></tr>';
	htmlstr += '<tr><td><b>Input Velocity Direction</b></td><td>: '+result["IPVELOCITYDIRECTION"]+'</td><td><b>Output Velocity Direction</b></td><td>: '+result["OPVELOCITYDIRECTION"]+'</td></tr>';

	htmlstr += '</table><table style="width: 70%;">'

	htmlstr += '<tr><td><b>Relation between Input & Output line of motion</b></td><td>'+result["RELBETWNIPAX"]+'</td></tr>';
	htmlstr += '<tr><td><b>Reversibility</b></td><td>'+result["REVERSIBILITY"]+'</td></tr>';
	htmlstr += '<tr><td><b>DOF</b></td><td>'+result["DOF"]+'</td></tr>';
	htmlstr += '<tr><td><b>Dimension</b></td><td>'+result["Dimension"]+'</td></tr>';
	
	htmlstr += '</table>';
	
	$('div#search_results').html(htmlstr);
	$('#MorphChartSolutionSOI').val($(element).text());
}

function cots_results(id, element){
	$('div#search_results').html('');
	var result = dataArray[id]['Cot'];
	var htmlstr = '';
	
	htmlstr += '<table style="width: 70%;">';

	htmlstr += '<tr><th>RESULT</th></tr>'
	htmlstr += '<tr><td><b>Name</b></td><td>: '+result["NAME"]+'</td></tr>';
	htmlstr += '<tr><td><b>Category</b> </td><td>: '+result["CATEGORY"]+'</td></tr>';
	htmlstr += '<tr><td><b>Machine Elements Category</b></td><td>: '+result["MACHINEELEMENTCATEGORY"]+'</td></tr>';
	htmlstr += '<tr><td><b>Function</b> </td><td>: '+result["FUNCTION"]+'</td></tr>';

	htmlstr += '<tr><td><b>Related Physical Effects</b> </td><td>: '+result["PHYID"]+'</td></tr>';
	
	htmlstr += '</table><table style="width: 70%;">'

	htmlstr += '<tr><td><b>Input Type</b></td><td>: '+result["IPTYPE"]+'</td><td><b>Output Type</b></td><td>: '+result["OPTYPE"]+'</td></tr>';
	htmlstr += '<tr><td><b>Input Speed</b></td><td>: '+result["IPSPEED"]+'</td><td><b>Output Speed</b></td><td>: '+result["OPSPEED"]+'</td></tr>';
	htmlstr += '<tr><td><b>Input Velocity Direction</b></td><td>: '+result["IPVELOCITYDIRECTION"]+'</td><td><b>Output Velocity Direction</b></td><td>: '+result["OPVELOCITYDIRECTION"]+'</td></tr>';

	htmlstr += '</table><table style="width: 70%;">'

	htmlstr += '<tr><td><b>Relation between Input & Output line of motion</b></td><td>: '+result["RELATION"]+'</td></tr>';
	
	var url = window.location.pathname.split('/');
	if(url.length == 6)
		htmlstr += '<tr><td><b>Image</b> </td><td><img width="250px" height="auto" src="../../../img/cots/'+result["IMAGE"]+'"/></td></tr>';
	else if(url.length == 7)
		htmlstr += '<tr><td><b>Image</b> </td><td><img width="250px" height="auto" src="../../../../img/cots/'+result["IMAGE"]+'"/></td></tr>';
	else
		htmlstr += '<tr><td><b>Image</b> </td><td><img width="250px" height="auto" src="../../img/cots/'+result["IMAGE"]+'"/></td></tr>';
	
	htmlstr += '</table>';
	
	$('div#search_results').html(htmlstr);
	$('#MorphChartSolutionSOI').val($(element).text());
}
 