<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAlertObjectBase extends MLCApiObjectBase
*/
class MLCApiAlertObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'Alert';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
