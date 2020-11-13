// JavaScript Document

var assert = require('chai').assert;	//Chai assertion library
var validInput = require('../app/validateRequiredField');
var validNum = require('../app/validatePhoneNumber');
var validEmail = require('../app/validateEmail');
var validZip = require('../app/validateZip');
var validStr = require('../app/validateString');

describe("Testing Input Required", function(){
	
	it("The letter a should pass", function(){
		assert.isTrue(validInput('a'));		
	});
	
	it("The number 4 should pass", function() {
		assert.isTrue(validInput(4));
	});
	
	it("Empty or '' should fail", function() {
		assert.isFalse(validInput(' '));
	});	
	
	it("A single space should fail", function() {
		assert.isFalse(validInput(' '));
	});
	
	it("Two or more spaces should fail", function(){
		assert.isFalse(validInput('  '));
	});
	
	it("The word null should fail", function() {
		assert.isFalse(validInput('null'));
	});
	
	it("The word undefined should fail", function() {
		assert.isFalse(validInput('undefined'));
	});
	
	it("The value 'a 4' should pass", function(){
		assert.isTrue(validInput('a 4'));
	});
	
});	//end "Testing Input Required"

//' ' output = false
//'null' output = false
//'undefined' output = false
//'adief' output = false
//1234567890 output = true
//'(123) 456-7890' output = true

describe("Testing Valid Phone Number", function(){
	
	it("Input is required", function(){
		assert.isFalse(validNum(' '));
	});
	it("Input can't be null", function(){
		assert.isFalse(validNum('null'));
	});
	it("Input can't be undefined", function(){
		assert.isFalse(validNum('undefined'));
	});
	it("Input must be numeric", function(){
		assert.isNumber(validNum(1234567890));
	});
	it("Input must be integers", function(){
		assert.isNumber(validNum(1234567890));
	});
	it("Input must be 10 numbers", function(){
		assert.lengthOf(validNum('1234567890'), 10);
	});
	it("Input must be Formatted", function(){
		var phonePattern = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
		validNum = '(123) 456-7890';
		var val = phonePattern.test(validNum);
		assert.equal(val, true);
	});

});

//' ' output = false
//'null' output = false
//'undefined' output = false
//'adief' output = false
//3456 output = false
//'star5@gmail.com' = true

describe("Testing Valid Email", function(){
	
	it("Input is required", function(){
		assert.isFalse(validEmail(' '));
	});
	it("Input can't be null", function(){
		assert.isFalse(validEmail('null'));
	});
	it("Input can't be undefined", function(){
		assert.isFalse(validEmail('undefined'));
	});
	it("Input can't be numeric", function(){
		assert.isFalse(validEmail(3456));
	});
	it("Input must be Formatted", function(){
		assert.isTrue(validEmail('star5@gmail.com'));
	});

});

//' ' output = false
//'null' output = false
//'undefined' output = false
//'adief' output = false
//12345 output = true
//123456789 output = true
//23456-7890 output = true

describe("Testing Valid Zip Code", function(){
	
	it("Input is required", function(){
		assert.isFalse(validZip(' '));
	});
	it("Input must be numeric", function(){
		assert.isNumber(validZip(12345));
	});
	it("Input can't be null", function(){
		assert.isFalse(validZip('null'));
	});
	it("Input can't be undefined", function(){
		assert.isFalse(validZip('undefined'));
	});
	it("Input must be 9 numbers", function(){
		assert.lengthOf(validZip('123456789'), 9);
	});
	it("Input must be 5 numbers", function(){
		assert.lengthOf(validZip('12345'), 5);
	});
	it("Input must be Formatted", function(){
	var zipPattern = /^\d{5}$|^\d{5}-\d{4}$/;
	validZip = 23456-7890;
	var value = zipPattern.test(validZip)
			assert.equal(value, true);
	});

});

//' ' output = false
//'null' output = false
//'undefined' output = false
//'adief' output = true
//'string 4' output = true
//'He-llo--World-' = true

describe("Testing Valid String", function(){
	
	it("Input is required", function(){
		assert.isFalse(validStr(' '));
	});
	it("Input can't be undefined", function(){
		assert.isFalse(validStr('undefined'));
	});
	it("Input can't be null", function(){
		assert.isFalse(validStr('null'));
	});
	it("Input can be letters and numbers", function(){
		assert.isTrue(validStr('string 4'));
	});
	it("Input must be Formatted", function(){
	validStr = 'He/llo<>World!'
	value = validStr.replace(/[^a-zA-Z0-9]/g,'-');
		assert.equal(value, 'He-llo--World-');
	});

});