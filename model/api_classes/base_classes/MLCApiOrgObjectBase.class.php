<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiOrgObjectBase extends MLCApiObjectBase
*/
class MLCApiOrgObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'Org';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('atheletes'):
                $arrAtheletes = Athelete::LoadCollByIdOrg($this->GetEntity()->idOrg)->GetCollection();
                return new MLCApiResponse($arrAtheletes);
            break;
            case ('competitions'):
                $arrCompetitions = Competition::LoadCollByIdOrg($this->GetEntity()->idOrg)->GetCollection();
                return new MLCApiResponse($arrCompetitions);
            break;
            case ('devices'):
                $arrDevices = Device::LoadCollByIdOrg($this->GetEntity()->idOrg)->GetCollection();
                return new MLCApiResponse($arrDevices);
            break;
            case ('orgcompetitions'):
                $arrOrgCompetitions = OrgCompetition::LoadCollByIdOrg($this->GetEntity()->idOrg)->GetCollection();
                return new MLCApiResponse($arrOrgCompetitions);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
