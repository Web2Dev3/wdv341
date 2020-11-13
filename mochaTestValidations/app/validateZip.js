// JavaScript Document
var validZip = function(inValue){
	this.inValue = inValue;
	if (inValue == ' ' || inValue == 'null' || inValue == 'undefined'){
	return false;
	}
	else if (inValue.length > 9 || inValue < 9){
	return false;
	}
	else{
	return this.inValue;
	}
 	
}

module.exports = validZip;