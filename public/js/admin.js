"use strict";

function getAllCUs(){
    cu_data = "";
    data.innerHTML = "";

    let req = new XMLHttpRequest();

    req.open("GET", "/cu/", true);
    req.onload = function(){
        if(req.status >= 200 && req.status < 400){ // Se o SRV retornar bem
            let cu_list = JSON.parse(this.responseText);
            cu_data += '<div class="accordion" id="accordion">';
            console.log(cu_list)
            let counter = 0;
            let current_cu = cu_list.cus[0].abbrev;
            for(let i = 0; i < cu_list.cus.length; i++){
                current_cu = cu_list.cus[i].abbrev;
                let aux = [];
                let str = "";
                str += '<div class="card-body">';
                str += 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.';
                str += '</div>';
                aux.push(str);
                i++;
                while ((i+1 < cu_list.cus.length) && current_cu == cu_list.cus[i+1].abbrev) {
                    str = "";
                    str += '<div class="card-body">';
                    str += 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.';
                    str += '</div>';
                    aux.push(str);
                    i++;
                }
                cu_data += '<div class="card">';
                cu_data += '<div class="card-header" id="heading' + counter + '">';
                cu_data += '<h2 class="mb-0">';
                cu_data += '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse' + counter + '" aria-expanded="false" aria-controls="collapse' + counter + '">';
                cu_data += current_cu;
                cu_data += '</button>';
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
            }
            cu_data += '</div>';
            data.innerHTML = cu_data;
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