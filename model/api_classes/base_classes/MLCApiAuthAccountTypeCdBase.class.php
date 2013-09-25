<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiAuthAccountTypeCdBase extends MLCApiClassBase
*/
class MLCApiAuthAccountTypeCdBase extends MLCApiClassBase {
    protected $strClassName = 'AuthAccountTypeCd';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objAuthAccountTypeCd = AuthAccountTypeCd::LoadById($strName);
        } else {
            $objAuthAccountTypeCd = null;
        }
        if (!is_null($objAuthAccountTypeCd)) {
            return new MLCApiAuthAccountTypeCdObject($objAuthAccountTypeCd);
        } else {
            throw new MLCApiException("No AuthAccountTypeCd found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>