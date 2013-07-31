<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelMLCBatchObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelMLCBatchObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'MLCBatch';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
