<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelAuthAccountTypeCd_tpcdObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelAuthAccountTypeCd_tpcdObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'AuthAccountTypeCd_tpcd';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
