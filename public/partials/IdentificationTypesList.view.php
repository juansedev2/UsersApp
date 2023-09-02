<?php foreach($identification_types as $identification_type):?>
    <option value="<?=$identification_type->properties["id"]?>"><?=$identification_type->properties["identification_name"]?></option>
<?php endforeach;?>