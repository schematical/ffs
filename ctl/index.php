<?php
if(!is_null(MLCAuthDriver::User())){
    //assume it is a coach for now
    require(__CTL_ACTIVE_APP_DIR__ . '/org/index.php');
}else{
    require(__CTL_ACTIVE_APP_DIR__ . '/landing.php');
}
