"use strict"

let cpw_input = document.getElementById("current-password");
let npw_input = document.getElementById("new-password");
let npc_input = document.getElementById("new-password-confirm");

let cpw_error = document.getElementById("cpw_error");
let npw_error = document.getElementById("npw_error");
let npc_error = document.getElementById("npc_error");

let cpw_ready = false;
let npw_ready = false;
let npc_ready = false;

let sub_btn = document.querySelector("div.form-group:nth-child(5) > div:nth-child(1) > button:nth-child(1)");

sub_btn.disabled = true;

function validate_cpw(){
	if (/^[A-Z, 0-9, @$!%*#?&]{4,}$/i.test(cpw_input.value)) return true;
	else return false;
}

function validate_npw(){
	if (/^[A-Z, 0-9, @$!%*#?&]{6,}$/i.test(npw_input.value)) return true;
	else return false;
}

function validate_npc(){
	if (/^[A-Z, 0-9, @$!%*#?&]{6,}$/i.test(npc_input.value) && npc_input.value === npw_input.value) return true;
	else return false;
}

cpw_input.onkeyup = () => {
	cpw_ready = validate_cpw();

	if (!cpw_ready) cpw_error.innerHTML = "<p style=\"color:red\">The input current password is invalid.</p>"
	else cpw_error.innerHTML = "";

	if (cpw_ready && npc_ready && npw_ready) sub_btn.disabled = false;
	else sub_btn.disabled = true;
};

npw_input.onkeyup = () => {
	npw_ready = validate_npw();

	if (!npw_ready) npw_error.innerHTML = "<p style=\"color:red\">The input new password is invalid.</p>"

	if (npw_input.value === cpw_input.value) npw_error.innerHTML = "<p style=\"color:red\">The input new password can't be the same as the old password</p>"
	else npw_error.innerHTML = "";

	if (cpw_ready && npc_ready && npw_ready) sub_btn.disabled = false;
	else sub_btn.disabled = true;
};

npc_input.onkeyup = () => {
	npc_ready = validate_npc();

	if (!npc_ready) npc_error.innerHTML = "<p style=\"color:red\">The input new password is invalid or does not match the previously input.</p>"
	else npc_error.innerHTML = "";

	if (cpw_ready && npc_ready && npw_ready) sub_btn.disabled = false;
	else sub_btn.disabled = true;
};