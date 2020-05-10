"use strict";
let counter = 0;
let cu_abbrevs = [];
let cu_names = [];
let cu_descriptions = [];
let cu_ids = [];

function getAllCUs(){
    cu_data = "";
    data.innerHTML = "";

    let req = new XMLHttpRequest();

    req.open("GET", "/cu/", true);
    req.onload = function(){
        if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
            let cu_list = JSON.parse(this.responseText);
            cu_data += '<div class="accordion" id="accordion">';
            counter = 0;
            let current_cu_abbrev = cu_list.cus[0].abbrev;
            let current_cu_name = cu_list.cus[0].cu_name;
            let current_cu_description = cu_list.cus[0].description;
            let current_cu_id = cu_list.cus[0].cu_id;
            for(let i = 0; i < cu_list.cus.length; i++) {
                if (!cu_abbrevs.includes(current_cu_abbrev)) {
                    cu_abbrevs.push(current_cu_abbrev);
                }
                if (!cu_names.includes(cu_list.cus[i].cu_name)) {
                    cu_names.push(cu_list.cus[i].cu_name);
                }
                if (!cu_descriptions.includes(cu_list.cus[i].description)) {
                    cu_descriptions.push(cu_list.cus[i].description);
                }
                if (!cu_ids.includes(cu_list.cus[i].cu_id)) {
                    cu_ids.push(cu_list.cus[i].cu_id);
                }
                current_cu_abbrev = cu_list.cus[i].abbrev;
                current_cu_name = cu_list.cus[i].cu_name;
                current_cu_description = cu_list.cus[i].description;
                current_cu_id = cu_list.cus[i].cu_id;
                let aux = [];
                let str = "";
                str += '<div class="card-body">';
                str += '<a href="/users/' + cu_list.cus[i].su_id + '">' + cu_list.cus[i].name + '</a>';
                str += '</div>';
                aux.push(str);
                i++;
                while ((i+1 < cu_list.cus.length) && current_cu_abbrev == cu_list.cus[i+1].abbrev) {
                    str = "";
                    str += '<div class="card-body">';
                    str += '<a href="/users/' + cu_list.cus[i].su_id + '">' + cu_list.cus[i].name + '</a>';
                    str += '</div>';
                    aux.push(str);
                    i++;
                }
                cu_data += '<div class="card">';
                cu_data += '<div class="card-header" id="heading' + counter + '">';
                cu_data += '<h2 class="mb-0">';
                cu_data += '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse' + counter + '" aria-expanded="false" aria-controls="collapse' + counter + '">';
                cu_data += current_cu_abbrev;
                cu_data += '</button>';
                // cu_data += '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_cu_modal_"' + counter + ' data-whatever="@mdo">Edit</button>'
                cu_data += '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal' + counter + '">Edit</button>'
                cu_data += '<div class="modal fade" id="editModal' + counter + '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel' + counter + '" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="editModalLabel' + counter + '"> New message </h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <form method="POST" id="edit_form_' + counter + '"><div class="form-group"> <label for="cu_name_' + counter + '" class="col-form-label"> Name: </label> <input type="text" placeholder="' + cu_names[counter] + '" class="form-control" id="cu_name_' + counter + '" /> <button type="submit" form="edit_form_' + counter + '" class="btn btn-primary"> Update </button> </div> </form> </div> </div> </div> </div>';
                cu_data += '<button id="btn_delete_' + counter + '" class="btn btn-primary" type="button">Delete</button>';
                cu_data += '</h2>';
                cu_data += '</div>';
                cu_data += '<div id="collapse' + counter + '" class="collapse show" aria-labelledby="heading' + counter + '" data-parent="#accordion">';
                for (let j = 0; j != aux.length; j++) {
                    cu_data += aux[j];
                }
                cu_data += '</div>';
                cu_data += '</div>';
                aux = [];
                counter++;
                if (!cu_abbrevs.includes(current_cu_abbrev)) {
                    cu_abbrevs.push(current_cu_abbrev);
                }
                if (!cu_names.includes(current_cu_name)) {
                    cu_names.push(current_cu_name);
                }
                if (!cu_descriptions.includes(current_cu_description)) {
                    cu_descriptions.push(current_cu_description);
                }
                if (!cu_ids.includes(cu_list.cus[i].cu_id)) {
                    cu_ids.push(cu_list.cus[i].cu_id);
                }
            }
            cu_data += '</div>';
            data.innerHTML = cu_data;
            console.log(cu_descriptions)
            console.log(cu_ids)
            console.log(cu_names)
            console.log(cu_abbrevs)
            addButtonEventListeners();
        }
        else {
            console.log(req.status);
            console.log(this.responseText)
        } 
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

// function getAllCUs(){
//     cu_data = "";
//     data.innerHTML = "";

//     let req = new XMLHttpRequest();

//     req.open("GET", "/cu/", true);
//     req.onload = function(){
//         if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
//             let cu_list = JSON.parse(this.responseText);
//             for(let i = 0; i < cu_list.cus.length; i++){
//                 let button = '<a class="btn btn-primary" data-toggle="collapse" href="#collapse_' + i + '" role="button" aria-expanded="false" aria-controls="collapse_' + i + '">Manage</a>'
//                 cu_data += "<tr>";
//                 cu_data += "<tr>";
//                 cu_data += "<td>";
//                 cu_data += "<a href=\"/cu/" + cu_list.cus[i].id + "\">" + cu_list.cus[i].abbrev + "</a>";
//                 cu_data += "</td>";
//                 cu_data += "<td>" + button + "</td>";
//                 cu_data+= "</tr>";
//             }
//             data.innerHTML = "<section class=\"row\"><table class=\"table text-center table-hover\"><thead><tr><th scope=\"col\">Name</th></th><th scope=\"col\">Action</th></tr></thead><tbody>" + cu_data;
//             for(let i = 0; i < cu_list.cus.length; i++) {
//                 let collapse = '<div class="collapse" id="collapse_' + i + '"><div class="card card-body">' + cu_list.cus[i].abbrev + '</div></div>'
//                 data.innerHTML += "<tr>" + collapse + "</tr>"
//             }
//             data.innerHTML +=  + "</tbody></table></section>";
//         }
		
// 		else console.log(req.status);
//     };
    
//     req.onerror = function (){ //SE não ligar ao srv
//         console.log("Connection Error");
//     };
    

//     req.send();

// }

function getManageCUs(){
    data.innerHTML = '';
    manageCUs.className += " active ";
    myCUs.classList.remove("active");
    myRatings.classList.remove("active");
    getAllCUs();
}

manageCUs.onclick = getManageCUs;