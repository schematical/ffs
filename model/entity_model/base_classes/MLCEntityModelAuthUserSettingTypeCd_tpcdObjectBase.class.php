<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelAuthUserSettingTypeCd_tpcdObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelAuthUserSettingTypeCd_tpcdObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'AuthUserSettingTypeCd_tpcd';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
