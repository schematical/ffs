<?php
if(is_null(MLCAuthDriver::User())){
    die(header('/'));
}
FFSForm::$strSection = 'org';
$objCompetition = MLCApplication::$objRewriteHandeler->EntityManager->Competition();
if(!is_null($objCompetition)){

    $objRoll = MLCAuthDriver::GetRollByEntity($objCompetition);
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