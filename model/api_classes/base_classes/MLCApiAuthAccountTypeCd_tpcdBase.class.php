<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiAuthAccountTypeCd_tpcdBase extends MLCApiClassBase
*/
class MLCApiAuthAccountTypeCd_tpcdBase extends MLCApiClassBase {
    protected $strClassName = 'AuthAccountTypeCd_tpcd';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objAuthAccountTypeCd_tpcd = AuthAccountTypeCd_tpcd::LoadById($strName);
        } else {
            $objAuthAccountTypeCd_tpcd = null;
        }
        if (!is_null($objAuthAccountTypeCd_tpcd)) {
            return new MLCApiAuthAccountTypeCd_tpcdObject($objAuthAccountTypeCd_tpcd);
        } else {
            throw new MLCApiException("No AuthAccountTypeCd_tpcd found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>