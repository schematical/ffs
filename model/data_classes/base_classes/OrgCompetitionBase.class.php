<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - LoadById()
* - LoadAll()
* - ToXml()
* - Materilize()
* - GetSQLSelectFieldsAsArr()
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
* - OrgCompetitionBase extends MLCBaseEntity
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
class OrgCompetitionBase extends MLCBaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'OrgCompetition_rel';
    const P_KEY = 'idOrgCompetition';
    protected $objIdOrg = null;
    protected $objIdCompetition = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE OrgCompetition_rel.idOrgCompetition = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = new BaseEntityCollection(self::Query(''));
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
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('OrgCompetition_rel.idOrgCompetition', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idOrgCompetition'] = $arrData['OrgCompetition_rel.idOrgCompetition'];
                $this->arrDBFields['idOrg'] = $arrData['OrgCompetition_rel.idOrg'];
                $this->arrDBFields['idCompetition'] = $arrData['OrgCompetition_rel.idCompetition'];
                $this->arrDBFields['creDate'] = $arrData['OrgCompetition_rel.creDate'];
                $this->arrDBFields['idAuthUser'] = $arrData['OrgCompetition_rel.idAuthUser'];
                //Foregin Key
                if ((array_key_exists('Org.idOrg', $arrData)) && (!is_null($arrData['Org.idOrg']))) {
                    $this->objIdOrg = new Org();
                    $this->objIdOrg->Materilize($arrData);
                }
                if ((array_key_exists('Competition.idCompetition', $arrData)) && (!is_null($arrData['Competition.idCompetition']))) {
                    $this->objIdCompetition = new Competition();
                    $this->objIdCompetition->Materilize($arrData);
                }
            } else {
                //Old ways
                $this->arrDBFields = $arrData;
            }
            $this->loaded = true;
            $this->setId($this->getField($this->getPKey()));
        }
        if (self::$blnUseCache) {
            if (!array_key_exists(get_class($this) , self::$arrCachedData)) {
                self::$arrCachedData[get_class($this) ] = array();
            }
            self::$arrCachedData[get_class($this) ][$this->getId() ] = $this;
        }
    }
    public static function GetSQLSelectFieldsAsArr($blnLongSelect = false) {
        $arrFields = array();
        $arrFields[] = 'OrgCompetition_rel.idOrgCompetition ' . (($blnLongSelect) ? ' as "OrgCompetition_rel.idOrgCompetition"' : '');
        $arrFields[] = 'OrgCompetition_rel.idOrg ' . (($blnLongSelect) ? ' as "OrgCompetition_rel.idOrg"' : '');
        $arrFields[] = 'OrgCompetition_rel.idCompetition ' . (($blnLongSelect) ? ' as "OrgCompetition_rel.idCompetition"' : '');
        $arrFields[] = 'OrgCompetition_rel.creDate ' . (($blnLongSelect) ? ' as "OrgCompetition_rel.creDate"' : '');
        $arrFields[] = 'OrgCompetition_rel.idAuthUser ' . (($blnLongSelect) ? ' as "OrgCompetition_rel.idAuthUser"' : '');
        return $arrFields;
    }
    public static function Query($strExtra, $mixReturnSingle = false, $arrJoins = null) {
        $blnLongSelect = !is_null($arrJoins);
        $arrFields = self::GetSQLSelectFieldsAsArr($blnLongSelect);
        if ($blnLongSelect) {
            foreach ($arrJoins as $strTable) {
                if (class_exists($strTable)) {
                    $arrFields = array_merge($arrFields, call_user_func($strTable . '::GetSQLSelectFieldsAsArr', true));
                }
            }
        }
        $strFields = implode(', ', $arrFields);
        $strJoin = '';
        if ($blnLongSelect) {
            foreach ($arrJoins as $strTable) {
                switch ($strTable) {
                    case ('Org'):
                        $strJoin.= ' LEFT JOIN Org ON OrgCompetition_rel.idOrg = Org.idOrg';
                    break;
                    case ('Competition'):
                        $strJoin.= ' LEFT JOIN Competition ON OrgCompetition_rel.idCompetition = Competition.idCompetition';
                    break;
                }
            }
        }
        $strSql = sprintf("SELECT %s FROM OrgCompetition_rel %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('OrgCompetition');
        }
        $collReturn->AddQueryToHistory($strSql);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new OrgCompetition();
            $tObj->Materilize($data);
            $collReturn[] = $tObj;
        }
        //$collReturn = $coll->getCollection();
        if ($mixReturnSingle !== false) {
            if (count($collReturn) == 0) {
                return null;
            } else {
                return $collReturn[0];
            }
        } else {
            return $collReturn;
        }
    }
    public static function QueryCount($strExtra = '') {
        $strSql = sprintf("SELECT OrgCompetition_rel.* FROM OrgCompetition_rel %s;", $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdOrg($intIdOrg) {
        $strSql = sprintf("SELECT OrgCompetition_rel.* FROM OrgCompetition_rel WHERE idOrg = %s;", $intIdOrg);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objOrgCompetition = new OrgCompetition();
            $objOrgCompetition->materilize($data);
            $coll->addItem($objOrgCompetition);
        }
        return $coll;
    }
    public static function LoadCollByIdCompetition($intIdCompetition) {
        $strSql = sprintf("SELECT OrgCompetition_rel.* FROM OrgCompetition_rel WHERE idCompetition = %s;", $intIdCompetition);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
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
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE OrgCompetition_rel.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE OrgCompetition_rel.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $collReturn = array();
        $collReturn['_ClassName'] = "OrgCompetition %>";
        $collReturn['idOrgCompetition'] = $this->idOrgCompetition;
        $collReturn['idOrg'] = $this->idOrg;
        $collReturn['idCompetition'] = $this->idCompetition;
        $collReturn['creDate'] = $this->creDate;
        $collReturn['idAuthUser'] = $this->idAuthUser;
        return $collReturn;
    }
    public function __toString() {
        return 'OrgCompetition(' . $this->getId() . ')';
    }
    public function __toJson($blnPosponeEncode = false) {
        $collReturn = $this->__toArray();
        if ($blnPosponeEncode) {
            return json_encode($collReturn);
        } else {
            return $collReturn;
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
                if (!is_null($this->objIdOrg)) {
                    return $this->objIdOrg;
                }
                if ((array_key_exists('idOrg', $this->arrDBFields)) && (!is_null($this->arrDBFields['idOrg']))) {
                    $this->objIdOrg = Org::LoadById($this->arrDBFields['idOrg']);
                    return $this->objIdOrg;
                }
                return null;
            break;
            case ('IdCompetitionObject'):
                if (!is_null($this->objIdCompetition)) {
                    return $this->objIdCompetition;
                }
                if ((array_key_exists('idCompetition', $this->arrDBFields)) && (!is_null($this->arrDBFields['idCompetition']))) {
                    $this->objIdCompetition = Competition::LoadById($this->arrDBFields['idCompetition']);
                    return $this->objIdCompetition;
                }
                return null;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
    public function __set($strName, $mixValue) {
        $this->modified = 1;
        switch ($strName) {
            case ('IdOrgCompetition'):
            case ('idOrgCompetition'):
                $this->arrDBFields['idOrgCompetition'] = $mixValue;
            break;
            case ('IdOrg'):
            case ('idOrg'):
                $this->arrDBFields['idOrg'] = $mixValue;
                $this->objIdOrg = null;
            break;
            case ('IdCompetition'):
            case ('idCompetition'):
                $this->arrDBFields['idCompetition'] = $mixValue;
                $this->objIdCompetition = null;
            break;
            case ('CreDate'):
            case ('creDate'):
            case ('_CreDate'):
                $this->arrDBFields['creDate'] = $mixValue;
            break;
            case ('IdAuthUser'):
            case ('idAuthUser'):
                $this->arrDBFields['idAuthUser'] = $mixValue;
            break;
            case ('IdOrgObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof Org)))) {
                    throw new MLCWrongTypeException('__set', $strName);
                }
                if (!is_null($mixValue)) {
                    $this->arrDBFields['idOrg'] = $mixValue->idOrg;
                } else {
                    $this->arrDBFields['idOrg'] = null;
                }
                $this->objIdOrg = $mixValue;
            break;
            case ('IdCompetitionObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof Competition)))) {
                    throw new MLCWrongTypeException('__set', $strName);
                }
                if (!is_null($mixValue)) {
                    $this->arrDBFields['idCompetition'] = $mixValue->idCompetition;
                } else {
                    $this->arrDBFields['idCompetition'] = null;
                }
                $this->objIdCompetition = $mixValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>