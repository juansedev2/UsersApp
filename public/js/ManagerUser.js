"use strict";
const trash_buttons = document.querySelectorAll("button.button.trash");
trash_buttons.forEach((button) => {
    button.addEventListener(
        "click", (event) => {
            if(confirm("¿Esta segúro que desea eliminar el usuadio con id: " + button.value)){
                return true;
            }else{
                event.preventDefault();
            }
        }
    );
});