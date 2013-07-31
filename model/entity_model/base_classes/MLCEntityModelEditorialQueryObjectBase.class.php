<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelEditorialQueryObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelEditorialQueryObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'EditorialQuery';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('Reporter'):
                //Load
                $objReporter = $this->GetEntity()->IdReporter;
                return new MLCEntityModelReporterObject($objIdReporter);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
