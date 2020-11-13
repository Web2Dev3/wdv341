// JavaScript Document
var validNum = function(inValue){
	this.inValue = inValue;
	if (inValue == ' ' || inValue == 'null' || inValue == 'undefined'){
	return false;
	}
	else if (inValue.length > 10 || inValue.length < 10){
	return false;
	}
	else{
	return this.inValue;
	}
 	
}

module.exports = validNum;