<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelMLCNotificationObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelMLCNotificationObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'MLCNotification';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('AuthUser'):
                //Load
                $objAuthUser = $this->GetEntity()->IdUser;
                return new MLCEntityModelAuthUserObject($objIdUser);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
