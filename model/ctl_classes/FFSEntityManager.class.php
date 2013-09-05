<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - FFSEntityManager extends FFSEntityManagerBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/FFSEntityManagerBase.class.php");
class FFSEntityManager extends FFSEntityManagerBase {
    public function Populate(){
        parent::Populate();
        if(is_null($this->objCompetition)){

            $arrOrgs = MLCAuthDriver::GetRolls(FFSRoll::ORG_MANAGER);
            if(count($arrOrgs) == 0){
                //Do nothing
            }elseif(count($arrOrgs) == 1){
                $this->objOrg = $arrOrgs[0]->GetEntity();

            }else{
                $this->objOrg =$arrOrgs[0]->GetEntity();
            }
        }
        if(!is_null($this->objCompetition)){
            $intIdSession = MLCApplication::QS(FFSQS::IdSession);
            if(is_null($intIdSession)){
                $intIdSession = MLCApplication::QS(FFSQS::Session_IdSession);
            }
            if(
                (!is_null($intIdSession)) &&
                (is_numeric($intIdSession))
            ){
                $this->objSession = Session::Query(
                    sprintf(
                        'WHERE idSession = %s AND idCompetition = %s',
                        $intIdSession,
                        $this->objCompetition->IdCompetition
                    ),
                    true
                );
            }
        }
    }
    public function SearchEnrollment($strSearch, $strField = null){
        //TODO Move this, i put it here becasuse I did not want it genned over

        //TODO: Move divisions from session to competition, etc
        //Competition: Divisions, Levels, etc
        if(!is_null($this->objSession)){

            switch($strField){
                case('division'):
                case('ageGroup'):
                case "flight":
                case "level":
                case "misc1":
                case "misc2":
                case "misc3":
                case "misc4":
                case "misc5":
                    $arrFieldData = $this->objSession->Data($strField .'s');
                    if(is_null($arrFieldData)){
                        $arrFieldData = array();
                    }
                    $arrJsonData = array();
                    if(!array_key_exists($strSearch, $arrFieldData)){
                        $arrJsonData[] = array(
                            'text' => $strSearch,
                            'value' => $strSearch
                        );
                    }

                    foreach($arrFieldData as $strKey => $strVal){
                        $arrJsonData[] = array(
                            'text' => $strVal,
                            'value' => $strKey
                        );
                    }
                    die(json_encode($arrJsonData));
            }
        }
        return parent::SearchEnrollment($strSearch, $strField = null);

    }
    public function GetSessionOwnerQuery(){
        if(!is_null($this->objCompetition)){
            return ' AND Session.idCompetition = ' . $this->objCompetition->IdCompetition;
        }else{
            return ' AND 0';
        }
    }
    /*
    
       public function GetAssignmentOwnerQuery(){
            return ' AND idAuthUser = ' . MLCAuthDriver::User();
       }
    
       public function GetAtheleteOwnerQuery(){
            return ' AND idAuthUser = ' . MLCAuthDriver::User();
       }
    
       public function GetCompetitionOwnerQuery(){
            return ' AND idAuthUser = ' . MLCAuthDriver::User();
       }
    
       public function GetDeviceOwnerQuery(){
            return ' AND idAuthUser = ' . MLCAuthDriver::User();
       }
    
       public function GetEnrollmentOwnerQuery(){
            return ' AND idAuthUser = ' . MLCAuthDriver::User();
       }
    
       public function GetOrgOwnerQuery(){
            return ' AND idAuthUser = ' . MLCAuthDriver::User();
       }
    
       public function GetOrgCompetitionOwnerQuery(){
            return ' AND idAuthUser = ' . MLCAuthDriver::User();
       }
    
       public function GetParentMessageOwnerQuery(){
            return ' AND idAuthUser = ' . MLCAuthDriver::User();
       }
    
       public function GetResultOwnerQuery(){
            return ' AND idAuthUser = ' . MLCAuthDriver::User();
       }
    

    
    */
}
