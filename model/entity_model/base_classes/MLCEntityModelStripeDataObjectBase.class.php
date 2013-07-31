<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelStripeDataObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelStripeDataObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'StripeData';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
