// script for saving solutions manually
$(function(){
	save_solutions();
});

function save_solutions() {
	$("#save_soln").button();
	$("#save_soln").click(function(){ 
		var selectionArr = []; i=0;
		$("input").each(function(){
			selectionArr[i] = [];
			if($(this).is(":checked")){
				selectionArr[i]['sid'] = $(this).val();
				selectionArr[i]['val'] = 1;
			} else {
				selectionArr[i]['sid'] = $(this).val();
				selectionArr[i]['val'] = 0;
			}
			i++;
		});
		for(var key in selectionArr) {
			$.get("../../save_solutions_manually/"+selectionArr[key]['sid']+"/"+selectionArr[key]['val'], function(d){
				console.log(d);
			});
		}
	});
}