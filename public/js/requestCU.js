"use strict";

let entityMap = {
	"&": "&amp;",
	"<": "&lt;",
	">": "&gt;",
	'"': '&quot;',
	"'": '&#39;',
	"/": '&#x2F;'
  };

function escapeHtml(string) {
	return String(string).replace(/[&<>"'\/]/g, function (s) {
	  return entityMap[s];
	});
}

let cu_name_input = document.getElementById("cu_name");
let cu_abbrev_input = document.getElementById("cu_abbrev");
let cu_page_input = document.getElementById("cu_page");
let add_info_input = document.getElementById("additional_info");


cu_name_input.onchange = () => {cu_name_input.value = escapeHtml(cu_name_input.value);}
cu_page_input.onchange = () => {cu_page_input.value = escapeHtml(cu_page_input.value);}
cu_abbrev_input.onchange = () => {cu_abbrev_input.value = escapeHtml(cu_abbrev_input.value);}
add_info_input.onchange = () => {add_info_input.value = escapeHtml(add_info_input.value);}
