<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiResultBase extends MLCApiClassBase
*/
class MLCApiResultBase extends MLCApiClassBase {
    protected $strClassName = 'Result';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objResult = Result::LoadById($strName);
        } else {
            $objResult = null;
        }
        if (!is_null($objResult)) {
            return new MLCApiResultObject($objResult);
        } else {
            throw new MLCApiException("No Result found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>