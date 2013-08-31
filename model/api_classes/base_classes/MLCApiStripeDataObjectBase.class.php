<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiStripeDataObjectBase extends MLCApiObjectBase
*/
class MLCApiStripeDataObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'StripeData';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
