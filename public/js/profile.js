"use strict";

let myCUs = document.querySelector("#tabs > a:nth-child(1)");
let myRatings = document.querySelector("#tabs > a:nth-child(2)");
let manageCUs = document.querySelector("#tabs > a:nth-child(3)");

let data = document.getElementById("data");
let id = document.getElementById("student_id").value;

function getMyCUs(){

	data.innerHTML = "";

	let req = new XMLHttpRequest();

	req.open("GET", "../api/myCUs/" + id, true);
	req.onload = function(){
        if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
            data.innerHTML = this.responseText;
        }
    };
    
    req.onerror = function (){ //SE não ligar ao srv
        console.log("Connection Error");
	};
	

	req.send();
	
	myCUs.className += " active ";
	myRatings.classList.remove("active");
	manageCUs.classList.remove("active");
}

function getMyRatings(){
	data.innerHTML = "";

	let req = new XMLHttpRequest();

	req.open("GET", "../api/myRatings/" + id, true);
	req.onload = function(){
        if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
            data.innerHTML = this.responseText;
        }
    };
    
    req.onerror = function (){ //SE não ligar ao srv
        console.log("Connection Error");
	};
	

	req.send();

	myRatings.className += " active ";
	myCUs.classList.remove("active");
	manageCUs.classList.remove("active");
}

function getManageCUs(){
	data.innerHTML = "";
	manageCUs.className += " active ";
	myCUs.classList.remove("active");
	myRatings.classList.remove("active");
}


myCUs.onclick = getMyCUs;
myRatings.onclick = getMyRatings;
manageCUs.onclick = getManageCUs;
manageCUs.disabled = true;

getMyCUs();