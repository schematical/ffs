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
* - GetEnrollmentArr()
* - GetOrgCompetitionArr()
* - GetParentMessageArr()
* - GetSessionArr()
* - LoadCollByIdOrg()
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
* - CompetitionBase extends BaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdCompetition
 * @property-write mixed $IdCompetition
 * @property-read mixed $Name
 * @property-write mixed $Name
 * @property-read mixed $LongDesc
 * @property-write mixed $LongDesc
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $StartDate
 * @property-write mixed $StartDate
 * @property-read mixed $EndDate
 * @property-write mixed $EndDate
 * @property-read mixed $IdOrg
 * @property-write mixed $IdOrg
 * @property-read mixed $Namespace
 * @property-write mixed $Namespace
 * @property-read mixed $SignupCutOffDate
 * @property-write mixed $SignupCutOffDate
 * @property-read Competition $IdOrgObject
 */
class CompetitionBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Competition';
    const P_KEY = 'idCompetition';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idCompetition = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Competition();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, Competition::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Competition();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<Competition>";
        $xmlStr.= "<idCompetition>";
        $xmlStr.= $this->idCompetition;
        $xmlStr.= "</idCompetition>";
        $xmlStr.= "<name>";
        $xmlStr.= $this->name;
        $xmlStr.= "</name>";
        $xmlStr.= "<longDesc>";
        $xmlStr.= $this->longDesc;
        $xmlStr.= "</longDesc>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<startDate>";
        $xmlStr.= $this->startDate;
        $xmlStr.= "</startDate>";
        $xmlStr.= "<endDate>";
        $xmlStr.= $this->endDate;
        $xmlStr.= "</endDate>";
        $xmlStr.= "<idOrg>";
        $xmlStr.= $this->idOrg;
        $xmlStr.= "</idOrg>";
        $xmlStr.= "<namespace>";
        $xmlStr.= $this->namespace;
        $xmlStr.= "</namespace>";
        $xmlStr.= "<signupCutOffDate>";
        $xmlStr.= $this->signupCutOffDate;
        $xmlStr.= "</signupCutOffDate>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</Competition>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Competition();
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
    public function GetEnrollmentArr() {
        return Enrollment::LoadCollByIdCompetition($this->idCompetition);
    }
    public function GetOrgCompetitionArr() {
        return OrgCompetition::LoadCollByIdCompetition($this->idCompetition);
    }
    public function GetParentMessageArr() {
        return ParentMessage::LoadCollByIdCompetition($this->idCompetition);
    }
    public function GetSessionArr() {
        return Session::LoadCollByIdCompetition($this->idCompetition);
    }
    //Load by foregin key
    public static function LoadCollByIdOrg($intIdOrg) {
        $sql = sprintf("SELECT * FROM Competition WHERE idOrg = %s;", $intIdOrg);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objCompetition = new Competition();
            $objCompetition->materilize($data);
            $coll->addItem($objCompetition);
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
        if (array_key_exists('idcompetition', $arrData)) {
            $this->intIdCompetition = $arrData['idcompetition'];
        }
        if (array_key_exists('idcompetition', $arrData)) {
            $this->intIdCompetition = $arrData['idcompetition'];
        }
        if (array_key_exists('idcompetition', $arrData)) {
            $this->intIdCompetition = $arrData['idcompetition'];
        }
        if (array_key_exists('idcompetition', $arrData)) {
            $this->intIdCompetition = $arrData['idcompetition'];
        }
    }
    public static function Parse($mixData, $blnReturnId = false) {
        if (is_numeric($mixData)) {
            if ($blnReturnId) {
                return $mixData;
            }
            return Competition::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'Competition')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdCompetition;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Competition"');
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
            $tObj = new Competition();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "Competition %>";
        $arrReturn['idCompetition'] = $this->idCompetition;
        $arrReturn['name'] = $this->name;
        $arrReturn['longDesc'] = $this->longDesc;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['startDate'] = $this->startDate;
        $arrReturn['endDate'] = $this->endDate;
        $arrReturn['idOrg'] = $this->idOrg;
        $arrReturn['namespace'] = $this->namespace;
        $arrReturn['signupCutOffDate'] = $this->signupCutOffDate;
        return $arrReturn;
    }
    public function __toString() {
        return 'Competition(' . $this->getId() . ')';
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
            case ('IdCompetition'):
            case ('idCompetition'):
                if (array_key_exists('idCompetition', $this->arrDBFields)) {
                    return $this->arrDBFields['idCompetition'];
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
            case ('LongDesc'):
            case ('longDesc'):
                if (array_key_exists('longDesc', $this->arrDBFields)) {
                    return $this->arrDBFields['longDesc'];
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
            case ('StartDate'):
            case ('startDate'):
                if (array_key_exists('startDate', $this->arrDBFields)) {
                    return $this->arrDBFields['startDate'];
                }
                return null;
            break;
            case ('EndDate'):
            case ('endDate'):
                if (array_key_exists('endDate', $this->arrDBFields)) {
                    return $this->arrDBFields['endDate'];
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
            case ('Namespace'):
            case ('namespace'):
                if (array_key_exists('namespace', $this->arrDBFields)) {
                    return $this->arrDBFields['namespace'];
                }
                return null;
            break;
            case ('SignupCutOffDate'):
            case ('signupCutOffDate'):
                if (array_key_exists('signupCutOffDate', $this->arrDBFields)) {
                    return $this->arrDBFields['signupCutOffDate'];
                }
                return null;
            break;
            case ('IdOrgObject'):
            case ('idOrgObject'):
                if ((array_key_exists('idOrg', $this->arrDBFields)) && (!is_null($this->arrDBFields['idOrg']))) {
                    return Org::LoadById($this->arrDBFields['idOrg']);
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
            case ('IdCompetition'):
            case ('idCompetition'):
                $this->arrDBFields['idCompetition'] = $strValue;
            break;
            case ('Name'):
            case ('name'):
                $this->arrDBFields['name'] = $strValue;
            break;
            case ('LongDesc'):
            case ('longDesc'):
                $this->arrDBFields['longDesc'] = $strValue;
            break;
            case ('CreDate'):
            case ('creDate'):
                $this->arrDBFields['creDate'] = $strValue;
            break;
            case ('StartDate'):
            case ('startDate'):
                $this->arrDBFields['startDate'] = $strValue;
            break;
            case ('EndDate'):
            case ('endDate'):
                $this->arrDBFields['endDate'] = $strValue;
            break;
            case ('IdOrg'):
            case ('idOrg'):
                $this->arrDBFields['idOrg'] = $strValue;
            break;
            case ('Namespace'):
            case ('namespace'):
                $this->arrDBFields['namespace'] = $strValue;
            break;
            case ('SignupCutOffDate'):
            case ('signupCutOffDate'):
                $this->arrDBFields['signupCutOffDate'] = $strValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>