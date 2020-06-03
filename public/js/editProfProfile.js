"use strict"

let name_input = document.getElementById("prof_name");
let abbrev_input = document.getElementById("prof_abbrev");
let email_input = document.getElementById("prof_email");

let name_error = document.getElementById("name_error");
let abbrev_error = document.getElementById("abbrev_error");
let email_error = document.getElementById("email_error");

let name_sub_btn = document.querySelector("#prof_name_form > div:nth-child(2) > div:nth-child(3) > button:nth-child(1)");
let abbrev_sub_btn = document.querySelector("#prof_abbrev_form > div:nth-child(2) > div:nth-child(3) > button:nth-child(1)");
let email_sub_btn = document.querySelector("#prof_email_form > div:nth-child(2) > div:nth-child(3) > button:nth-child(1)");

name_sub_btn.disabled = true;
abbrev_sub_btn.disabled = true;
email_sub_btn.disabled = true;

function validate_name(){
	if (/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/ui.test(name_input.value)) return true;
	else return false;
}

function validate_abbrev(){
	if (/[A-Z]{2,8}/.test(abbrev_input.value)) return true;
	else return false;
}

function validate_email(){
	if (/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email_input.value)) return true;
	else return false;
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

email_input.onkeyup = () => {
	if (validate_email()){
		 email_sub_btn.disabled = false;
		 email_error.innerHTML = "";
	}
	else{
		 email_sub_btn.disabled = true;
		 email_error.innerHTML = "<p style=\"color:red\">The input email is invalid.</p>";
	}
};