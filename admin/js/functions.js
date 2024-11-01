var setPos = function(obj,value){	
	var radiowphclasses = document.getElementsByClassName('radio-wph');
	for (var i = 0; i < radiowphclasses.length; ++i) {
	    var item = document.getElementById(radiowphclasses[i].id);
	    if (obj.id != item.id && item.childNodes[0].className && item.childNodes[0].className =='checked')	item.childNodes[0].className = "";  	    
	}
	document.getElementById('hf_objectposwph').value = '';
	var radio_container = document.getElementById(obj.id);
	for(i = 0; i < radio_container.childNodes.length; i++){	
		if (radio_container.childNodes[i].className && radio_container.childNodes[i].className =='checked')	radio_container.childNodes[i].className = "";
		else { 
			radio_container.childNodes[i].className = "checked";
			document.getElementById('hf_objectposwph').value = value; 
		}
	}	
}