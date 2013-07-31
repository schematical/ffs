<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiMDEPackageObjectBase extends MLCApiObjectBase
*/
class MLCApiMDEPackageObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'MDEPackage';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
