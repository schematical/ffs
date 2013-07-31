<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiMDEAssetObjectBase extends MLCApiObjectBase
*/
class MLCApiMDEAssetObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'MDEAsset';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
