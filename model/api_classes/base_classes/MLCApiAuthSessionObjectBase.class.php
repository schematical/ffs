<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAuthSessionObjectBase extends MLCApiObjectBase
*/
class MLCApiAuthSessionObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'AuthSession';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
