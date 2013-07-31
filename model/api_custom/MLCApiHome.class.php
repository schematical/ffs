<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - MLCApiHome extends MLCApiHomeBase
*/

require_once (__MODEL_APP_API__ . '/base_classes/MLCApiHomeBase.class.php');
class MLCApiHome extends MLCApiHomeBase {
    public function __construct(){
		//MLCApiAuthDriver::Authenticate(false);
	}
	
    public function funnel(){
        return new MLCApiFunnel();
    }
    public function apps() {
        return new MLCApiMDEApp();
    }
    public function packages(){
        //TMP Hack because 'aint no body got time for this'
        MLCApplicationBase::$arrClassFiles['MLCApiMDEPackage'] = __MDE_CORE__ . '/model/api/MLCApiMDEPackage.class.php';
        return new MLCApiMDEPackage();
    }
    public function auth(){
        return new MLCApiAuthUser();
    }
    public function evernote(){
        MLCApplication::InitPackage('MLCEvernote');
        return new MLCApiEvernote();
    }
}