"use strict";
let counter = 0;
let cu_abbrevs = [];
let cu_names = [];
let cu_descriptions = [];
let cu_ids = [];
let aux_map = {};

function getAllCUs(){
    cu_data = "";
    data.innerHTML = "";

    let req = new XMLHttpRequest();

    req.open("GET", "/cu/", true);
    req.onload = function(){
        if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
            let cu_list = JSON.parse(this.responseText);
            console.log(cu_list)
            counter = 0;
            let student_counter = 1;
            let current_cu_abbrev = cu_list.cus[0].abbrev;
            let current_cu_name = cu_list.cus[0].cu_name;
            let current_cu_description = cu_list.cus[0].description;
            let current_cu_id = cu_list.cus[0].cu_id;
            for(let i = 0; i < cu_list.cus.length; i++) {
                current_cu_abbrev = cu_list.cus[i].abbrev;
                current_cu_name = cu_list.cus[i].cu_name;
                current_cu_description = cu_list.cus[i].description;
                current_cu_id = cu_list.cus[i].cu_id;
                if (!(current_cu_abbrev in aux_map)) {
                    aux_map[current_cu_abbrev] = 1;
                }
                if (i+1 < cu_list.cus.length && current_cu_abbrev == cu_list.cus[i+1].abbrev) {
                    student_counter++;
                    aux_map[current_cu_abbrev]++;
                }
                else {
                    if (!cu_abbrevs.includes(current_cu_abbrev)) {
                        if (student_counter == 0 && cu_list.cus[i].student_number != null) {
                            student_counter = 1;
                            aux_map[current_cu_abbrev]++;
                        }
                        else if (cu_list.cus[i].student_number != null) {
                            student_counter++;
                            aux_map[current_cu_abbrev]++;
                        }
                        cu_abbrevs.push(current_cu_abbrev);
                        cu_data += "<tr>";
                        cu_data += "<tr>";
                        cu_data += "<td>";
                        cu_data += "<a href=\"/cu/" + current_cu_id + "\">" + current_cu_abbrev + "</a>";
                        cu_data += "</td>";
                        cu_data += "<td>" + current_cu_name + "</td>";
                        cu_data += "<td>";
                        cu_data += aux_map[current_cu_abbrev];
                        cu_data += "</td>";
                        cu_data+= "</tr>";
                    }
                    if (i+1 < cu_list.cus.length && current_cu_abbrev != cu_list.cus[i+1].abbrev) 
                        student_counter = 0;
                }             
            }

            data.innerHTML = "<section class=\"row\"><table class=\"table text-center table-hover\"><thead><tr><th scope=\"col\">Abbreviature</th></th><th scope=\"col\">Name</th><th scope=\"col\">Number of enrolled students</th></tr></thead><tbody>" + cu_data + "</tbody></table></section>";
        }		
        else console.log(req.status);
        console.log(aux_map)
        
    };
    
    req.onerror = function (){ //SE não ligar ao srv
        console.log("Connection Error");
    };
    

    req.send();

}

function addButtonEventListeners() {
    for (let i = 0; i < counter; i++) {
        let deleteButton = document.querySelector('button#btn_delete_' + i);
        deleteButton.addEventListener('click', () => {handleDeleteCUButton(i)});    
    }
}

function handleDeleteCUButton(i) {
    let content = cu_abbrevs[i];
    sendAjaxRequest('delete', '/cu', {content: content}, () => {getAllCUs()});
}

function getManageCUs(){
    data.innerHTML = '';
    manageCUs.className += " active ";
    myCUs.classList.remove("active");
    myRatings.classList.remove("active");
    getAllCUs();
}

manageCUs.onclick = getManageCUs;