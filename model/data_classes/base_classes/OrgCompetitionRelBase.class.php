<?php
/**
* Class and Function List:
* Function list:
* - Query()
* - QueryCount()
* - GetArrByOrgAndCompetition()
* - GetArrByCompetitionAndOrg()
* Classes list:
* - OrgCompetitionRelBase extends OrgCompetitionBase
*/
require_once (__MODEL_APP_DATALAYER_DIR__ . "/base_classes/OrgCompetitionBase.class.php");
class OrgCompetitionRelBase extends OrgCompetitionBase {
    public static function Query($strExtra = null, $blnReturnSingle = false, $arrJoin = array()) {
        $arrJoin = array();
        $arrJoin[] = 'Org';
        $arrJoin[] = 'Competition';
        return parent::Query($strExtra, $blnReturnSingle, $arrJoin);
    }
    public static function QueryCount($strExtra = null, $arrJoin = array()) {
        $arrJoin = array();
        $arrJoin[] = 'Org';
        $arrJoin[] = 'Competition';
        return parent::QueryCount($strExtra, $arrJoin);
    }
    public static function GetArrByOrgAndCompetition($objOrg, $objCompetition, $strExtra = '') {
        return self::Query(sprintf('WHERE (OrgCompetition_rel.idOrg = %s AND OrgCompetition_rel.idCompetition = %s) %s', $objOrg->idOrg, $objCompetition->idCompetition, $strExtra));
    }
    public static function GetArrByCompetitionAndOrg($objCompetition, $objOrg, $strExtra = '') {
        return self::Query(sprintf('WHERE (OrgCompetition_rel.idCompetition = %s AND OrgCompetition_rel.idOrg = %s) %s', $objCompetition->idCompetition, $objOrg->idOrg, $strExtra));
    }
}
?>