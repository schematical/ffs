<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiResultObjectBase extends MLCApiObjectBase
*/
class MLCApiResultObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'Result';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('Result'):
                //Load
                $objSession = $this->GetEntity()->IdSession;
                return new MLCApiSessionObject($objIdSession);
            break;
            case ('Result'):
                //Load
                $objAthelete = $this->GetEntity()->IdAthelete;
                return new MLCApiAtheleteObject($objIdAthelete);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
