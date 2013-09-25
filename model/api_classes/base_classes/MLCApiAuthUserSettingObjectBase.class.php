<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAuthUserSettingObjectBase extends MLCApiObjectBase
*/
class MLCApiAuthUserSettingObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'AuthUserSetting';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('AuthUserSetting'):
                //Load
                $objAuthUser = $this->GetEntity()->IdUser;
                return new MLCApiAuthUserObject($objIdUser);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
