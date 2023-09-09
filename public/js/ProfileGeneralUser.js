"use strict";
const error_div_email = document.getElementById("error_message_email");
const error_div_password = document.getElementById("error_message_password");
const email_input = document.getElementById("email");
const password_input = document.getElementById("password");

// Get the buttosn to show the alert with the instructions
document.getElementById("question_button").addEventListener(
    "click", () => {
        alert(
            "ACTUALIZAR CORREO Y CONTRASEÑA:\n"
            +"1. Si solo necesita actualizar su correo, puede cambiarlo modificando el contenido."
            +"\n2. Si quiere actualizar su contraseña, debe cumplir la política de contraseña segura y estar seguro de la nueva que utilizará.\nSolo los administradores pueden actualizar más información disponible y ante cualquier duda, por favor contactarse con ellos"
        );
    }
);

document.getElementById("form_data_profile").addEventListener(
    "submit", (event) => {
        if(!validateData()){
            event.preventDefault();
        }else{
            return true;
        }
    }
);

document.getElementById("update_button").addEventListener(
    "submit", (event) => {
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