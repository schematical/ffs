<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelAlertObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelAlertObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'Alert';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
