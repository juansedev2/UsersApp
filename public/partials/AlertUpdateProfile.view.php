<?php if(UserController::isthereAlert()):?>
    <h2><?=UserController::getAlert()?></h2>
<?php endif;?>