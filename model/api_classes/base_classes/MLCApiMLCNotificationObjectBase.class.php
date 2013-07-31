<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiMLCNotificationObjectBase extends MLCApiObjectBase
*/
class MLCApiMLCNotificationObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'MLCNotification';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('AuthUser'):
                //Load
                $objAuthUser = $this->GetEntity()->IdUser;
                return new MLCApiAuthUserObject($objIdUser);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
