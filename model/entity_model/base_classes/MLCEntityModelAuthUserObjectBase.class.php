<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelAuthUserObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelAuthUserObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'AuthUser';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('AuthAccount'):
                //Load
                $objAuthAccount = $this->GetEntity()->IdAccount;
                return new MLCEntityModelAuthAccountObject($objIdAccount);
            break;
            case ('AuthAccounts'):
                $arrAuthAccounts = AuthAccount::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
                $objResponse = new MLCEntityModelResponse($arrAuthAccounts);
                $objResponse->BodyType = 'AuthAccount';
                return $objResponse;
            break;
            case ('AuthSessions'):
                $arrAuthSessions = AuthSession::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
                $objResponse = new MLCEntityModelResponse($arrAuthSessions);
                $objResponse->BodyType = 'AuthSession';
                return $objResponse;
            break;
            case ('MLCNotifications'):
                $arrMLCNotifications = MLCNotification::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
                $objResponse = new MLCEntityModelResponse($arrMLCNotifications);
                $objResponse->BodyType = 'MLCNotification';
                return $objResponse;
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
