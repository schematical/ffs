<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiMDEAssetBase extends MLCApiClassBase
*/
class MLCApiMDEAssetBase extends MLCApiClassBase {
    protected $strClassName = 'MDEAsset';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName)) {
            $objMDEAsset = MDEAsset::LoadById($strName);
        } else {
            $objMDEAsset = null;
        }
        if (!is_null($objMDEAsset)) {
            return new MLCApiMDEAssetObject($objMDEAsset);
        } else {
            throw new MLCApiException("No MDEAsset found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>