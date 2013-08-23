<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAssignmentObjectBase extends MLCApiObjectBase
*/
class MLCApiAssignmentObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'Assignment';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('Assignment'):
                //Load
                $objDevice = $this->GetEntity()->IdDevice;
                return new MLCApiDeviceObject($objIdDevice);
            break;
            case ('Assignment'):
                //Load
                $objSession = $this->GetEntity()->IdSession;
                return new MLCApiSessionObject($objIdSession);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
