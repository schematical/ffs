<?php
/**
* Class and Function List:
* Function list:
* - Query()
* - GetArrByDeviceAndSession()
* - GetArrBySessionAndDevice()
* Classes list:
* - AssignmentRelBase extends AssignmentBase
*/
require_once (__MODEL_APP_DATALAYER_DIR__ . "/base_classes/AssignmentBase.class.php");
class AssignmentRelBase extends AssignmentBase {
    public static function Query($strExtra, $blnReturnSingle = false, $arrJoin = array()) {
        $arrJoin = array();
        $arrJoin[] = 'Device';
        $arrJoin[] = 'Session';
        return parent::Query($strExtra, $blnReturnSingle, $arrJoin);
    }
    public static function GetArrByDeviceAndSession($objDevice, $objSession, $strExtra = '') {
        return self::Query(sprintf('WHERE (Assignment_rel.idDevice = %s AND Assignment_rel.idSession = %s) %s', $objDevice->idDevice, $objSession->idSession, $strExtra));
    }
    public static function GetArrBySessionAndDevice($objSession, $objDevice, $strExtra = '') {
        return self::Query(sprintf('WHERE (Assignment_rel.idSession = %s AND Assignment_rel.idDevice = %s) %s', $objSession->idSession, $objDevice->idDevice, $strExtra));
    }
}
?>