<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAuthRollObjectBase extends MLCApiObjectBase
*/
class MLCApiAuthRollObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'AuthRoll';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
