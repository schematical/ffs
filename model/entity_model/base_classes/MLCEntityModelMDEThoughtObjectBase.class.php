<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelMDEThoughtObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelMDEThoughtObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'MDEThought';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
