<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCEntityModelMDEAssetObjectBase extends MLCEntityModelObjectBase
*/
class MLCEntityModelMDEAssetObjectBase extends MLCEntityModelObjectBase {
    protected $strClassName = 'MDEAsset';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
