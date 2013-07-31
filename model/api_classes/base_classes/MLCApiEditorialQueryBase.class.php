<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiEditorialQueryBase extends MLCApiClassBase
*/
class MLCApiEditorialQueryBase extends MLCApiClassBase {
    protected $strClassName = 'EditorialQuery';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName)) {
            $objEditorialQuery = EditorialQuery::LoadById($strName);
        } else {
            $objEditorialQuery = null;
        }
        if (!is_null($objEditorialQuery)) {
            return new MLCApiEditorialQueryObject($objEditorialQuery);
        } else {
            throw new MLCApiException("No EditorialQuery found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>