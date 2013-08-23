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
            case ('devices'):
                $arrDevices = Device::LoadCollByIdOrg($this->GetEntity()->idOrg)->GetCollection();
                return new MLCApiResponse($arrDevices);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
