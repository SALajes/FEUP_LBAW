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
            for(let i = 0; i < cu_list.cus.length; i++){
                let button = '<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse_' + i + '" aria-expanded="false" aria-controls="collapseExample">Manage</button>';
                let collapse = '<div class="collapse" id="collapse_' + i + '><div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div></div>';
                cu_data += "<tr>";
                cu_data += "<tr>";
                cu_data += "<td>";
                cu_data += "<a href=\"/cu/" + cu_list.cus[i].id + "\">" + cu_list.cus[i].abbrev + "</a>";
                cu_data += "</td>";
                cu_data += "<td>" + button + "</td>";
                cu_data+= "</tr>";
                cu_data+="<tr>" + collapse + "</tr>"
            }
            data.innerHTML = "<section class=\"row\"><table class=\"table text-center table-hover\"><thead><tr><th scope=\"col\">Name</th></th><th scope=\"col\">Action</th></tr></thead><tbody>" + cu_data + "</tbody></table></section>";
        }
		
		else console.log(req.status);
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