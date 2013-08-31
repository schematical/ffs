<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAuthSessionObjectBase extends MLCApiObjectBase
*/
class MLCApiAuthSessionObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'AuthSession';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('AuthSession'):
                //Load
                $objAuthUser = $this->GetEntity()->IdUser;
                return new MLCApiAuthUserObject($objIdUser);
            break;
            case ('trackingevents'):
                $arrTrackingEvents = TrackingEvent::LoadCollByIdSession($this->GetEntity()->idSession)->GetCollection();
                return new MLCApiResponse($arrTrackingEvents);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
