<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - FinalAction()
* - Query()
* Classes list:
* - MLCEntityModelMLCNotificationBase extends MLCEntityModelClassBase
*/
class MLCEntityModelMLCNotificationBase extends MLCEntityModelClassBase {
    protected $strClassName = 'MLCNotification';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if ($strName == 'new') {
            $objMLCNotification = new MLCNotification();
        } else {
            $objMLCNotification = MLCNotification::LoadById($strName);
        }
        if (!is_null($objMLCNotification)) {
            return new MLCEntityModelMLCNotificationObject($objMLCNotification);
        } else {
            throw new MLCEntityModelException("No MLCNotification found with the data you submitted");
        }
    }
    public function FinalAction($arrPostData) {
        $objResponse = new MLCEntityModelResponse(MLCNotification::LoadAll()->GetCollection());
        $objResponse->BodyType = 'MLCNotification';
        return $objResponse;
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>