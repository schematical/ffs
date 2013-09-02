<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - LoadById()
* - LoadAll()
* - ToXml()
* - Query()
* - QueryCount()
* - LoadCollByIdOrg()
* - LoadCollByIdCompetition()
* - LoadByTag()
* - AddTag()
* - ParseArray()
* - Parse()
* - LoadSingleByField()
* - LoadArrayByField()
* - __toArray()
* - __toString()
* - __toJson()
* - __get()
* - __set()
* Classes list:
* - OrgCompetitionBase extends BaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdOrgCompetition
 * @property-write mixed $IdOrgCompetition
 * @property-read mixed $IdOrg
 * @property-write mixed $IdOrg
 * @property-read mixed $IdCompetition
 * @property-write mixed $IdCompetition
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $IdAuthUser
 * @property-write mixed $IdAuthUser
 * @property-read OrgCompetition $IdOrgObject
 * @property-read OrgCompetition $IdCompetitionObject
 */
class OrgCompetitionBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'OrgCompetition';
    const P_KEY = 'idOrgCompetition';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idOrgCompetition = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new OrgCompetition();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, OrgCompetition::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new OrgCompetition();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<OrgCompetition>";
        $xmlStr.= "<idOrgCompetition>";
        $xmlStr.= $this->idOrgCompetition;
        $xmlStr.= "</idOrgCompetition>";
        $xmlStr.= "<idOrg>";
        $xmlStr.= $this->idOrg;
        $xmlStr.= "</idOrg>";
        $xmlStr.= "<idCompetition>";
        $xmlStr.= $this->idCompetition;
        $xmlStr.= "</idCompetition>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<idAuthUser>";
        $xmlStr.= $this->idAuthUser;
        $xmlStr.= "</idAuthUser>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</OrgCompetition>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new OrgCompetition();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrReturn = $coll->getCollection();
        if ($blnReturnSingle) {
            if (count($arrReturn) == 0) {
                return null;
            } else {
                return $arrReturn[0];
            }
        } else {
            return $arrReturn;
        }
    }
    public static function QueryCount($strExtra = '') {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdOrg($intIdOrg) {
        $sql = sprintf("SELECT * FROM OrgCompetition WHERE idOrg = %s;", $intIdOrg);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objOrgCompetition = new OrgCompetition();
            $objOrgCompetition->materilize($data);
            $coll->addItem($objOrgCompetition);
        }
        return $coll;
    }
    public static function LoadCollByIdCompetition($intIdCompetition) {
        $sql = sprintf("SELECT * FROM OrgCompetition WHERE idCompetition = %s;", $intIdCompetition);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objOrgCompetition = new OrgCompetition();
            $objOrgCompetition->materilize($data);
            $coll->addItem($objOrgCompetition);
        }
        return $coll;
    }
    public function LoadByTag($strTag) {
        return MLCTagDriver::LoadTaggedEntites($strTag, get_class($this));
    }
    public function AddTag($mixTag) {
        return MLCTagDriver::AddTag($mixTag, $this);
    }
    public function ParseArray($arrData) {
        foreach ($arrData as $strKey => $mixVal) {
            $arrData[strtolower($strKey) ] = $mixVal;
        }
    }
    public static function Parse($mixData, $blnReturnId = false) {
        if (is_numeric($mixData)) {
            if ($blnReturnId) {
                return $mixData;
            }
            return OrgCompetition::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'OrgCompetition')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdOrgCompetition;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "OrgCompetition"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        $arrResults = self::LoadArrayByField($strField, $mixValue, $strCompairison);
        if (count($arrResults)) {
            return $arrResults[0];
        }
        return null;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE %s %s %s', $strField, $strCompairison, $strValue);
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        //die($sql);
        $result = MLCDBDriver::query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new OrgCompetition();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "OrgCompetition %>";
        $arrReturn['idOrgCompetition'] = $this->idOrgCompetition;
        $arrReturn['idOrg'] = $this->idOrg;
        $arrReturn['idCompetition'] = $this->idCompetition;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['idAuthUser'] = $this->idAuthUser;
        return $arrReturn;
    }
    public function __toString() {
        return 'OrgCompetition(' . $this->getId() . ')';
    }
    public function __toJson($blnPosponeEncode = false) {
        $arrReturn = $this->__toArray();
        if ($blnPosponeEncode) {
            return json_encode($arrReturn);
        } else {
            return $arrReturn;
        }
    }
    public function __get($strName) {
        switch ($strName) {
            case ('IdOrgCompetition'):
            case ('idOrgCompetition'):
                if (array_key_exists('idOrgCompetition', $this->arrDBFields)) {
                    return $this->arrDBFields['idOrgCompetition'];
                }
                return null;
            break;
            case ('IdOrg'):
            case ('idOrg'):
                if (array_key_exists('idOrg', $this->arrDBFields)) {
                    return $this->arrDBFields['idOrg'];
                }
                return null;
            break;
            case ('IdCompetition'):
            case ('idCompetition'):
                if (array_key_exists('idCompetition', $this->arrDBFields)) {
                    return $this->arrDBFields['idCompetition'];
                }
                return null;
            break;
            case ('CreDate'):
            case ('creDate'):
                if (array_key_exists('creDate', $this->arrDBFields)) {
                    return $this->arrDBFields['creDate'];
                }
                return null;
            break;
            case ('IdAuthUser'):
            case ('idAuthUser'):
                if (array_key_exists('idAuthUser', $this->arrDBFields)) {
                    return $this->arrDBFields['idAuthUser'];
                }
                return null;
            break;
            case ('IdOrgObject'):
            case ('idCompetitionObject'):
                if ((array_key_exists('idOrg', $this->arrDBFields)) && (!is_null($this->arrDBFields['idOrg']))) {
                    return Org::LoadById($this->arrDBFields['idOrg']);
                }
                return null;
            break;
            case ('IdCompetitionObject'):
            case ('idCompetitionObject'):
                if ((array_key_exists('idCompetition', $this->arrDBFields)) && (!is_null($this->arrDBFields['idCompetition']))) {
                    return Competition::LoadById($this->arrDBFields['idCompetition']);
                }
                return null;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
    public function __set($strName, $strValue) {
        $this->modified = 1;
        switch ($strName) {
            case ('IdOrgCompetition'):
            case ('idOrgCompetition'):
                $this->arrDBFields['idOrgCompetition'] = $strValue;
            break;
            case ('IdOrg'):
            case ('idOrg'):
                $this->arrDBFields['idOrg'] = $strValue;
            break;
            case ('IdCompetition'):
            case ('idCompetition'):
                $this->arrDBFields['idCompetition'] = $strValue;
            break;
            case ('CreDate'):
            case ('creDate'):
                $this->arrDBFields['creDate'] = $strValue;
            break;
            case ('IdAuthUser'):
            case ('idAuthUser'):
                $this->arrDBFields['idAuthUser'] = $strValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>