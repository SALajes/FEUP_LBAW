"use strict";

function getAllCUs(){
    cu_data = "";
    data.innerHTML = "";

    let req = new XMLHttpRequest();

    req.open("GET", "/cu/", true);
    req.onload = function(){
        if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
            let cu_list = JSON.parse(this.responseText);
            console.log(cu_list);
            // for(let i = 0; i < cu_list.cus.length; i++){
            //     cu_data += "<tr>";
            //     cu_data += "<tr>";
            //     cu_data += "<td>";
            //     cu_data += "<a href=\"/cu/" + cu_list.cus[i].id + "\">" + cu_list.cus[i].abbrev + "</a>";
            //     cu_data += "</td>";
            //     cu_data += " <td>Enrolled</td>";
            //     cu_data += "<td>Leave</td>";
            //     cu_data+= "</tr>";
            // }

            // data.innerHTML = "<section class=\"row\"><table class=\"table text-center table-hover\"><thead><tr><th scope=\"col\">Name</th><th scope=\"col\">Status</th><th scope=\"col\">Action</th></tr></thead><tbody>" + cu_data + "</tbody></table></section>";
        }
        
        if (req.status == 404) console.log(404);
    };
    
    req.onerror = function (){ //SE não ligar ao srv
        console.log("Connection Error");
    };
    

    req.send();

}

function getManageCUs(){
    data.innerHTML = '';
    manageCUs.className += " active ";
    myCUs.classList.remove("active");
    myRatings.classList.remove("active");
    getAllCUs();
}

manageCUs.onclick = getManageCUs;