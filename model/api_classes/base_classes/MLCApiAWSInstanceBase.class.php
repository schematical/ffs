<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiAWSInstanceBase extends MLCApiClassBase
*/
class MLCApiAWSInstanceBase extends MLCApiClassBase {
    protected $strClassName = 'AWSInstance';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName)) {
            $objAWSInstance = AWSInstance::LoadById($strName);
        } else {
            $objAWSInstance = null;
        }
        if (!is_null($objAWSInstance)) {
            return new MLCApiAWSInstanceObject($objAWSInstance);
        } else {
            throw new MLCApiException("No AWSInstance found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>