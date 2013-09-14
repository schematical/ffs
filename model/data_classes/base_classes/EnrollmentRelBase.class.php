<?php
/**
* Class and Function List:
* Function list:
* - Query()
* - QueryCount()
* - GetArrByAtheleteAndCompetition()
* - GetArrByAtheleteAndSession()
* - GetArrByCompetitionAndAthelete()
* - GetArrByCompetitionAndSession()
* - GetArrBySessionAndAthelete()
* - GetArrBySessionAndCompetition()
* Classes list:
* - EnrollmentRelBase extends EnrollmentBase
*/
require_once (__MODEL_APP_DATALAYER_DIR__ . "/base_classes/EnrollmentBase.class.php");
class EnrollmentRelBase extends EnrollmentBase {
    public static function Query($strExtra = null, $blnReturnSingle = false, $arrJoin = array()) {
        $arrJoin = array();
        $arrJoin[] = 'Athelete';
        $arrJoin[] = 'Competition';
        $arrJoin[] = 'Session';
        return parent::Query($strExtra, $blnReturnSingle, $arrJoin);
    }
    public static function QueryCount($strExtra = null, $arrJoin = array()) {
        $arrJoin = array();
        $arrJoin[] = 'Athelete';
        $arrJoin[] = 'Competition';
        $arrJoin[] = 'Session';
        return parent::QueryCount($strExtra, $arrJoin);
    }
    public static function GetArrByAtheleteAndCompetition($objAthelete, $objCompetition, $strExtra = '') {
        return self::Query(sprintf('WHERE (Enrollment_rel.idAthelete = %s AND Enrollment_rel.idCompetition = %s) %s', $objAthelete->idAthelete, $objCompetition->idCompetition, $strExtra));
    }
    public static function GetArrByAtheleteAndSession($objAthelete, $objSession, $strExtra = '') {
        return self::Query(sprintf('WHERE (Enrollment_rel.idAthelete = %s AND Enrollment_rel.idSession = %s) %s', $objAthelete->idAthelete, $objSession->idSession, $strExtra));
    }
    public static function GetArrByCompetitionAndAthelete($objCompetition, $objAthelete, $strExtra = '') {
        return self::Query(sprintf('WHERE (Enrollment_rel.idCompetition = %s AND Enrollment_rel.idAthelete = %s) %s', $objCompetition->idCompetition, $objAthelete->idAthelete, $strExtra));
    }
    public static function GetArrByCompetitionAndSession($objCompetition, $objSession, $strExtra = '') {
        return self::Query(sprintf('WHERE (Enrollment_rel.idCompetition = %s AND Enrollment_rel.idSession = %s) %s', $objCompetition->idCompetition, $objSession->idSession, $strExtra));
    }
    public static function GetArrBySessionAndAthelete($objSession, $objAthelete, $strExtra = '') {
        return self::Query(sprintf('WHERE (Enrollment_rel.idSession = %s AND Enrollment_rel.idAthelete = %s) %s', $objSession->idSession, $objAthelete->idAthelete, $strExtra));
    }
    public static function GetArrBySessionAndCompetition($objSession, $objCompetition, $strExtra = '') {
        return self::Query(sprintf('WHERE (Enrollment_rel.idSession = %s AND Enrollment_rel.idCompetition = %s) %s', $objSession->idSession, $objCompetition->idCompetition, $strExtra));
    }
}
?>