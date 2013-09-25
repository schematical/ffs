<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAuthUserTypeCdObjectBase extends MLCApiObjectBase
*/
class MLCApiAuthUserTypeCdObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'AuthUserTypeCd';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
