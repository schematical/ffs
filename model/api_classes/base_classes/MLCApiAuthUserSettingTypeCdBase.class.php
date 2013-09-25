<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiAuthUserSettingTypeCdBase extends MLCApiClassBase
*/
class MLCApiAuthUserSettingTypeCdBase extends MLCApiClassBase {
    protected $strClassName = 'AuthUserSettingTypeCd';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objAuthUserSettingTypeCd = AuthUserSettingTypeCd::LoadById($strName);
        } else {
            $objAuthUserSettingTypeCd = null;
        }
        if (!is_null($objAuthUserSettingTypeCd)) {
            return new MLCApiAuthUserSettingTypeCdObject($objAuthUserSettingTypeCd);
        } else {
            throw new MLCApiException("No AuthUserSettingTypeCd found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>