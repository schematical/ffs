<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiMLCLocationObjectBase extends MLCApiObjectBase
*/
class MLCApiMLCLocationObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'MLCLocation';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('MLCLocation'):
                //Load
                $objAuthAccount = $this->GetEntity()->IdAccount;
                return new MLCApiAuthAccountObject($objIdAccount);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
