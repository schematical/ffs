<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelAuthUserSettingObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelAuthUserSettingObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'AuthUserSetting';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
