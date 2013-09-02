<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiOrgCompetitionBase extends MLCApiClassBase
*/
class MLCApiOrgCompetitionBase extends MLCApiClassBase {
    protected $strClassName = 'OrgCompetition';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objOrgCompetition = OrgCompetition::LoadById($strName);
        } else {
            $objOrgCompetition = null;
        }
        if (!is_null($objOrgCompetition)) {
            return new MLCApiOrgCompetitionObject($objOrgCompetition);
        } else {
            throw new MLCApiException("No OrgCompetition found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>