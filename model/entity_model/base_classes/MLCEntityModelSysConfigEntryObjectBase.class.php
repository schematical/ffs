<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelSysConfigEntryObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelSysConfigEntryObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'SysConfigEntry';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
