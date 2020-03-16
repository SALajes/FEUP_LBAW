"use strict";

let content_elem = document.getElementById("content");

let feed_btn = document.getElementById("feed_btn");
let drive_btn = document.getElementById("drive_btn");
let doubts_btn = document.getElementById("doubts_btn");
let tutor_btn = document.getElementById("tutor_btn");
let classes_btn = document.getElementById("classes_btn");
let about_btn = document.getElementById("about_btn");

let btn_grp = document.getElementById("cu_tabs");

function vert_hor() {
	if (window.innerWidth < 992) btn_grp.className = "btn-group btn-group-toggle col-lg-3";
	else btn_grp.className = "btn-group-vertical btn-group-toggle col-lg-3";

}

function getFeed() {
	about_btn.style.textDecoration = "";
	classes_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "";
	drive_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET", "../actions/action_feed.php", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}

function getDrive() {
	about_btn.style.textDecoration = "";
	classes_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "";
	drive_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET", "../actions/action_drive.php", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();

}

function getDoubts() {
	about_btn.style.textDecoration = "";
	classes_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "";
	drive_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET", "../actions/action_doubts.php", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}

function getTutoring(){
	about_btn.style.textDecoration = "";
	classes_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "";
	drive_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET", "../actions/action_tutoring.php", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}

function getClasses(){
	about_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "";
	drive_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "";
	classes_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET", "../actions/action_classes.php", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}


function getAbout(){
	classes_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "";
	drive_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "";
	about_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET", "../actions/action_aboutcu.php", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}

about_btn.onclick = getAbout;
classes_btn.onclick = getClasses;
tutor_btn.onclick = getTutoring;
doubts_btn.onclick = getDoubts;
drive_btn.onclick = getDrive;
feed_btn.onclick = getFeed;
window.onresize = vert_hor;

vert_hor();
getFeed();
