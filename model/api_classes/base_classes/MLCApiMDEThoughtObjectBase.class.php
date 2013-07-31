<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiMDEThoughtObjectBase extends MLCApiObjectBase
*/
class MLCApiMDEThoughtObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'MDEThought';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
