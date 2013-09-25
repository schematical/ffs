<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiAuthUserTypeCdBase extends MLCApiClassBase
*/
class MLCApiAuthUserTypeCdBase extends MLCApiClassBase {
    protected $strClassName = 'AuthUserTypeCd';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objAuthUserTypeCd = AuthUserTypeCd::LoadById($strName);
        } else {
            $objAuthUserTypeCd = null;
        }
        if (!is_null($objAuthUserTypeCd)) {
            return new MLCApiAuthUserTypeCdObject($objAuthUserTypeCd);
        } else {
            throw new MLCApiException("No AuthUserTypeCd found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>