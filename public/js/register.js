"use strict"

let name_input = document.getElementById("name");
let email_input = document.getElementById("email-register");
let student_number_input = document.getElementById("student_number");
let password_input = document.getElementById("password-register");
let password_confirmation_input = document.getElementById("password_confirm");


let name_error = document.getElementById("name_error");
let email_error = document.getElementById("email_error");
let student_number_error = document.getElementById("sn_error");
let password_error = document.getElementById("pw_error");
let password_confirmation_error = document.getElementById("pc_error");

let sub_btn = document.getElementById("pass_submit");

sub_btn.disabled = true;

let name_ready = false;
let email_ready = false;
let sn_ready = false;
let pw_ready = false;
let pc_ready = false;


function validate_name(){
	if (/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/ui.test(name_input.value)) return true;
	else return false;
}

function validate_email(){
	if (/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email_input.value)) return true;
	else return false;
}

function validate_pw(){
	if (/^[A-Z, 0-9, @$!%*#?&]{6,}$/i.test(password_input.value)) return true;
	else return false;
}

function validate_pc(){
	if (/^[A-Z, 0-9, @$!%*#?&]{6,}$/i.test(password_confirmation_input.value) && password_confirmation_input.value === password_input.value) return true;
	else return false;
}

function validate_sn(){
	if (/^(up)*[0-9]{9}$/.test(student_number_input.value)) return true;
	else return false;
}

name_input.onkeyup = () => {
	name_ready = validate_name();

	if (!name_ready) name_error.innerHTML = "<p style=\"color:red\">The input name is invalid.</p>"
	else name_error.innerHTML = "";

	if (name_input && email_ready && sn_ready && pc_ready && pw_ready) sub_btn.disabled = false;
	else sub_btn.disabled = true;
};


email_input.onkeyup = () => {
	email_ready = validate_email();

	if (!email_ready) email_error.innerHTML = "<p style=\"color:red\">The input email is invalid.</p>"
	else email_error.innerHTML = "";

	if (name_input && email_ready && sn_ready && pc_ready && pw_ready) sub_btn.disabled = false;
	else sub_btn.disabled = true;
};

password_input.onkeyup = () => {
	pw_ready = validate_pw();

	if (!pw_ready) password_error.innerHTML = "<p style=\"color:red\">The input password is invalid.</p>"
	else password_error.innerHTML = "";

	if (name_input && email_ready && sn_ready && pc_ready && pw_ready) sub_btn.disabled = false;
	else sub_btn.disabled = true;
};

password_confirmation_input.onkeyup = () => {
	pc_ready = validate_pc();

	if (!pc_ready) password_confirmation_error.innerHTML = "<p style=\"color:red\">The input password is invalid or does not match the previously input.</p>"
	else password_confirmation_error.innerHTML = "";

	if (name_input && email_ready && sn_ready && pc_ready && pw_ready) sub_btn.disabled = false;
	else sub_btn.disabled = true;
};

student_number_input.onkeyup = () =>{
	sn_ready = validate_sn();

	if (!sn_ready) student_number_error.innerHTML = "<p style=\"color:red\">The input student number is invalid.</p>"
	else student_number_error.innerHTML = "";

	if (name_input && email_ready && sn_ready && pc_ready && pw_ready) sub_btn.disabled = false;
	else sub_btn.disabled = true;
};