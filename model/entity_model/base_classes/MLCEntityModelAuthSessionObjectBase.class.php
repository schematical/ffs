<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelAuthSessionObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelAuthSessionObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'AuthSession';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
