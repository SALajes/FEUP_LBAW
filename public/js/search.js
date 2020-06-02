"use strict";

let stud_checkbox = document.querySelector("#fields > label:nth-child(1) > input");
let prof_checkbox = document.querySelector("#fields > label:nth-child(2) > input");
let cu_checkbox = document.querySelector("#fields > label:nth-child(3) > input");

let fetch_student = true;
let fetch_professor = true;
let fetch_cu = true;

let submit = document.querySelector("#search > button[type=\"submit\"]");

submit.addEventListener('click', (event) => {
    event.preventDefault();
    makeRequest();
})

createEventListeners();

function createEventListeners(){
    stud_checkbox.onclick = () => {
        if(stud_checkbox.value == "yes"){
            stud_checkbox.value = "no";
        }
        else{
            stud_checkbox.value = "yes";
            if(!fetch_student){
                makeRequest();
            }
        }
        invertHiddenDiv('#student_card');
    };
    
    prof_checkbox.onclick = () => {
        if(prof_checkbox.value == "yes"){
            prof_checkbox.value = "no";
        }
        else{
            prof_checkbox.value = "yes";
            if(!fetch_professor){
                makeRequest();
            }
        }

        invertHiddenDiv('#professor_card');
    };
    
    cu_checkbox.onclick = () => {
        if(cu_checkbox.value == "yes"){
            cu_checkbox.value = "no";
        }
        else{
            cu_checkbox.value = "yes";
            if(!fetch_cu){
                makeRequest();
            }
        }

        invertHiddenDiv('#cu_card');
    };
}

function invertHiddenDiv(div_id){
    let div = document.querySelector(div_id)
    
    if(div.style.display == 'block'){
        div.style.display = 'none';
    }
    else div.style.display = 'block';
}

function makeRequest(){
    fetch_student = (stud_checkbox.value == 'yes');
    fetch_professor = (prof_checkbox.value == 'yes');
    fetch_cu = (cu_checkbox.value == 'yes');

    let request = new XMLHttpRequest();

    request.open("GET", "/search/advanced/" + document.querySelector("#query").value 
        + "/" + stud_checkbox.value + "/" + prof_checkbox.value + "/" + cu_checkbox.value, true);
    request.send();

    request.onload = changeResults;
}

function changeResults(){
    console.log(this.responseText);
    let response = JSON.parse(this.responseText);
    let div = document.querySelector("#results");
    div.innerHTML="";

    let stud = response.stud;
    let prof = response.prof;
    let cu = response.cu;

    let htmlString = "";

    for(let i=0; i < stud.length; i++){
        htmlString += student_card(stud[i].name, stud[i].student_number, stud[i].profile_image, stud[i].id);
    }

    for(let i=0; i < prof.length; i++){
        htmlString += professor_card(prof[i].name, prof[i].profile_image, prof[i].id);
    }

    for(let i=0; i < cu.length; i++){
        htmlString += cu_card(cu[i].abbrev, cu[i].name, cu[i].id);
    }

    div.innerHTML = htmlString;

    stud_checkbox = document.querySelector("#fields > label:nth-child(1) > input");
    prof_checkbox = document.querySelector("#fields > label:nth-child(2) > input");
    cu_checkbox = document.querySelector("#fields > label:nth-child(3) > input");

    createEventListeners();
}

function student_card(name, student_number, profile_image, id){
    return "<div id=\"student_card\" class=\"card bg-light mb-3\" style=\"display: block; width: 16rem; height: 16rem;\">"+
        "<div class=\"card-header\">Student</div>" +
        "<a href=\"/users/" + id + "\">" + 
            "<div class=\"card-body\">" +
                (profile_image != null ?
                    "<div id=\"profile_picture\" class=\"img-circle d-flex justify-content-center flex-shrink-0\">" +
                        "<img src=\"/storage/profile_image/" + profile_image + "\" class=\"img-profile\"/>" +
                    "</div>"
                :
                    "<i id=\"profile_picture\" class=\"icon-user profile-button d-flex justify-content-center\"></i>"
                ) +
                "<p class=\"card-text\"><b>" + name + "</b></p>" +
                "<p class=\"card-text\">" + student_number + "</p>" +
            "</div>" +
        "</a>" +
    "</div>";
}

function professor_card(name, profile_image, id){
    return "<div id=\"professor_card\" class=\"card bg-light mb-3\" style=\"display: block; width: 16rem; height: 16rem;\">"+
        "<div class=\"card-header\">Professor</div>" +
        "<a href=\"/professors/" + id + "\">" + 
            "<div class=\"card-body\">" +
                (profile_image != null ?
                    "<div id=\"profile_picture\" class=\"img-circle d-flex justify-content-center flex-shrink-0\">" +
                        "<img src=\"/storage/profile_image/" + profile_image + "\" class=\"img-profile\"/>" +
                    "</div>"
                :
                    "<i id=\"profile_picture\" class=\"icon-user profile-button d-flex justify-content-center\"></i>"
                ) +
                "<p class=\"card-text\"><b>" + name + "</b></p>" +
            "</div>" +
        "</a>" +
    "</div>";
}

function cu_card(abbrev, name, id){
    return "<div id=\"cu_card\" class=\"card bg-light mb-3\" style=\"display: block; width: 16rem; height: 16rem;\">"+
        "<div class=\"card-header\">Curricular Unit</div>" +
        "<a href=\"/cu/" + id + "\">" + 
            "<div class=\"card-body\">" +
                "<h4 class=\"text-center\"><b>" + abbrev + "</b></h4>" +
                "<p class=\"card-text\"><b>" + name + "</b></p>" +
            "</div>" +
        "</a>" +
    "</div>";
}