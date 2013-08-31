<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAuthUserObjectBase extends MLCApiObjectBase
*/
class MLCApiAuthUserObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'AuthUser';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('authsessions'):
                $arrAuthSessions = AuthSession::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
                return new MLCApiResponse($arrAuthSessions);
            break;
            case ('authusersettings'):
                $arrAuthUserSettings = AuthUserSetting::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
                return new MLCApiResponse($arrAuthUserSettings);
            break;
            case ('mlcnotifications'):
                $arrMLCNotifications = MLCNotification::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
                return new MLCApiResponse($arrMLCNotifications);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
