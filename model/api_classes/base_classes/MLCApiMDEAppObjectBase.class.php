<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiMDEAppObjectBase extends MLCApiObjectBase
*/
class MLCApiMDEAppObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'MDEApp';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
