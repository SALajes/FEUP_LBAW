"use strict";

let content_elem = document.getElementById("data");
let id = document.getElementById("cu_id").value;

let feed_btn = document.getElementById("feed_btn");
let doubts_btn = document.getElementById("doubts_btn");
let tutor_btn = document.getElementById("tutor_btn");
let classes_btn = document.getElementById("classes_btn");
let about_btn = document.getElementById("about_btn");

let btn_grp = document.getElementById("cu_tabs");

function vert_hor() {
	if (window.innerWidth < 992) btn_grp.className = "btn-group btn-group-toggle d-flex flex-wrap justify-content-center";
	else btn_grp.className = "btn-group-vertical btn-group-toggle d-flex flex-wrap justify-content-center";

}

function getFeed() {
	about_btn.style.textDecoration = "";
	classes_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET", "/cu/" + id + "/feed/", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400){
			let response = JSON.parse(this.responseText);
			content_elem.innerHTML += response.feed;
		}

		else content_elem.innerHTML = "There was an error retrieving this CUs posts from our database, try another time";
		console.log(this.responseText);
	};

	req.send();
}

function getDoubts() {
	about_btn.style.textDecoration = "";
	classes_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET", "/cu/" + id + "/doubts/", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}

function getTutoring(){
	about_btn.style.textDecoration = "";
	classes_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET",  "/cu/" + id + "/tuttoring/", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}

function getClasses(){
	about_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "";
	classes_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET", "/cu/" + id + "/classes/", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}


function getAbout(){
	classes_btn.style.textDecoration = "";
	tutor_btn.style.textDecoration = "";
	doubts_btn.style.textDecoration = "";
	feed_btn.style.textDecoration = "";
	about_btn.style.textDecoration = "underline";
	let req = new XMLHttpRequest();
	req.open("GET",  "/cu/" + id + "/about/", true);

	req.onload = function () {
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}

about_btn.onclick = getAbout;
classes_btn.onclick = getClasses;
tutor_btn.onclick = getTutoring;
doubts_btn.onclick = getDoubts;
feed_btn.onclick = getFeed;
window.onresize = vert_hor;

vert_hor();
getFeed();
