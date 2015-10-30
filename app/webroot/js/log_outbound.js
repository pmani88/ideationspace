function log(entry){
	var url = window.location.pathname + '.json';
	$.getJSON(url, function(data) {
		UserSession = data['UserSession'];
		$.post('../../log_entries/add.json',{'LogEntry[session_id]' : UserSession['UserSession']['id'], 'LogEntry[entry]' : entry});
	});
}

$(function(){
	$('a[target="_blank"]').click(function(){
		log("Outbound link to: " + $(this).attr('href'));
	});
});