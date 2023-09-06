<?php foreach ($role_list as $role):?>
    <option value="<?=$role->properties["id"]?>"><?=$role->properties["rol_name"]?></option>
<?php endforeach?>