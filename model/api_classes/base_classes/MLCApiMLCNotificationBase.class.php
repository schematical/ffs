<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiMLCNotificationBase extends MLCApiClassBase
*/
class MLCApiMLCNotificationBase extends MLCApiClassBase {
    protected $strClassName = 'MLCNotification';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        $objMLCNotification = MLCNotification::LoadById($strName);
        if (!is_null($objMLCNotification)) {
            return new MLCApiMLCNotificationObject($objMLCNotification);
        } else {
            throw new MLCApiException("No MLCNotification found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>