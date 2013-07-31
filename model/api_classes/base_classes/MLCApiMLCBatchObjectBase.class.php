<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiMLCBatchObjectBase extends MLCApiObjectBase
*/
class MLCApiMLCBatchObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'MLCBatch';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
