<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiSysConfigEntryObjectBase extends MLCApiObjectBase
*/
class MLCApiSysConfigEntryObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'SysConfigEntry';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
