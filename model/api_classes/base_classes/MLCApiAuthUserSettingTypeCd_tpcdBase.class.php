<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiAuthUserSettingTypeCd_tpcdBase extends MLCApiClassBase
*/
class MLCApiAuthUserSettingTypeCd_tpcdBase extends MLCApiClassBase {
    protected $strClassName = 'AuthUserSettingTypeCd_tpcd';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objAuthUserSettingTypeCd_tpcd = AuthUserSettingTypeCd_tpcd::LoadById($strName);
        } else {
            $objAuthUserSettingTypeCd_tpcd = null;
        }
        if (!is_null($objAuthUserSettingTypeCd_tpcd)) {
            return new MLCApiAuthUserSettingTypeCd_tpcdObject($objAuthUserSettingTypeCd_tpcd);
        } else {
            throw new MLCApiException("No AuthUserSettingTypeCd_tpcd found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>