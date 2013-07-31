<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelMDEBuildObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelMDEBuildObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'MDEBuild';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
