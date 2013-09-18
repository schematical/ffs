<?php
if(!is_null(FFSForm::Competition())){
    require_once(__CTL_ACTIVE_APP_DIR__ .'/org/feed.php');
}else{
    require_once(__CTL_ACTIVE_APP_DIR__ .'/org/home.php');
}
?>