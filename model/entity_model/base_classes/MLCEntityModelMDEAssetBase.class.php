<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - FinalAction()
* - Query()
* Classes list:
* - MLCEntityModelMDEAssetBase extends MLCEntityModelClassBase
*/
class MLCEntityModelMDEAssetBase extends MLCEntityModelClassBase {
    protected $strClassName = 'MDEAsset';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if ($strName == 'new') {
            $objMDEAsset = new MDEAsset();
        } else {
            $objMDEAsset = MDEAsset::LoadById($strName);
        }
        if (!is_null($objMDEAsset)) {
            return new MLCEntityModelMDEAssetObject($objMDEAsset);
        } else {
            throw new MLCEntityModelException("No MDEAsset found with the data you submitted");
        }
    }
    public function FinalAction($arrPostData) {
        $objResponse = new MLCEntityModelResponse(MDEAsset::LoadAll()->GetCollection());
        $objResponse->BodyType = 'MDEAsset';
        return $objResponse;
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>