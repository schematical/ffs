<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - FFSJsonSearchDriver extends FFSJsonSearchDriverBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/FFSJsonSearchDriverBase.class.php");
class FFSJsonSearchDriver extends FFSJsonSearchDriverBase {
    public function GetSessionOwnerQuery(){
        if(!is_null( FFSForm::$objCompetition)){
            return ' AND idCompetition = ' . FFSForm::$objCompetition->IdCompetition;
        }
        return ' AND 0';
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
