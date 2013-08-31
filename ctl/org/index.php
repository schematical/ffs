<?php
if(is_null(MLCAuthDriver::User())){
    die(header('/'));
}
if(!is_null(FFSForm::$objCompetition)){
    $objRoll = MLCAuthDriver::GetRollByEntity(FFSForm::$objCompetition->IdOrgObject);
    if(
        (!is_null($objRoll)) &&
        ($objRoll->Type == FFSRoll::ORG_MANAGER)
    ){
        require_once(__CTL_ACTIVE_APP_DIR__ . '/org/competition/index.php');
        die();
    }
}
require_once(__CTL_ACTIVE_APP_DIR__ . '/org/home.php');
?>