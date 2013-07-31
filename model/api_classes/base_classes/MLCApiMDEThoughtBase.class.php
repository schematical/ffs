<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiMDEThoughtBase extends MLCApiClassBase
*/
class MLCApiMDEThoughtBase extends MLCApiClassBase {
    protected $strClassName = 'MDEThought';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName)) {
            $objMDEThought = MDEThought::LoadById($strName);
        } else {
            $objMDEThought = null;
        }
        if (!is_null($objMDEThought)) {
            return new MLCApiMDEThoughtObject($objMDEThought);
        } else {
            throw new MLCApiException("No MDEThought found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>