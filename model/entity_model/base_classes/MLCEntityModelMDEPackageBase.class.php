<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - FinalAction()
* - Query()
* Classes list:
* - MLCEntityModelMDEPackageBase extends MLCEntityModelClassBase
*/
class MLCEntityModelMDEPackageBase extends MLCEntityModelClassBase {
    protected $strClassName = 'MDEPackage';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if ($strName == 'new') {
            $objMDEPackage = new MDEPackage();
        } else {
            $objMDEPackage = MDEPackage::LoadById($strName);
        }
        if (!is_null($objMDEPackage)) {
            return new MLCEntityModelMDEPackageObject($objMDEPackage);
        } else {
            throw new MLCEntityModelException("No MDEPackage found with the data you submitted");
        }
    }
    public function FinalAction($arrPostData) {
        $objResponse = new MLCEntityModelResponse(MDEPackage::LoadAll()->GetCollection());
        $objResponse->BodyType = 'MDEPackage';
        return $objResponse;
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>