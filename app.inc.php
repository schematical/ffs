<?php

define('__MODEL_APP_DATALAYER_DIR__', __MODEL_FFS_APP_DIR__ . '/data_classes');

define('__MODEL_APP_CONTROL__', __MODEL_FFS_APP_DIR__ . '/ctl_classes');

define('__MODEL_APP_API__', __MODEL_FFS_APP_DIR__ . '/api_classes');
define('__MODEL_APP_ENTITY_MODEL__', __MODEL_FFS_APP_DIR__ . '/entity_model');
if(!defined('SKIP_DATALAYER')){
	require_once(__MODEL_APP_DATALAYER_DIR__ . '/base_classes/DataConn.inc.php');
	require_once(__MODEL_APP_CONTROL__ . '/base_classes/ControlConn.inc.php');

}
require_once(__MODEL_FFS_APP_DIR__ . '/_enum.inc.php');
require_once(__MODEL_FFS_APP_DIR__ . '/_exceptions.inc.php');

define('__HIGHRISE_URL__', 'https://mattleaconsulting.highrisehq.com');
define('__HIGHRISE_API_KEY__', '69138c143576fae6de2ab9d14b9138a8');
define('__MAILCHIMP_API_KEY__', 'b6fa18adb1025581fa6afac3892bc084-us6');
define('__MLC_SALESTOOLS_ALERT_ADDRESS__', 'alerts@mattleaconsulting.com');
define('__URBANAIRSHIP_KEY__', 'PhAs_gCiST203aBOS9Yinw');
define('__URBANAIRSHIP_SECRET__', 'OWEWIKBOTlOaeWeD71cu9w');
define('__URBANAIRSHIP_MASTER_SECRET__', '_vjYVnVXSc-RhgsOqBXljw');
define('__GIT_API_KEY__','f6ecb159e135dd9c5b81');
define('__GIT_API_SECRET__','e862e0c0da8930ca18f69cbe8c33cf834fdbc88a');
define('__GOOGLE_API_KEY__', '957059295923-5k84s277agjcbgjaiqn9094d4kk8ajms.apps.googleusercontent.com');
define('__GOOGLE_API_SECRET__', 'K4Z7CoP_c1sITYi7x9L3XcCt');
MLCApplicationBase::$arrClassFiles['MLCApiHome'] = __MODEL_FFS_APP_DIR__ . '/api_custom/MLCApiHome.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiFunnel'] = __MODEL_FFS_APP_DIR__ . '/api_custom/MLCApiFunnel.class.php';
MLCApplicationBase::$arrClassFiles['FFSForm'] = __MODEL_FFS_APP_DIR__ . '/FFSForm.class.php';
MLCApplicationBase::$arrClassFiles['FFSFeedForm'] = __MODEL_FFS_APP_DIR__ . '/FFSFeedForm.class.php';
MLCApplicationBase::$arrClassFiles['FFSRewriteHandeler'] = __MODEL_FFS_APP_DIR__ . '/FFSRewriteHandeler.class.php';
MLCApplicationBase::$arrClassFiles['FFSApplication'] = __MODEL_FFS_APP_DIR__ . '/FFSApplication.class.php';
//Gymnastics scoring
MLCApplicationBase::$arrClassFiles['FFSResultCollection'] = __MODEL_FFS_APP_DIR__ . '/gymnastics/FFSResultCollection.class.php';


//CTL
MLCApplicationBase::$arrClassFiles['FFSGymLandingHeaderPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSGymLandingHeaderPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSParentMessageManagePanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSParentMessageManagePanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSOrgHomeNavPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSOrgHomeNavPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSParentMessageInvitePanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSParentMessageInvitePanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSScoreDisplayPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSScoreDisplayPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSOrgCompActivePanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSOrgCompActivePanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSPTFImportPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSPTFImportPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSAdPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSAdPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSDeviceAssignmentPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSDeviceAssignmentPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSCompReportPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSCompReportPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSFeedDisplayPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSFeedDisplayPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSParentMessageFeedDisplayPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSParentMessageFeedDisplayPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSResultFeedDisplayPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSResultFeedDisplayPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSSharePanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSSharePanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSAtheleteSelectPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSAtheleteSelectPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSWizzardPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSWizzardPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSOrgInvitePanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSOrgInvitePanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSResultAdvList'] = __CTL_FFS_APP_DIR__ . '/_panels/reports/FFSResultAdvList.class.php';
MLCApplicationBase::$arrClassFiles['FFSSessionControlPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSSessionControlPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSOrgManagerSpecialPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSOrgManagerSpecialPanel.class.php';
MLCApplicationBase::$arrClassFiles['FFSSessionEnrollmentPanel'] = __CTL_FFS_APP_DIR__ . '/_panels/FFSSessionEnrollmentPanel.class.php';




//Proscore stuff
MLCApplicationBase::$arrClassFiles['Proscore'] = __MODEL_FFS_APP_DIR__ . '/proscore/Proscore.class.php';
MLCApplicationBase::$arrClassFiles['ProscoreData'] = __MODEL_FFS_APP_DIR__ . '/proscore/ProscoreData.class.php';




switch(SERVER_ENV){
    case('local'):
        MLCApplication::$objRewriteHandeler->AssetMode = MLCRewriteAssetMode::LOCAL;
        MLCApplication::$strPackageRequireMode = MLCPackageRequireMode::FORCE_PULL_FROM_GIT;
        break;

    case('beta'):
    case('prod'):
    default:
        //MLCApplication::$objRewriteHandeler->AssetMode = MLCRewriteAssetMode::LOCAL;
        MLCApplication::$objRewriteHandeler->AssetMode = MLCRewriteAssetMode::S3;
        break;
}

MLCApplication::InitPackage('MJax');
MLCApplication::InitPackage('MJaxBootstrap');
MLCApplication::InitPackage('MLCAuth');
if(!defined('SKIP_DATALAYER')){
    MLCApplication::$objRewriteHandeler = new FFSRewriteHandeler();
}

MLCApplication::InitPackage('MLCDataLayer');
MLCApplication::InitPackage('MJaxTracking');
MLCApplication::InitPackage('MJaxWAdminTheme');
//MLCApplication::InitPackage('MJaxJQueryUI');
MLCApplication::InitPackage('MLCSalesTools');
//MLCApplication::InitPackage('MLCEntityModel');
//MLCApplication::InitPackage('MLCTwitter');
require_once(__CTL_FFS_APP_DIR__ . '/_events.inc.php');

//_dv(MLCApplicationBase::$arrClassFiles['MLCApiFFSPackage']);
if(class_exists('MLCAuthDriver')){
    switch(SERVER_ENV){
        case('local'):
            MLCAuthDriver::SetCookieDomain('ffs.com');
        break;
        case('beta'):
        case('prod'):
            MLCAuthDriver::SetCookieDomain('tumblescore.com');
        break;
    }

}

define('__ASSETS_URL__', MLCApplication::GetAssetUrl(''));
define('__ASSETS__', __ASSETS_URL__ . '');
define('__ASSETS_JS__', __ASSETS__ . '/js');
define('__ASSETS_CSS__', __ASSETS__ . '/css');
define('__ASSETS_IMG__', __ASSETS__ . '/imgs');



