<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiMDEBuildObjectBase extends MLCApiObjectBase
*/
class MLCApiMDEBuildObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'MDEBuild';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
