"use strict";

let myCUs = document.querySelector("#tabs > a:nth-child(1)");
let myRatings = document.querySelector("#tabs > a:nth-child(2)");
let manageCUs = document.querySelector("#tabs > a:nth-child(3)");

let data = document.getElementById("data");
let id = document.getElementById("student_id").value;
let cu_data = "";

function getMyCUs(){
	cu_data = "";
	data.innerHTML = "";

	let req = new XMLHttpRequest();

	req.open("GET", "../api/myCUs/" + id, true);
	req.onload = function(){
		if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
			let cu_list = JSON.parse(this.responseText);
			for(let i = 0; i < cu_list.cus.length; i++){
				cu_data += "<tr>";
				cu_data += "<tr>";
				cu_data += "<td>";
				cu_data += cu_list.cus[i].abbrev;
				cu_data += "</td>";
				cu_data += " <td>Enrolled</td>";
				cu_data += "<td>Leave</td>";
				cu_data+= "</tr>";
			}

	
            data.innerHTML = "<section class=\"row\"><table class=\"table text-center table-hover\"><thead><tr><th scope=\"col\">Name</th><th scope=\"col\">Status</th><th scope=\"col\">Action</th></tr></thead><tbody>" + cu_data + "</tbody></table></section>";
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