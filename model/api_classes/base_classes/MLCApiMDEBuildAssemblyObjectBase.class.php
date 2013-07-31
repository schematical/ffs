<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiMDEBuildAssemblyObjectBase extends MLCApiObjectBase
*/
class MLCApiMDEBuildAssemblyObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'MDEBuildAssembly';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
