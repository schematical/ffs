<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelMDEAppObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelMDEAppObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'MDEApp';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
