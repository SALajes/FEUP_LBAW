// "use strict";

// let entityMap = {
// 	"&": "&amp;",
// 	"<": "&lt;",
// 	">": "&gt;",
// 	'"': '&quot;',
// 	"'": '&#39;',
// 	"/": '&#x2F;'
//   };

// function escapeHtml(string) {
// 	return String(string).replace(/[&<>"'\/]/g, function (s) {
// 	  return entityMap[s];
// 	});
// }

// let cu_name_input = document.getElementById("cu_name");
// let cu_abbrev_input = document.getElementById("cu_abbrev");
// let cu_page_input = document.getElementById("cu_page");
// let add_info_input = document.getElementById("additional_info");
// let sub_btn = document.getElementById('sub_btn');


// function validate_cu_name(){
// 	if (/^[A-Z, a-z, 0-9]+\s*$/g.test(cu_name_input.value)) return true
// 	else return false
// }

// function validate_cu_abbrev(){
// 	if (/^[A-Z, a-z, 0-9]+$/g.test(cu_abbrev_input.value)) return true
// 	else return false
// }

// function validate_cu_page(){
// 	if (/^\S+\.\S+$/.test(cu_page_input.value)) return true
// 	else return false
// }

// let cu_name_ready = false;
// let cu_abbrev_ready = false;
// let cu_page_ready = false;

// let cu_name_errors = document.getElementById("cu_name_errors");
// let cu_abbrev_errors = document.getElementById("cu_abbrev_errors");
// let cu_page_errors = document.getElementById("cu_page_errors");

// cu_name_input.onkeyup = () => {
// 	cu_name_ready = validate_cu_name();

// 	if (!cu_name_ready) cu_name_errors.innerHTML = "<p style=\"color:red\">The CU name must contain only letters or digits.</p>"
// 	else cu_name_errors.innerHTML = "";

// 	if (cu_name_input && cu_abbrev_ready && cu_page_ready) sub_btn.disabled = false;
// 	else sub_btn.disabled = true;
// };

// cu_abbrev_input.onkeyup = () => {
// 	cu_abbrev_ready = validate_cu_abbrev();

// 	if (!cu_abbrev_ready) cu_abbrev_errors.innerHTML = "<p style=\"color:red\">The CU abbrev must contain only letters or digits.</p>"
// 	else cu_abbrev_errors.innerHTML = "";

// 	if (cu_name_input && cu_abbrev_ready && cu_page_ready) sub_btn.disabled = false;
// 	else sub_btn.disabled = true;
// };

// cu_page_input.onkeyup = () => {
// 	cu_page_ready = validate_cu_page();

// 	if (!cu_page_ready) cu_page_errors.innerHTML = "<p style=\"color:red\">The CU page must be an URL.</p>"
// 	else cu_page_errors.innerHTML = "";

// 	if (cu_name_input && cu_abbrev_ready && cu_page_ready) sub_btn.disabled = false;
// 	else sub_btn.disabled = true;
// };
