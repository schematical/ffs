<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelMDEPackageObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelMDEPackageObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'MDEPackage';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
