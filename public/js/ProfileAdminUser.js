"use strict";
const error_div_email = document.getElementById("error_message_email");
const error_div_password = document.getElementById("error_message_password");
const email_input = document.getElementById("email");
const password_input = document.getElementById("password");

// Get the buttosn to show the alert with the instructions
document.getElementById("question_button").addEventListener(
    "click", () => {
        alert(
            "Como administrador puede hacer lo siguiente:\n"
            +"1. Actualizar la mayor parte de su información y debe asegurarse del formato con la que llena la información\n"
            +"2. Si no desea actualizar algún campo en específico, déjelos en su valor por defecto, así que tenga cuidado con lo que actualiza\n"
            +"3. Para actualizar la contraseña, debe cumplir las políticas de contraseña segura, así como confirmarla, lo mismo que el correo\n"
            +"4. Ante cualquier duda/sugerencia/error por favor contactarse con soporte"
        );
    }
);
document.getElementById("update_button").addEventListener(
    "click", (event) => {
        if(confirm("¿Está seguro que desea actualizar sus datos?")){
            return true;
        }else{
            event.preventDefault();
        }
    }
);

// Get the inputs to validate email and password
email_input.addEventListener(
    "blur", (event) => {
        //It's necessary to validate the email format
        if(!validateEmail(event.target.value)){
            error_div_email.innerHTML = "Formato de correo electrónico no válido";
        }else{
            error_div_email.innerHTML = null;
        }
    }
);
password_input.addEventListener(
    "blur", (event) => {
        //It's necessary to validate the email format
        if(!validatePassword(event.target.value)){
            error_div_password.innerHTML = "La contraseña debe tener al menos un caracter especial, un número, una letra y mínimo 8 caracteres";
        }else{
            error_div_password.innerHTML = null;
        }
        
    }
);

function validateData(){

    if(!validateEmail(email_input.value)){
        error_div_email.innerHTML = "Formato de correo electrónico no válido";
        return false;
    }
    if(!validatePassword(password_input.value)){
        error_div_password.innerHTML = "La contraseña debe tener al menos un caracter especial, un número, una letra y mínimo 8 caracteres";
        return false;
    }
    return true;
}

function validateEmail(email){
    const regex = /[-A-Za-z0-9!#$%&'*+\/=?^_`{|}~]+(?:\.[-A-Za-z0-9!#$%&'*+\/=?^_`{|}~]+)*@(?:[A-Za-z0-9](?:[-A-Za-z0-9]*[A-Za-z0-9])?\.)+[A-Za-z0-9](?:[-A-Za-z0-9]*[A-Za-z0-9])?/i;
    return regex.test(email);
}

function validatePassword(){
    const regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    return regex.test(email);
}