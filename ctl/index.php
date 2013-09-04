<?php
//_dv(MLCAuthDriver::User());
if(!is_null(MLCAuthDriver::User()) &&  (count(FFSApplication::GetOrgs())) > 0){

    //assume it is a coach for now

    require(__CTL_ACTIVE_APP_DIR__ . '/org/index.php');
}else{

    require(__CTL_ACTIVE_APP_DIR__ . '/landing.php');
}
