<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiStripeDataBase extends MLCApiClassBase
*/
class MLCApiStripeDataBase extends MLCApiClassBase {
    protected $strClassName = 'StripeData';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objStripeData = StripeData::LoadById($strName);
        } else {
            $objStripeData = null;
        }
        if (!is_null($objStripeData)) {
            return new MLCApiStripeDataObject($objStripeData);
        } else {
            throw new MLCApiException("No StripeData found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>