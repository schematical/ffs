<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiDeviceObjectBase extends MLCApiObjectBase
*/
class MLCApiDeviceObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'Device';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('Device'):
                //Load
                $objOrg = $this->GetEntity()->IdOrg;
                return new MLCApiOrgObject($objIdOrg);
            break;
            case ('assignments'):
                $arrAssignments = Assignment::LoadCollByIdDevice($this->GetEntity()->idDevice)->GetCollection();
                return new MLCApiResponse($arrAssignments);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
