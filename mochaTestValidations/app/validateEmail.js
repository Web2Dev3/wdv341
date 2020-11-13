// JavaScript Document
var validEmail = function(inValue){
	var emailPattern =   /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	inValue += "";
	if (inValue == ' ' || inValue == 'null' || inValue == 'undefined'){
	return false;
	}
	else if (!inValue == emailPattern.test(inValue)){
	return false;
	}
	return true;
	
 	
}

module.exports = validEmail;