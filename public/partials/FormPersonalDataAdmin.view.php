<fieldset>
    <legend>Tu información de perfil: </legend>
    <form action="actualizar-perfil" method="post" id="form_data_profile">
        <label for="fisrt_name">Primer nombre: </label>
        <input type="text" id="first_name" name="first_name" value="<?=$user["first_name"]?>">
        <label for="middle_name">Segundo nombre: </label>
        <input type="text" id="middle_name" name="middle_name" value="<?=$user["middle_name"]?>">
        <label for="last_name">Primer nombre: </label>
        <input type="text" id="last_name" name="last_name" value="<?=$user["last_name"]?>">
        <div>
            <label for="age">Edad</label>
            <input type="number" value="<?=$user["age"]?>" name="age">
        </div>
        <label for="identification_type">Tipo de documento</label>
        <select name="identification_type" id="identification_type">
            <?php require_once "./public/partials/IdentificationTypesList.view.php"?>
            <option value="<?=$user["identification_type"]?>" selected="true">Registrado: <?=$user["identification_name"]?></option> -->
        </select>
        <label for="identification_number">Número de documento</label>
        <input type="number" name="identification_number" id="identification_number" value="<?=$user["identification_number"]?>">
        <label for="email">Correo</label>
        <input type="email" name="email" id="email" value="<?=$user["email"]?>">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Escriba una nueva contraseña si la quiere actualizar">
        <div class="buttons">
            <button id="question_button" type="button">¿Cómo actualizar datos?</button>
            <button id="update_button" type="submit">Actualizar datos</button>
        </div>
    </form>
</fieldset>