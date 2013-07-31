<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiEditorialQueryObjectBase extends MLCApiObjectBase
*/
class MLCApiEditorialQueryObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'EditorialQuery';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('Reporter'):
                //Load
                $objReporter = $this->GetEntity()->IdReporter;
                return new MLCApiReporterObject($objIdReporter);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
