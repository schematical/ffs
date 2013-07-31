<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiAlertBase extends MLCApiClassBase
*/
class MLCApiAlertBase extends MLCApiClassBase {
    protected $strClassName = 'Alert';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName)) {
            $objAlert = Alert::LoadById($strName);
        } else {
            $objAlert = null;
        }
        if (!is_null($objAlert)) {
            return new MLCApiAlertObject($objAlert);
        } else {
            throw new MLCApiException("No Alert found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>