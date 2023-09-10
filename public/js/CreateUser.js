"use strict";
//const form = document.querySelector("form");
/* form.addEventListener("submit", event => {
    event.preventDefault();
    const data = Object.fromEntries(new FormData(event.target)); // This get an ordinart object, get all of the attributes of the form (name and value)
    if(validateForm(data)){
       return true;
    }else{
        alert("Datos incompleots");
    }
}); */
// Get the important inputs
const first_name_input = document.getElementById("first_name")
const last_name_input = document.getElementById("last_name");
const age_input = document.getElementById("age");
const identification_number_input = document.getElementById("identification_number");
const email_input = document.getElementById("email");
const password_input = document.getElementById("password");
const r_password_input = document.getElementById("r-password");
const div_error = document.getElementById("error_message");

document.querySelector("form").addEventListener(
    "submit", (event) => {
        if(!validateInputs()){
            alert("DATOS INCOMPLETOS Y/O ERRÓNEOS");
            event.preventDefault();
        }else{
            return true;
        }
    }
);

function validateInputs(){
    
    if(!isEmpty([first_name_input.value, last_name_input.value, age_input.value, identification_number_input.value, email_input.value, password_input.value, r_password_input.value])){
        return false;
    }else{
        if(isNaN(age_input.value) || isNaN(identification_number_input.value)){
            div_error.innerHTML = "Edad y/o tipo de identificación NO es un número";
            return false;
        }else if(!validateEmail(email_input.value)){
            div_error.innerHTML = "Formato de correo electrónico no válido";
            return false;
        }else if(!validatePassword(password_input.value)){
            div_error.innerHTML = "La contraseña debe tener al menos un caracter especial, un número, una letra y mínimo 8 caracteres";
            return false;
        }else if(password_input.value != r_password_input.value){
            div_error.innerHTML = "Las contraseñas no coinciden";
            return false;
        }else{
            return true;
        }
    }
}
function isEmpty(param) {

    let result = true;
    
    for(let i = 0; i <= param.length; i++){
        if(param[i] == ""){
            result = false;
            return;
        }
    }

    return result;
}

function validateEmail(email){
    const regex = /^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/;
    return regex.test(email);
}

function validatePassword(password){
    const regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
    return regex.test(password);
}