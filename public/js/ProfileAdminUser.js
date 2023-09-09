"use strict";
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