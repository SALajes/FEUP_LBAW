"use strict";

let myCUs = document.querySelector("#tabs > a:nth-child(1)");
let myRatings = document.querySelector("#tabs > a:nth-child(2)");
let manageCUs = document.querySelector("#tabs > a:nth-child(3)");

let data = document.getElementById("data");
let student_id = document.getElementById("student_id").value;
let cu_data = "";

function getMyCUs(){
    cu_data = "";
    data.innerHTML = "";

    let req = new XMLHttpRequest();

    req.open("GET", "/users/myCUs/" + student_id, true);
    req.onload = function(){
        if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
            let cu_list = JSON.parse(this.responseText);
            for(let i = 0; i < cu_list.cus.length; i++){
                cu_data += "<tr>";
                cu_data += "<tr>";
                cu_data += "<td>";
                cu_data += "<a href=\"/cu/" + cu_list.cus[i].id + "\">" + cu_list.cus[i].abbrev + "</a>";
                cu_data += "</td>";
                cu_data += " <td>" + cu_list.cus[i].name + "</td>";
                cu_data+= "</tr>";
            }

    
            data.innerHTML = "<section class=\"row\"><table class=\"table text-center table-hover\"><thead><tr><th scope=\"col\">Abbreviature</th><th scope=\"col\">Name</th></tr></thead><tbody>" + cu_data + "</tbody></table></section>";
        }
        
        if (req.status == 404) console.log(404);
    };
    
    req.onerror = function (){ //SE não ligar ao srv
        console.log("Connection Error");
    };
    

    req.send();
    
    myCUs.className += " active ";
    myRatings.classList.remove("active");
    if (manageCUs != null) manageCUs.classList.remove("active");
}

function getMyRatings(){
    let aux = "";
    data.innerHTML = "";

    let req = new XMLHttpRequest();
    req.open("GET", "/users/myRatings/" + student_id, true);
    req.onload = function(){
        if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
            aux = JSON.parse(this.responseText);
            console.log(aux)
            for (let i = 0; i != aux.reviews.length; i++) {
                data.innerHTML += '<div class="card-header d-flex"><div class="flex-column"><p>' + aux.reviews[i].review + '</p></div></div>';
            }
        }
    };
    
    req.onerror = function (){ //SE não ligar ao srv
        console.log("Connection Error");
    };
    

    req.send();

    myRatings.className += " active ";
    myCUs.classList.remove("active");
    if (manageCUs != null) manageCUs.classList.remove("active");
}




myCUs.onclick = getMyCUs;
myRatings.onclick = getMyRatings;

getMyCUs();