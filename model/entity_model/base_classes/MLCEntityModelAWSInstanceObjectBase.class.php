<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelAWSInstanceObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelAWSInstanceObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'AWSInstance';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
