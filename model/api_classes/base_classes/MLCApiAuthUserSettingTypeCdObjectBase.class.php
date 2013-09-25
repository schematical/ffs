<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAuthUserSettingTypeCdObjectBase extends MLCApiObjectBase
*/
class MLCApiAuthUserSettingTypeCdObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'AuthUserSettingTypeCd';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
