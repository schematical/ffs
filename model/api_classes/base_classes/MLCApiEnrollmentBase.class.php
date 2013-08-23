<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiEnrollmentBase extends MLCApiClassBase
*/
class MLCApiEnrollmentBase extends MLCApiClassBase {
    protected $strClassName = 'Enrollment';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objEnrollment = Enrollment::LoadById($strName);
        } else {
            $objEnrollment = null;
        }
        if (!is_null($objEnrollment)) {
            return new MLCApiEnrollmentObject($objEnrollment);
        } else {
            throw new MLCApiException("No Enrollment found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>