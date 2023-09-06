<fieldset>
    <legend>Por favor completar la siguiente información </legend>
    <form action="crear-usuario" method="post" id="form_data_create_user ">
        <label for="fisrt_name">Primer nombre: </label>
            <input type="text" id="first_name" name="first_name">
            <label for="middle_name">Segundo nombre: </label>
            <input type="text" id="middle_name" name="middle_name">
            <label for="last_name">Apellidos: </label>
            <input type="text" id="last_name" name="last_name">
            <div>
                <label for="age">Edad</label>
                <input type="number" name="age" id="age">
            </div>
            <label for="role">Rol del usuario</label>
            <select name="role" id="role">
                <?php require_once "./public/partials/RoleList.view.php"?>
            </select>
            <label for="identification_type">Tipo de documento</label>
            <select name="identification_type" id="identification_type">
                <?php require_once "./public/partials/IdentificationTypesList.view.php"?>
            </select>
            <label for="identification_number">Número de documento</label>
            <input type="number" name="identification_number" id="identification_number">
            <label for="email">Correo</label>
            <input type="email" name="email" id="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Escriba una nueva contraseña si la quiere actualizar">
            <label for="password">Repita la contraseña</label>
            <input type="password" name="r-password" id="r-password" placeholder="Confirme la contraseña anterior">
            <div class="button">
                <button id="button" type="submit">Crear usuario</button>
            </div>
    </form>
</fieldset>