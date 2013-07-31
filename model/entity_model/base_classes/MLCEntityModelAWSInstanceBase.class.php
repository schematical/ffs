<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - FinalAction()
* - Query()
* Classes list:
* - MLCEntityModelAWSInstanceBase extends MLCEntityModelClassBase
*/
class MLCEntityModelAWSInstanceBase extends MLCEntityModelClassBase {
    protected $strClassName = 'AWSInstance';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if ($strName == 'new') {
            $objAWSInstance = new AWSInstance();
        } else {
            $objAWSInstance = AWSInstance::LoadById($strName);
        }
        if (!is_null($objAWSInstance)) {
            return new MLCEntityModelAWSInstanceObject($objAWSInstance);
        } else {
            throw new MLCEntityModelException("No AWSInstance found with the data you submitted");
        }
    }
    public function FinalAction($arrPostData) {
        $objResponse = new MLCEntityModelResponse(AWSInstance::LoadAll()->GetCollection());
        $objResponse->BodyType = 'AWSInstance';
        return $objResponse;
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>