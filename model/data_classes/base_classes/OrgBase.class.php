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
* - GetAtheleteArr()
* - GetCompetitionArr()
* - GetDeviceArr()
* - GetOrgCompetitionArr()
* - GetOrgCompetitionArrByCompetition()
* - CreateOrgCompetitionFromCompetition()
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
* - PsData()
* Classes list:
* - OrgBase extends MLCBaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdOrg
 * @property-write mixed $IdOrg
 * @property-read mixed $Namespace
 * @property-write mixed $Namespace
 * @property-read mixed $Name
 * @property-write mixed $Name
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $IdImportAuthUser
 * @property-write mixed $IdImportAuthUser
 * @property-read mixed $ClubNum
 * @property-write mixed $ClubNum
 * @property-read mixed $ClubType
 * @property-write mixed $ClubType
 */
class OrgBase extends MLCBaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Org';
    const P_KEY = 'idOrg';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE Org.idOrg = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = new BaseEntityCollection(self::Query(''));
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<Org>";
        $xmlStr.= "<idOrg>";
        $xmlStr.= $this->idOrg;
        $xmlStr.= "</idOrg>";
        $xmlStr.= "<namespace>";
        $xmlStr.= $this->namespace;
        $xmlStr.= "</namespace>";
        $xmlStr.= "<name>";
        $xmlStr.= $this->name;
        $xmlStr.= "</name>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<psData>";
        $xmlStr.= $this->psData;
        $xmlStr.= "</psData>";
        $xmlStr.= "<idImportAuthUser>";
        $xmlStr.= $this->idImportAuthUser;
        $xmlStr.= "</idImportAuthUser>";
        $xmlStr.= "<clubNum>";
        $xmlStr.= $this->clubNum;
        $xmlStr.= "</clubNum>";
        $xmlStr.= "<clubType>";
        $xmlStr.= $this->clubType;
        $xmlStr.= "</clubType>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</Org>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('Org.idOrg', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idOrg'] = $arrData['Org.idOrg'];
                $this->arrDBFields['namespace'] = $arrData['Org.namespace'];
                $this->arrDBFields['name'] = $arrData['Org.name'];
                $this->arrDBFields['creDate'] = $arrData['Org.creDate'];
                $this->arrDBFields['psData'] = $arrData['Org.psData'];
                $this->arrDBFields['idImportAuthUser'] = $arrData['Org.idImportAuthUser'];
                $this->arrDBFields['clubNum'] = $arrData['Org.clubNum'];
                $this->arrDBFields['clubType'] = $arrData['Org.clubType'];
                //Foregin Key
                
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
        $arrFields[] = 'Org.idOrg ' . (($blnLongSelect) ? ' as "Org.idOrg"' : '');
        $arrFields[] = 'Org.namespace ' . (($blnLongSelect) ? ' as "Org.namespace"' : '');
        $arrFields[] = 'Org.name ' . (($blnLongSelect) ? ' as "Org.name"' : '');
        $arrFields[] = 'Org.creDate ' . (($blnLongSelect) ? ' as "Org.creDate"' : '');
        $arrFields[] = 'Org.psData ' . (($blnLongSelect) ? ' as "Org.psData"' : '');
        $arrFields[] = 'Org.idImportAuthUser ' . (($blnLongSelect) ? ' as "Org.idImportAuthUser"' : '');
        $arrFields[] = 'Org.clubNum ' . (($blnLongSelect) ? ' as "Org.clubNum"' : '');
        $arrFields[] = 'Org.clubType ' . (($blnLongSelect) ? ' as "Org.clubType"' : '');
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
                }
            }
        }
        $strSql = sprintf("SELECT %s FROM Org %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('Org');
        }
        $collReturn->AddQueryToHistory($strSql);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Org();
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
        $strSql = sprintf("SELECT Org.* FROM Org %s;", $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    public function GetAtheleteArr() {
        return Athelete::LoadCollByIdOrg($this->idOrg)->getCollection();
    }
    public function GetCompetitionArr() {
        return Competition::LoadCollByIdOrg($this->idOrg)->getCollection();
    }
    public function GetDeviceArr() {
        return Device::LoadCollByIdOrg($this->idOrg)->getCollection();
    }
    public function GetOrgCompetitionArr($strExtra = '') {
        return OrgCompetition::Query('WHERE OrgCompetition_rel.idOrg = ' . $this->idOrg . ' ' . $strExtra);
    }
    public function GetOrgCompetitionArrByCompetition($objCompetition, $strExtra = '') {
        return OrgCompetition::GetArrByOrgAndCompetition($this, $objCompetition, $strExtra);
    }
    public function CreateOrgCompetitionFromCompetition($objCompetition) {
        $objOrgCompetition = new OrgCompetition();
        $objOrgCompetition->IdOrg = $this->IdOrg;
        $objOrgCompetition->IdCompetition = $objCompetition->IdCompetition;
        //$objOrgCompetition->Save();
        return $objOrgCompetition;
    }
    //Load by foregin key
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
        if (array_key_exists('idorg', $arrData)) {
            $this->intIdOrg = $arrData['idorg'];
        }
        if (array_key_exists('idorg', $arrData)) {
            $this->intIdOrg = $arrData['idorg'];
        }
        if (array_key_exists('idorg', $arrData)) {
            $this->intIdOrg = $arrData['idorg'];
        }
        if (array_key_exists('idorg', $arrData)) {
            $this->intIdOrg = $arrData['idorg'];
        }
    }
    public static function Parse($mixData, $blnReturnId = false) {
        if (is_numeric($mixData)) {
            if ($blnReturnId) {
                return $mixData;
            }
            return Org::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'Org')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdOrg;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Org"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Org.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Org.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $collReturn = array();
        $collReturn['_ClassName'] = "Org %>";
        $collReturn['idOrg'] = $this->idOrg;
        $collReturn['namespace'] = $this->namespace;
        $collReturn['name'] = $this->name;
        $collReturn['creDate'] = $this->creDate;
        $collReturn['psData'] = $this->psData;
        $collReturn['idImportAuthUser'] = $this->idImportAuthUser;
        $collReturn['clubNum'] = $this->clubNum;
        $collReturn['clubType'] = $this->clubType;
        return $collReturn;
    }
    public function __toString() {
        return 'Org(' . $this->getId() . ')';
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
            case ('IdOrg'):
            case ('idOrg'):
                if (array_key_exists('idOrg', $this->arrDBFields)) {
                    return $this->arrDBFields['idOrg'];
                }
                return null;
            break;
            case ('Namespace'):
            case ('namespace'):
                if (array_key_exists('namespace', $this->arrDBFields)) {
                    return $this->arrDBFields['namespace'];
                }
                return null;
            break;
            case ('Name'):
            case ('name'):
                if (array_key_exists('name', $this->arrDBFields)) {
                    return $this->arrDBFields['name'];
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
            case ('IdImportAuthUser'):
            case ('idImportAuthUser'):
                if (array_key_exists('idImportAuthUser', $this->arrDBFields)) {
                    return $this->arrDBFields['idImportAuthUser'];
                }
                return null;
            break;
            case ('ClubNum'):
            case ('clubNum'):
                if (array_key_exists('clubNum', $this->arrDBFields)) {
                    return $this->arrDBFields['clubNum'];
                }
                return null;
            break;
            case ('ClubType'):
            case ('clubType'):
                if (array_key_exists('clubType', $this->arrDBFields)) {
                    return $this->arrDBFields['clubType'];
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
            case ('IdOrg'):
            case ('idOrg'):
                $this->arrDBFields['idOrg'] = $mixValue;
            break;
            case ('Namespace'):
            case ('namespace'):
            case ('_Namespace'):
                $this->arrDBFields['namespace'] = $mixValue;
            break;
            case ('Name'):
            case ('name'):
            case ('_Name'):
                $this->arrDBFields['name'] = $mixValue;
            break;
            case ('CreDate'):
            case ('creDate'):
            case ('_CreDate'):
                $this->arrDBFields['creDate'] = $mixValue;
            break;
            case ('_PsData'):
                $this->arrDBFields['psData'] = $mixValue;
            break;
            case ('IdImportAuthUser'):
            case ('idImportAuthUser'):
                $this->arrDBFields['idImportAuthUser'] = $mixValue;
            break;
            case ('ClubNum'):
            case ('clubNum'):
            case ('_ClubNum'):
                $this->arrDBFields['clubNum'] = $mixValue;
            break;
            case ('ClubType'):
            case ('clubType'):
            case ('_ClubType'):
                $this->arrDBFields['clubType'] = $mixValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
    public function PsData($strKey, $mixData = null) {
        if (is_null($mixData)) {
            if ((!array_key_exists('psData', $this->arrDBFields))) {
                return null;
            }
            if ((strlen($this->arrDBFields['psData']) < 1)) {
                return null;
            }
            $arrData = json_decode($this->arrDBFields['psData'], true);
            if (!array_key_exists($strKey, $arrData)) {
                return null;
            }
            return $arrData[$strKey];
        } else {
            if ((!array_key_exists('psData', $this->arrDBFields)) || (strlen($this->arrDBFields['psData']) < 1)) {
                $arrData = array();
            } else {
                $arrData = json_decode($this->arrDBFields['psData'], true);
            }
            $arrData[$strKey] = $mixData;
            $this->arrDBFields['psData'] = json_encode($arrData);
            $this->Save();
        }
    }
}
?>