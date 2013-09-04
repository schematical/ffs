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
* - GetEnrollmentArr()
* - GetEnrollmentArrByCompetition()
* - CreateEnrollmentFromCompetition()
* - GetEnrollmentArrBySession()
* - CreateEnrollmentFromSession()
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
* - PsData()
* Classes list:
* - AtheleteBase extends BaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdAthelete
 * @property-write mixed $IdAthelete
 * @property-read mixed $IdOrg
 * @property-write mixed $IdOrg
 * @property-read mixed $FirstName
 * @property-write mixed $FirstName
 * @property-read mixed $LastName
 * @property-write mixed $LastName
 * @property-read mixed $BirthDate
 * @property-write mixed $BirthDate
 * @property-read mixed $MemType
 * @property-write mixed $MemType
 * @property-read mixed $MemId
 * @property-write mixed $MemId
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $Level
 * @property-write mixed $Level
 * @property-read Athelete $IdOrgObject
 */
class AtheleteBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Athelete';
    const P_KEY = 'idAthelete';
    protected $objIdOrg = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE Athelete.idAthelete = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = new BaseEntityCollection(self::Query(''));
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
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if (array_key_exists('Athelete.idAthelete', $arrData)) {
                //New Smart Way
                $this->arrDBFields['idAthelete'] = $arrData['Athelete.idAthelete'];
                $this->arrDBFields['idOrg'] = $arrData['Athelete.idOrg'];
                $this->arrDBFields['firstName'] = $arrData['Athelete.firstName'];
                $this->arrDBFields['lastName'] = $arrData['Athelete.lastName'];
                $this->arrDBFields['birthDate'] = $arrData['Athelete.birthDate'];
                $this->arrDBFields['memType'] = $arrData['Athelete.memType'];
                $this->arrDBFields['memId'] = $arrData['Athelete.memId'];
                $this->arrDBFields['PsData'] = $arrData['Athelete.PsData'];
                $this->arrDBFields['creDate'] = $arrData['Athelete.creDate'];
                $this->arrDBFields['level'] = $arrData['Athelete.level'];
                //Foregin Key
                if (array_key_exists('Org.idOrg', $arrData)) {
                    $this->objIdOrg = new Org();
                    $this->objIdOrg->Materilize($arrData);
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
        $arrFields[] = 'Athelete.idAthelete ' . (($blnLongSelect) ? ' as "Athelete.idAthelete"' : '');
        $arrFields[] = 'Athelete.idOrg ' . (($blnLongSelect) ? ' as "Athelete.idOrg"' : '');
        $arrFields[] = 'Athelete.firstName ' . (($blnLongSelect) ? ' as "Athelete.firstName"' : '');
        $arrFields[] = 'Athelete.lastName ' . (($blnLongSelect) ? ' as "Athelete.lastName"' : '');
        $arrFields[] = 'Athelete.birthDate ' . (($blnLongSelect) ? ' as "Athelete.birthDate"' : '');
        $arrFields[] = 'Athelete.memType ' . (($blnLongSelect) ? ' as "Athelete.memType"' : '');
        $arrFields[] = 'Athelete.memId ' . (($blnLongSelect) ? ' as "Athelete.memId"' : '');
        $arrFields[] = 'Athelete.PsData ' . (($blnLongSelect) ? ' as "Athelete.PsData"' : '');
        $arrFields[] = 'Athelete.creDate ' . (($blnLongSelect) ? ' as "Athelete.creDate"' : '');
        $arrFields[] = 'Athelete.level ' . (($blnLongSelect) ? ' as "Athelete.level"' : '');
        return $arrFields;
    }
    public static function Query($strExtra, $blnReturnSingle = false, $arrJoins = null) {
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
                        $strJoin.= ' JOIN Org ON Athelete.idOrg = Org.idOrg';
                    break;
                }
            }
        }
        $sql = sprintf("SELECT %s FROM Athelete %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Athelete();
            $tObj->Materilize($data);
            $arrReturn[] = $tObj;
        }
        //$arrReturn = $coll->getCollection();
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
        $sql = sprintf("SELECT Athelete.* FROM Athelete %s;", $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    public function GetEnrollmentArr($strExtra = '') {
        return Enrollment::Query('WHERE Enrollment_rel.idAthelete = ' . $this->idAthelete . ' ' . $strExtra);
    }
    public function GetEnrollmentArrByCompetition($objCompetition, $strExtra = '') {
        return Enrollment::GetArrByAtheleteAndCompetition($this, $objCompetition, $strExtra);
    }
    public function CreateEnrollmentFromCompetition($objCompetition) {
        $objEnrollment = new Enrollment();
        $objEnrollment->IdAthelete = $this->IdAthelete;
        $objEnrollment->IdCompetition = $objCompetition->IdCompetition;
        //$objEnrollment->Save();
        return $objEnrollment;
    }
    public function GetEnrollmentArrBySession($objSession, $strExtra = '') {
        return Enrollment::GetArrByAtheleteAndSession($this, $objSession, $strExtra);
    }
    public function CreateEnrollmentFromSession($objSession) {
        $objEnrollment = new Enrollment();
        $objEnrollment->IdAthelete = $this->IdAthelete;
        $objEnrollment->IdSession = $objSession->IdSession;
        //$objEnrollment->Save();
        return $objEnrollment;
    }
    public function GetParentMessageArr() {
        return ParentMessage::LoadCollByIdAthelete($this->idAthelete)->getCollection();
    }
    public function GetResultArr() {
        return Result::LoadCollByIdAthelete($this->idAthelete)->getCollection();
    }
    //Load by foregin key
    public static function LoadCollByIdOrg($intIdOrg) {
        $sql = sprintf("SELECT Athelete.* FROM Athelete WHERE idOrg = %s;", $intIdOrg);
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
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Athelete.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Athelete.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
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
                if (!is_null($this->objIdOrg)) {
                    return $this->objIdOrg;
                }
                if ((array_key_exists('idOrg', $this->arrDBFields)) && (!is_null($this->arrDBFields['idOrg']))) {
                    $this->objIdOrg = Org::LoadById($this->arrDBFields['idOrg']);
                    return $this->objIdOrg;
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
                $this->objIdOrg = null;
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
            case ('CreDate'):
            case ('creDate'):
                $this->arrDBFields['creDate'] = $strValue;
            break;
            case ('Level'):
            case ('level'):
                $this->arrDBFields['level'] = $strValue;
            break;
            case ('IdOrgObject'):
                $this->arrDBFields['idOrg'] = $strValue->idOrg;
                $this->objIdOrg = $strValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
    public function PsData($strKey, $mixData = null) {
        if (is_null($mixData)) {
            if ((!array_key_exists('PsData', $this->arrDBFields))) {
                return null;
            }
            if ((strlen($this->arrDBFields['PsData']) < 1)) {
                return null;
            }
            $arrData = json_decode($this->arrDBFields['PsData'], true);
            if (!array_key_exists($strKey, $arrData)) {
                return null;
            }
            return $arrData[$strKey];
        } else {
            if ((!array_key_exists('PsData', $this->arrDBFields)) || (strlen($this->arrDBFields['PsData']) < 1)) {
                $arrData = array();
            } else {
                $arrData = json_decode($this->arrDBFields['PsData'], true);
            }
            $arrData[$strKey] = $mixData;
            $this->arrDBFields['PsData'] = json_encode($arrData);
            $this->Save();
        }
    }
}
?>