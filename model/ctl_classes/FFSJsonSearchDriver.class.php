<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - FFSJsonSearchDriver extends FFSJsonSearchDriverBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/FFSJsonSearchDriverBase.class.php");
FFSApplication::Init();
class FFSJsonSearchDriver extends FFSJsonSearchDriverBase {
    public function GetSessionOwnerQuery(){
        if(!is_null( FFSForm::$objCompetition)){
            return ' AND idCompetition = ' . FFSForm::$objCompetition->IdCompetition;
        }
        return ' AND 0';
    }

    public function GetEnrollmentOwnerQuery(){
        if(!is_null( FFSForm::$objSession)){
            return ' AND Enrollment_rel.idSession = ' . FFSForm::$objSession->IdSession;
        }elseif(!is_null( FFSForm::$objCompetition)){
            return ' AND Enrollment_rel.idCompetition = ' . FFSForm::$objCompetition->IdCompetition;
        }
        //TODO: Allow search by athelete/session
        return ' AND 0';
    }
    public function _searchEnrollment($strSearch, $strField = null) {
        switch($strField){
            case('flight'):
            case('division'):
            case('level'):
            case('ageGroup'):
            case('misc1'):
            case('misc2'):
            case('misc3'):
            case('misc4'):
            case('misc5'):
                if(!is_null(FFSForm::$objSession)){
                    $arrData = FFSForm::$objSession->Data($strField.'s');
                    if(is_null($arrData)){
                        $arrData = array();
                    }
                    $arrReturn = array();
                    if(!array_key_exists($strField, $arrData)){
                        $arrReturn[] = array(
                            'value'=>$strSearch,
                            'text'=>$strSearch
                        );
                    }
                    foreach($arrData as $strKey => $strText){
                        $arrReturn[] = array(
                            'value'=> $strKey,
                            'text' => $strText
                        );
                    }


                    return die(json_encode($arrReturn));
                }

        }
        return parent::_searchEnrollment($strSearch, $strField);
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
