<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAuthAccountTypeCdObjectBase extends MLCApiObjectBase
*/
class MLCApiAuthAccountTypeCdObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'AuthAccountTypeCd';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
