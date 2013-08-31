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
* - GetParentMessageArr()
* - GetResultArr()
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
* - AtheleteBase extends BaseEntity
*/
class AtheleteBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Athelete';
    const P_KEY = 'idAthelete';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idAthelete = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Athelete();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, Athelete::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Athelete();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<Athelete>";
        $xmlStr.= "<idAthelete>";
        $xmlStr.= $this->idAthelete;
        $xmlStr.= "</idAthelete>";
        $xmlStr.= "<idOrg>";
        $xmlStr.= $this->idOrg;
        $xmlStr.= "</idOrg>";
        $xmlStr.= "<firstName>";
        $xmlStr.= $this->firstName;
        $xmlStr.= "</firstName>";
        $xmlStr.= "<lastName>";
        $xmlStr.= $this->lastName;
        $xmlStr.= "</lastName>";
        $xmlStr.= "<birthDate>";
        $xmlStr.= $this->birthDate;
        $xmlStr.= "</birthDate>";
        $xmlStr.= "<memType>";
        $xmlStr.= $this->memType;
        $xmlStr.= "</memType>";
        $xmlStr.= "<memId>";
        $xmlStr.= $this->memId;
        $xmlStr.= "</memId>";
        $xmlStr.= "<PsData>";
        $xmlStr.= $this->PsData;
        $xmlStr.= "</PsData>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<level>";
        $xmlStr.= $this->level;
        $xmlStr.= "</level>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</Athelete>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Athelete();
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
        return Enrollment::LoadCollByIdAthelete($this->idAthelete);
    }
    public function GetParentMessageArr() {
        return ParentMessage::LoadCollByIdAthelete($this->idAthelete);
    }
    public function GetResultArr() {
        return Result::LoadCollByIdAthelete($this->idAthelete);
    }
    //Load by foregin key
    public static function LoadCollByIdOrg($intIdOrg) {
        $sql = sprintf("SELECT * FROM Athelete WHERE idOrg = %s;", $intIdOrg);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objAthelete = new Athelete();
            $objAthelete->materilize($data);
            $coll->addItem($objAthelete);
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
        if (array_key_exists('idathelete', $arrData)) {
            $this->intIdAthelete = $arrData['idathelete'];
        }
        if (array_key_exists('idathelete', $arrData)) {
            $this->intIdAthelete = $arrData['idathelete'];
        }
        if (array_key_exists('idathelete', $arrData)) {
            $this->intIdAthelete = $arrData['idathelete'];
        }
    }
    public static function Parse($mixData, $blnReturnId = false) {
        if (is_numeric($mixData)) {
            if ($blnReturnId) {
                return $mixData;
            }
            return Athelete::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'Athelete')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdAthelete;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Athelete"');
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
            $tObj = new Athelete();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "Athelete %>";
        $arrReturn['idAthelete'] = $this->idAthelete;
        $arrReturn['idOrg'] = $this->idOrg;
        $arrReturn['firstName'] = $this->firstName;
        $arrReturn['lastName'] = $this->lastName;
        $arrReturn['birthDate'] = $this->birthDate;
        $arrReturn['memType'] = $this->memType;
        $arrReturn['memId'] = $this->memId;
        $arrReturn['PsData'] = $this->PsData;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['level'] = $this->level;
        return $arrReturn;
    }
    public function __toString() {
        return 'Athelete(' . $this->getId() . ')';
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
            case ('IdAthelete'):
            case ('idAthelete'):
                if (array_key_exists('idAthelete', $this->arrDBFields)) {
                    return $this->arrDBFields['idAthelete'];
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
            case ('FirstName'):
            case ('firstName'):
                if (array_key_exists('firstName', $this->arrDBFields)) {
                    return $this->arrDBFields['firstName'];
                }
                return null;
            break;
            case ('LastName'):
            case ('lastName'):
                if (array_key_exists('lastName', $this->arrDBFields)) {
                    return $this->arrDBFields['lastName'];
                }
                return null;
            break;
            case ('BirthDate'):
            case ('birthDate'):
                if (array_key_exists('birthDate', $this->arrDBFields)) {
                    return $this->arrDBFields['birthDate'];
                }
                return null;
            break;
            case ('MemType'):
            case ('memType'):
                if (array_key_exists('memType', $this->arrDBFields)) {
                    return $this->arrDBFields['memType'];
                }
                return null;
            break;
            case ('MemId'):
            case ('memId'):
                if (array_key_exists('memId', $this->arrDBFields)) {
                    return $this->arrDBFields['memId'];
                }
                return null;
            break;
            case ('PsData'):
            case ('PsData'):
                if (array_key_exists('PsData', $this->arrDBFields)) {
                    return $this->arrDBFields['PsData'];
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
            case ('Level'):
            case ('level'):
                if (array_key_exists('level', $this->arrDBFields)) {
                    return $this->arrDBFields['level'];
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
            case ('IdAthelete'):
            case ('idAthelete'):
                $this->arrDBFields['idAthelete'] = $strValue;
            break;
            case ('IdOrg'):
            case ('idOrg'):
                $this->arrDBFields['idOrg'] = $strValue;
            break;
            case ('FirstName'):
            case ('firstName'):
                $this->arrDBFields['firstName'] = $strValue;
            break;
            case ('LastName'):
            case ('lastName'):
                $this->arrDBFields['lastName'] = $strValue;
            break;
            case ('BirthDate'):
            case ('birthDate'):
                $this->arrDBFields['birthDate'] = $strValue;
            break;
            case ('MemType'):
            case ('memType'):
                $this->arrDBFields['memType'] = $strValue;
            break;
            case ('MemId'):
            case ('memId'):
                $this->arrDBFields['memId'] = $strValue;
            break;
            case ('PsData'):
            case ('PsData'):
                $this->arrDBFields['PsData'] = $strValue;
            break;
            case ('CreDate'):
            case ('creDate'):
                $this->arrDBFields['creDate'] = $strValue;
            break;
            case ('Level'):
            case ('level'):
                $this->arrDBFields['level'] = $strValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>