// global variables
var UserSession;
var shapes = {};
var paper;
var links = [];
var entities = {};

// action to draw connection between 2 objects
Raphael.fn.connection = function (obj1, obj2, line, thickness, dasharray) {
	// references to this need to be removed.
	//var bg;
	
	if(!thickness){
		thickness = 2;
	}
	if(!dasharray){
		dasharray = "";
	}
	
    if (obj1.line && obj1.from && obj1.to) {
        line = obj1;
        obj1 = line.from;
        obj2 = line.to;
		dasharray = line['line']['attrs']['stroke-dasharray'];
		thickness = line['line']['attrs']['stroke-width'];
    }
    var bb1 = obj1.getBBox(),
        bb2 = obj2.getBBox(),
        p = [{x: bb1.x + bb1.width / 2, y: bb1.y - 1},
        {x: bb1.x + bb1.width / 2, y: bb1.y + bb1.height + 1},
        {x: bb1.x - 1, y: bb1.y + bb1.height / 2},
        {x: bb1.x + bb1.width + 1, y: bb1.y + bb1.height / 2},
        {x: bb2.x + bb2.width / 2, y: bb2.y - 1},
        {x: bb2.x + bb2.width / 2, y: bb2.y + bb2.height + 1},
        {x: bb2.x - 1, y: bb2.y + bb2.height / 2},
        {x: bb2.x + bb2.width + 1, y: bb2.y + bb2.height / 2}],
        d = {}, dis = [];
    for (var i = 0; i < 4; i++) {
        for (var j = 4; j < 8; j++) {
            var dx = Math.abs(p[i].x - p[j].x),
                dy = Math.abs(p[i].y - p[j].y);
            if ((i == j - 4) || (((i != 3 && j != 6) || p[i].x < p[j].x) && ((i != 2 && j != 7) || p[i].x > p[j].x) && ((i != 0 && j != 5) || p[i].y > p[j].y) && ((i != 1 && j != 4) || p[i].y < p[j].y))) {
                dis.push(dx + dy);
                d[dis[dis.length - 1]] = [i, j];
            }
        }
    }
    if (dis.length == 0) {
        var res = [0, 4];
    } else {
        res = d[Math.min.apply(Math, dis)];
    }
    var x1 = p[res[0]].x,
        y1 = p[res[0]].y,
        x4 = p[res[1]].x,
        y4 = p[res[1]].y;
    dx = Math.max(Math.abs(x1 - x4) / 2, 10);
    dy = Math.max(Math.abs(y1 - y4) / 2, 10);
    var x2 = [x1, x1, x1 - dx, x1 + dx][res[0]].toFixed(3),
        y2 = [y1 - dy, y1 + dy, y1, y1][res[0]].toFixed(3),
        x3 = [0, 0, 0, 0, x4, x4, x4 - dx, x4 + dx][res[1]].toFixed(3),
        y3 = [0, 0, 0, 0, y1 + dy, y1 - dy, y4, y4][res[1]].toFixed(3);
    var path = ["M", x1.toFixed(3), y1.toFixed(3), "C", x2, y2, x3, y3, x4.toFixed(3), y4.toFixed(3)].join(",");
    if (line && line.line) {
        //line.bg && line.bg.attr({path: path});
        line.line.attr({path: path, "arrow-end": "classic-wide-long", "stroke-width": thickness, "stroke-dasharray" : dasharray});
    } else {
        var color = typeof line == "string" ? line : "#000";
        return {
            //bg: bg && bg.split && this.path(path).attr({stroke: bg.split("|")[0], fill: "none", "stroke-width": bg.split("|")[1] || 3}),
            line: this.path(path).attr({stroke: "black", fill: "none", "arrow-end": "classic-wide-long", "stroke-width": thickness, "stroke-dasharray" : dasharray}),
            from: obj1,
            to: obj2
        };
    }
};

$(function(){
	
	paper = Raphael("raphael_gui", '100%', '100%');
	var zpd = new RaphaelZPD(paper, { zoom: true, pan: true, drag: true });
	
	var url = window.location.pathname + '.json';
	$.getJSON(url, function(data) {
		UserSession = data['UserSession'];
		initialize_modals();
		load_entities(load_links);
		
	});

	function load_entities(callback){
		for(var i = 0; i < UserSession['FunctionCadEntities'].length; i++){
			create_entity(UserSession['FunctionCadEntities'][i]);	
		}
		callback();
	}

	function load_links(){
		$.each(UserSession['FunctionCadLinks'],function(index,element){
			create_link(element);
		});
	}

});

// action to start an entity drag
var start = function(){
	// bring the object in front of all others
	this.group.toFront();

	// save its initial position
	this.group.oBB = this.group.getBBox();

	// make it semi transparent
    this.group.animate({opacity: .25}, 500, ">");
}

// action to take place at each step of the entity drag
var move = function(dx,dy){

	dragging = true;

	// move the entity a little bit.
	var bb = this.group.getBBox();
	this.group.translate(this.group.oBB.x - bb.x + dx, this.group.oBB.y - bb.y + dy);

	// update the links
	for (var i = links.length; i--;) {
		paper.connection(links[i]);
	}
	paper.safari();
}
	
var up = function () {
	this.group.animate({opacity: 1}, 500, ">");
	var bb = this.group.getBBox();
	var x = bb.x;
	var y = bb.y;

	$.post("../../function_cad_entities/edit/" + this.group.id + ".json", {"FunctionCadEntity[x]" : x, 'FunctionCadEntity[y]' : y}, function(data) {
		if(data['Message'] == "Error"){
			alert("Error saving entity location");
		}
	});	
};

function initialize_modals(){
	$( "#addEntity" ).button();
	$( "#addEntity" ).click(function() { 
		$( "#modal" ).load('../../function_cad_entities/add/' + UserSession['UserSession']['id']).dialog({
				height: 450,
				width: 600,
				modal: true,
				draggable: false,
				resizable: false,
				title: "Add Entity"
		});
	});
	
	$( "#addLink" ).button();
	$( "#addLink" ).click(function() { 
		$( "#modal" ).load('../../function_cad_links/add/' + UserSession['UserSession']['id']).dialog({
				height: 450,
				width: 600,
				modal: true,
				draggable: false,
				resizable: false,
				title: "Add Link"
		});
	});
}

function create_link(element){
	if(parseInt(element['type']) == 0)
		links.push(paper.connection(shapes[element['from_function_cad_entity_id']], shapes[element['to_function_cad_entity_id']], "#000", "3"));
	else if(parseInt(element['type']) == 2)
		links.push(paper.connection(shapes[element['from_function_cad_entity_id']], shapes[element['to_function_cad_entity_id']], "#000", "1.5"));
	else if(parseInt(element['type']) == 1)
		links.push(paper.connection(shapes[element['from_function_cad_entity_id']], shapes[element['to_function_cad_entity_id']], "#000", "2", "-"));

	entities[element['from_function_cad_entity_id']].outLinks.push(element['to_function_cad_entity_id']);
	entities[element['to_function_cad_entity_id']].inLinks.push(element['from_function_cad_entity_id']);

}

function create_entity(element){
	entities[element['id']] = element;
	entities[element['id']].outLinks = [];
	entities[element['id']].inLinks = [];
	entity = paper.set();
	entity.id = element['id'];
	width = 80;
	r = paper.rect(parseInt(element["x"]), parseInt(element["y"]), width, 40, 10);
	t = paper.text(0,0,"");
	
	name = element['name'] + " : " + element['flow'];
	// programatic word wrap
	var words = name.split(" ");
	var tempText = "";
	for (var i=0; i<words.length; i++) {
	  t.attr("text", tempText + " " + words[i]);
	  if (t.getBBox().width > width - 10) {
	    tempText += "\n" + words[i];
	  } else {
	    tempText += " " + words[i];
	  }
	}
	t.attr("text", tempText.substring(1));

	// This does left text align (if you want it).
	//t.attr({'text-anchor': 'start'})

	var tbb = t.getBBox();
	r.attr({height: 5 + tbb.height + 5});
	var rbb = r.getBBox();

	//t.attr({x: rbb.x + 10, y: rbb.y + (tbb.height / 2) + 5}); // for left align
	t.attr({x: rbb.x + rbb.width / 2, y: rbb.y + (tbb.height / 2) + 5}); // for centered
	
	r.group = entity;
	t.group = entity;
	entity.push(r);
	entity.push(t);
    r.attr({fill: "white", stroke: "black", "fill-opacity": 0, "stroke-width": 2, cursor: "move"});
    entity.drag(move, start, up);
	entities[element['id']].rjs = entity;
	shapes[element['id']] = entity;
	
	$(r.node).attr('eid', entity.id).attr('class', "entity context-menu-one");
	$(t.node).attr('eid', entity.id).attr('class', "entity context-menu-one");
}

// context Menu
$.contextMenu({
  selector: '.context-menu-one', 
  build: function($trigger) {
    var options = {
      callback: function(key, options) {
		if(key == 'rename'){			

			$( "#modal" ).load('../../function_cad_entities/edit/' + $trigger.attr('eid')).dialog({
					height: 400,
					width: 600,
					modal: true,
					draggable: false,
					resizable: false,
					title: "Edit Entity"
			});
		}
		else if(key == 'delete'){
			if(confirm("Are you sure you want to delete this entity?")){
				var newURL = '../../function_cad_entities/delete/' + $trigger.attr('eid') + '.json';
				$.getJSON(newURL, function(data) {
					if(data['message'] == 'Deleted'){
						delete_entity($trigger.attr('eid'));
					}
				});
				
			}
		}
		else if(key != 'sep1'){
			delete_link($trigger.attr('eid'), key);
			delete_link(key,$trigger.attr('eid'));
		}
      },
      items: {}
    };
	
	options.items["rename"] = {name: "Edit", icon: "edit"};
	options.items["delete"] = {name: "Delete", icon: "delete"};
	options.items['sep1'] = "-----";
	
	for (i in entities[$trigger.attr('eid')].inLinks){
		options.items[entities[$trigger.attr('eid')].inLinks[i]] = {name: "Delete link to " + entities[entities[$trigger.attr('eid')].inLinks[i]].name, icon: "delete"};			
	}
	for (i in entities[$trigger.attr('eid')].outLinks){
		options.items[entities[$trigger.attr('eid')].outLinks[i]] = {name: "Delete link to " + entities[entities[$trigger.attr('eid')].outLinks[i]].name, icon: "delete"};			
	}
	
	/*
	for(var i=0; i < entities[$trigger.attr('id')].intergroup.length; i++){
		options.items[entities[$trigger.attr('id')].intergroup[i]] = {name: "Delete link to " + entities[entities[$trigger.attr('id')].intergroup[i]].name, icon: "delete"};
	}
	*/

    return options;
  }
});

// delete a link given an from and to entity id.
function delete_link(from,to){
	// add link to database
	var newURL = '../../FunctionCadLinks/delete.json';// + problem_map['ProblemMap']['id'] + '.json';
	$.post(newURL, { from_function_cad_entity_id: from, to_function_cad_entity_id: to }, function(data){

		if(data['message'] == "Deleted"){
			// remove the link here from the links array TODO
			
			for(i in entities[from].outLinks){
				if(entities[from].outLinks[i] == to)
					entities[from].outLinks.splice(i,1);
			}
			for(i in entities[to].inLinks){
				if(entities[to].inLinks[i] == from)
					entities[to].inLinks.splice(i,1);
			}
			
			for (var i = links.length; i--;) {
				if(links[i].from.id == from && links[i].to.id == to){
					links[i].line.remove();
					links.splice(i,1);
					break;
				}
			}
			//entities[from_eid].outLinks.push(to_eid);
			//entities[to_eid].inLinks.push(from_eid);
			//redraw_groups();
		}
	} );
}

function delete_entity(eid){
	
	for(i in entities[eid].outLinks){
		for(j in entities[entities[eid].outLinks].inLinks){
			if(entities[entities[eid].outLinks].inLinks[j] == eid){
				entities[entities[eid].outLinks].inLinks.splice(j,1);
				//break;
			}
		}
	}
	for(i in entities[eid].inLinks){
		for(j in entities[entities[eid].inLinks].outLinks){
			if(entities[entities[eid].inLinks].outLinks[j] == eid){
				entities[entities[eid].inLinks].outLinks.splice(j,1);
				//break;
			}
		}
	}
	for(var i = links.length; i--;){
		if(links[i].from.id == eid || links[i].to.id == eid){
			links[i].line.remove();
			links.splice(i,1);
		}		
	}
	
	entities[eid].rjs.remove();
	delete entities[eid];
	
}

function update_entity(data){
	
	delete_entity(data['id']);
	create_entity(data);
	for (var i = links.length; i--;) {
		if(links[i].from.id == data['id']){

			links[i].from = entities[data['id']].rjs;
			paper.connection(links[i]);
		}
		else if(links[i].to.id == data['id']){
			links[i].to = entities[data['id']].rjs;
			paper.connection(links[i]);
		}
	}
}