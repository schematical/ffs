<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiAssignmentBase extends MLCApiClassBase
*/
class MLCApiAssignmentBase extends MLCApiClassBase {
    protected $strClassName = 'Assignment';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objAssignment = Assignment::LoadById($strName);
        } else {
            $objAssignment = null;
        }
        if (!is_null($objAssignment)) {
            return new MLCApiAssignmentObject($objAssignment);
        } else {
            throw new MLCApiException("No Assignment found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>