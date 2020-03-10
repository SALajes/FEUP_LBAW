"use strict";

let content_elem = document.getElementById("content");

let feed_btn = document.getElementById("feed_btn");
let drive_btn = document.getElementById("drive_btn");
let doubts_btn = document.getElementById("doubts_btn");
let tuttor_btn = document.getElementById("tuttor_btn");
let classes_btn = document.getElementById("classes_btn");
let about_btn = document.getElementById("about_btn");

function getFeed(){
	let req = new XMLHttpRequest();
	req.open("GET", "../actions/action_feed.php", true);

	req.onload = function(){
		if(req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
}

feed_btn.onclick = getFeed;

getFeed();