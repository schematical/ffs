<?php

define('__MODEL_APP_DATALAYER_DIR__', __MODEL_MDE_APP_DIR__ . '/data_classes');

define('__MODEL_APP_CONTROL__', __MODEL_MDE_APP_DIR__ . '/ctl_classes');

define('__MODEL_APP_API__', __MODEL_MDE_APP_DIR__ . '/api_classes');
define('__MODEL_APP_ENTITY_MODEL__', __MODEL_MDE_APP_DIR__ . '/entity_model');
if(!defined('SKIP_DATALAYER')){
	require_once(__MODEL_APP_DATALAYER_DIR__ . '/base_classes/Conn.inc.php');
	require_once(__MODEL_APP_CONTROL__ . '/base_classes/ControlConn.inc.php');

}
require_once(__MODEL_MDE_APP_DIR__ . '/_enum.inc.php');

define('__SVN_USERNAME__', 'mlconsulting');
define('__SVN_PASSWORD__', 'Monkey11');
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
MLCApplicationBase::$arrClassFiles['MLCApiHome'] = __MODEL_MDE_APP_DIR__ . '/api_custom/MLCApiHome.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiFunnel'] = __MODEL_MDE_APP_DIR__ . '/api_custom/MLCApiFunnel.class.php';
MLCApplicationBase::$arrClassFiles['FFSForm'] = __MODEL_MDE_APP_DIR__ . '/FFSForm.class.php';



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

//MLCApplication::$objRewriteHandeler = new MDERewriteHandeler();

MLCApplication::InitPackage('MLCDataLayer');
MLCApplication::InitPackage('MJaxTracking');
MLCApplication::InitPackage('MJaxWAdminTheme');
MLCApplication::InitPackage('MLCSalesTools');
//_dv(MLCApplicationBase::$arrClassFiles['MLCApiMDEPackage']);
if(class_exists('MLCAuthDriver')){
    MLCAuthDriver::SetCookieDomain('ffs.com');
}

define('__ASSETS_URL__', MLCApplication::GetAssetUrl(''));
define('__ASSETS__', __ASSETS_URL__ . '');
define('__ASSETS_JS__', __ASSETS__ . '/js');
define('__ASSETS_CSS__', __ASSETS__ . '/css');
define('__ASSETS_IMG__', __ASSETS__ . '/imgs');



