/* Script for Printing Complete solution set */
function print_solution(elem) {

	var session_name = $("#session_name").html();
	var user_name = $("#user_name").html();
	var prob_stmt = $("#prob_stmt").html();
	var solution_set = $(elem).parent().html();
	
	var newWin = window.open('','_blank');
	newWin.document.write("<center>"+session_name+"</center>");
	newWin.document.write("<center>"+user_name+"</center>");
	newWin.document.write(prob_stmt);
	
	if(!$(elem).parent().attr("id"))
		newWin.document.write('<h2>Complete Solution Set</h2>');
	
	newWin.document.write(solution_set);
	newWin.document.close();
	newWin.focus();
	newWin.print();
}