"use strict"

let name_input = document.getElementById("cu_name");
let abbrev_input = document.getElementById("cu_abbrev");
let description_input = document.getElementById("cu_description");

let name_error = document.getElementById("name_error");
let abbrev_error = document.getElementById("abbrev_error");
let description_error = document.getElementById("description_error");

let name_sub_btn = document.querySelector("#edit-cu-name-form > div:nth-child(2) > div:nth-child(3) > button:nth-child(1)");
let abbrev_sub_btn = document.querySelector("#edit-cu-abbrev-form > div:nth-child(2) > div:nth-child(3) > button:nth-child(1)");
let description_sub_btn = document.querySelector("#edit-cu-description-form > div:nth-child(2) > div:nth-child(3) > button:nth-child(1)");

name_sub_btn.disabled = true;
abbrev_sub_btn.disabled = true;
description_sub_btn.disabled = true;

function validate_name(){
	if (/^[0-9, a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/ui.test(name_input.value)) return true;
	else return false;
}

function validate_abbrev(){
	if (/[0-9, A-Z]{2,8}/.test(abbrev_input.value)) return true;
	else return false;
}

function validate_description(){
	if(description_input.value.length < 6) return false;
	else return true;
}

name_input.onkeyup = () => {
	if (validate_name()){
		 name_sub_btn.disabled = false;
		 name_error.innerHTML = "";
	}
	else{
		 name_sub_btn.disabled = true;
		 name_error.innerHTML = "<p style=\"color:red\">The input name is invalid.</p>";
	}
};

abbrev_input.onkeyup = () => {
	if (validate_abbrev()){
		 abbrev_sub_btn.disabled = false;
		 abbrev_error.innerHTML = "";
	}
	else{
		 abbrev_sub_btn.disabled = true;
		 abbrev_error.innerHTML = "<p style=\"color:red\">The input abbrev is invalid.</p>";
	}
};

description_input.onkeyup = () => {
	if (validate_description()){
		 description_sub_btn.disabled = false;
		 description_error.innerHTML = "";
	}
	else{
		 description_sub_btn.disabled = true;
		 description_error.innerHTML = "<p style=\"color:red\">The input description should be over 6 characters</p>";
	}
};

