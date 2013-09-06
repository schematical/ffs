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
* - LoadCollByIdAthelete()
* - LoadCollByIdCompetition()
* - LoadCollByIdSession()
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
* - EnrollmentBase extends BaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdEnrollment
 * @property-write mixed $IdEnrollment
 * @property-read mixed $IdAthelete
 * @property-write mixed $IdAthelete
 * @property-read mixed $IdCompetition
 * @property-write mixed $IdCompetition
 * @property-read mixed $IdSession
 * @property-write mixed $IdSession
 * @property-read mixed $Flight
 * @property-write mixed $Flight
 * @property-read mixed $Division
 * @property-write mixed $Division
 * @property-read mixed $AgeGroup
 * @property-write mixed $AgeGroup
 * @property-read mixed $Misc1
 * @property-write mixed $Misc1
 * @property-read mixed $Misc2
 * @property-write mixed $Misc2
 * @property-read mixed $Misc3
 * @property-write mixed $Misc3
 * @property-read mixed $Misc4
 * @property-write mixed $Misc4
 * @property-read mixed $Misc5
 * @property-write mixed $Misc5
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $Level
 * @property-write mixed $Level
 * @property-read Enrollment $IdAtheleteObject
 * @property-read Enrollment $IdCompetitionObject
 * @property-read Enrollment $IdSessionObject
 */
class EnrollmentBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Enrollment_rel';
    const P_KEY = 'idEnrollment';
    protected $objIdAthelete = null;
    protected $objIdCompetition = null;
    protected $objIdSession = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE Enrollment_rel.idEnrollment = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = new BaseEntityCollection(self::Query(''));
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<Enrollment>";
        $xmlStr.= "<idEnrollment>";
        $xmlStr.= $this->idEnrollment;
        $xmlStr.= "</idEnrollment>";
        $xmlStr.= "<idAthelete>";
        $xmlStr.= $this->idAthelete;
        $xmlStr.= "</idAthelete>";
        $xmlStr.= "<idCompetition>";
        $xmlStr.= $this->idCompetition;
        $xmlStr.= "</idCompetition>";
        $xmlStr.= "<idSession>";
        $xmlStr.= $this->idSession;
        $xmlStr.= "</idSession>";
        $xmlStr.= "<flight>";
        $xmlStr.= $this->flight;
        $xmlStr.= "</flight>";
        $xmlStr.= "<division>";
        $xmlStr.= $this->division;
        $xmlStr.= "</division>";
        $xmlStr.= "<ageGroup>";
        $xmlStr.= $this->ageGroup;
        $xmlStr.= "</ageGroup>";
        $xmlStr.= "<misc1>";
        $xmlStr.= $this->misc1;
        $xmlStr.= "</misc1>";
        $xmlStr.= "<misc2>";
        $xmlStr.= $this->misc2;
        $xmlStr.= "</misc2>";
        $xmlStr.= "<misc3>";
        $xmlStr.= $this->misc3;
        $xmlStr.= "</misc3>";
        $xmlStr.= "<misc4>";
        $xmlStr.= $this->misc4;
        $xmlStr.= "</misc4>";
        $xmlStr.= "<misc5>";
        $xmlStr.= $this->misc5;
        $xmlStr.= "</misc5>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<level>";
        $xmlStr.= $this->level;
        $xmlStr.= "</level>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</Enrollment>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('Enrollment_rel.idEnrollment', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idEnrollment'] = $arrData['Enrollment_rel.idEnrollment'];
                $this->arrDBFields['idAthelete'] = $arrData['Enrollment_rel.idAthelete'];
                $this->arrDBFields['idCompetition'] = $arrData['Enrollment_rel.idCompetition'];
                $this->arrDBFields['idSession'] = $arrData['Enrollment_rel.idSession'];
                $this->arrDBFields['flight'] = $arrData['Enrollment_rel.flight'];
                $this->arrDBFields['division'] = $arrData['Enrollment_rel.division'];
                $this->arrDBFields['ageGroup'] = $arrData['Enrollment_rel.ageGroup'];
                $this->arrDBFields['misc1'] = $arrData['Enrollment_rel.misc1'];
                $this->arrDBFields['misc2'] = $arrData['Enrollment_rel.misc2'];
                $this->arrDBFields['misc3'] = $arrData['Enrollment_rel.misc3'];
                $this->arrDBFields['misc4'] = $arrData['Enrollment_rel.misc4'];
                $this->arrDBFields['misc5'] = $arrData['Enrollment_rel.misc5'];
                $this->arrDBFields['creDate'] = $arrData['Enrollment_rel.creDate'];
                $this->arrDBFields['level'] = $arrData['Enrollment_rel.level'];
                //Foregin Key
                if ((array_key_exists('Athelete.idAthelete', $arrData)) && (!is_null($arrData['Athelete.idAthelete']))) {
                    $this->objIdAthelete = new Athelete();
                    $this->objIdAthelete->Materilize($arrData);
                }
                if ((array_key_exists('Competition.idCompetition', $arrData)) && (!is_null($arrData['Competition.idCompetition']))) {
                    $this->objIdCompetition = new Competition();
                    $this->objIdCompetition->Materilize($arrData);
                }
                if ((array_key_exists('Session.idSession', $arrData)) && (!is_null($arrData['Session.idSession']))) {
                    $this->objIdSession = new Session();
                    $this->objIdSession->Materilize($arrData);
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
        $arrFields[] = 'Enrollment_rel.idEnrollment ' . (($blnLongSelect) ? ' as "Enrollment_rel.idEnrollment"' : '');
        $arrFields[] = 'Enrollment_rel.idAthelete ' . (($blnLongSelect) ? ' as "Enrollment_rel.idAthelete"' : '');
        $arrFields[] = 'Enrollment_rel.idCompetition ' . (($blnLongSelect) ? ' as "Enrollment_rel.idCompetition"' : '');
        $arrFields[] = 'Enrollment_rel.idSession ' . (($blnLongSelect) ? ' as "Enrollment_rel.idSession"' : '');
        $arrFields[] = 'Enrollment_rel.flight ' . (($blnLongSelect) ? ' as "Enrollment_rel.flight"' : '');
        $arrFields[] = 'Enrollment_rel.division ' . (($blnLongSelect) ? ' as "Enrollment_rel.division"' : '');
        $arrFields[] = 'Enrollment_rel.ageGroup ' . (($blnLongSelect) ? ' as "Enrollment_rel.ageGroup"' : '');
        $arrFields[] = 'Enrollment_rel.misc1 ' . (($blnLongSelect) ? ' as "Enrollment_rel.misc1"' : '');
        $arrFields[] = 'Enrollment_rel.misc2 ' . (($blnLongSelect) ? ' as "Enrollment_rel.misc2"' : '');
        $arrFields[] = 'Enrollment_rel.misc3 ' . (($blnLongSelect) ? ' as "Enrollment_rel.misc3"' : '');
        $arrFields[] = 'Enrollment_rel.misc4 ' . (($blnLongSelect) ? ' as "Enrollment_rel.misc4"' : '');
        $arrFields[] = 'Enrollment_rel.misc5 ' . (($blnLongSelect) ? ' as "Enrollment_rel.misc5"' : '');
        $arrFields[] = 'Enrollment_rel.creDate ' . (($blnLongSelect) ? ' as "Enrollment_rel.creDate"' : '');
        $arrFields[] = 'Enrollment_rel.level ' . (($blnLongSelect) ? ' as "Enrollment_rel.level"' : '');
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
                    case ('Athelete'):
                        $strJoin.= ' LEFT JOIN Athelete ON Enrollment_rel.idAthelete = Athelete.idAthelete';
                    break;
                    case ('Competition'):
                        $strJoin.= ' LEFT JOIN Competition ON Enrollment_rel.idCompetition = Competition.idCompetition';
                    break;
                    case ('Session'):
                        $strJoin.= ' LEFT JOIN Session ON Enrollment_rel.idSession = Session.idSession';
                    break;
                }
            }
        }
        $sql = sprintf("SELECT %s FROM Enrollment_rel %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Enrollment();
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
        $sql = sprintf("SELECT Enrollment_rel.* FROM Enrollment_rel %s;", $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdAthelete($intIdAthelete) {
        $sql = sprintf("SELECT Enrollment_rel.* FROM Enrollment_rel WHERE idAthelete = %s;", $intIdAthelete);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objEnrollment = new Enrollment();
            $objEnrollment->materilize($data);
            $coll->addItem($objEnrollment);
        }
        return $coll;
    }
    public static function LoadCollByIdCompetition($intIdCompetition) {
        $sql = sprintf("SELECT Enrollment_rel.* FROM Enrollment_rel WHERE idCompetition = %s;", $intIdCompetition);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objEnrollment = new Enrollment();
            $objEnrollment->materilize($data);
            $coll->addItem($objEnrollment);
        }
        return $coll;
    }
    public static function LoadCollByIdSession($intIdSession) {
        $sql = sprintf("SELECT Enrollment_rel.* FROM Enrollment_rel WHERE idSession = %s;", $intIdSession);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objEnrollment = new Enrollment();
            $objEnrollment->materilize($data);
            $coll->addItem($objEnrollment);
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
            return Enrollment::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'Enrollment')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdEnrollment;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Enrollment"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Enrollment_rel.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Enrollment_rel.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "Enrollment %>";
        $arrReturn['idEnrollment'] = $this->idEnrollment;
        $arrReturn['idAthelete'] = $this->idAthelete;
        $arrReturn['idCompetition'] = $this->idCompetition;
        $arrReturn['idSession'] = $this->idSession;
        $arrReturn['flight'] = $this->flight;
        $arrReturn['division'] = $this->division;
        $arrReturn['ageGroup'] = $this->ageGroup;
        $arrReturn['misc1'] = $this->misc1;
        $arrReturn['misc2'] = $this->misc2;
        $arrReturn['misc3'] = $this->misc3;
        $arrReturn['misc4'] = $this->misc4;
        $arrReturn['misc5'] = $this->misc5;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['level'] = $this->level;
        return $arrReturn;
    }
    public function __toString() {
        return 'Enrollment(' . $this->getId() . ')';
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
            case ('IdEnrollment'):
            case ('idEnrollment'):
                if (array_key_exists('idEnrollment', $this->arrDBFields)) {
                    return $this->arrDBFields['idEnrollment'];
                }
                return null;
            break;
            case ('IdAthelete'):
            case ('idAthelete'):
                if (array_key_exists('idAthelete', $this->arrDBFields)) {
                    return $this->arrDBFields['idAthelete'];
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
            case ('IdSession'):
            case ('idSession'):
                if (array_key_exists('idSession', $this->arrDBFields)) {
                    return $this->arrDBFields['idSession'];
                }
                return null;
            break;
            case ('Flight'):
            case ('flight'):
                if (array_key_exists('flight', $this->arrDBFields)) {
                    return $this->arrDBFields['flight'];
                }
                return null;
            break;
            case ('Division'):
            case ('division'):
                if (array_key_exists('division', $this->arrDBFields)) {
                    return $this->arrDBFields['division'];
                }
                return null;
            break;
            case ('AgeGroup'):
            case ('ageGroup'):
                if (array_key_exists('ageGroup', $this->arrDBFields)) {
                    return $this->arrDBFields['ageGroup'];
                }
                return null;
            break;
            case ('Misc1'):
            case ('misc1'):
                if (array_key_exists('misc1', $this->arrDBFields)) {
                    return $this->arrDBFields['misc1'];
                }
                return null;
            break;
            case ('Misc2'):
            case ('misc2'):
                if (array_key_exists('misc2', $this->arrDBFields)) {
                    return $this->arrDBFields['misc2'];
                }
                return null;
            break;
            case ('Misc3'):
            case ('misc3'):
                if (array_key_exists('misc3', $this->arrDBFields)) {
                    return $this->arrDBFields['misc3'];
                }
                return null;
            break;
            case ('Misc4'):
            case ('misc4'):
                if (array_key_exists('misc4', $this->arrDBFields)) {
                    return $this->arrDBFields['misc4'];
                }
                return null;
            break;
            case ('Misc5'):
            case ('misc5'):
                if (array_key_exists('misc5', $this->arrDBFields)) {
                    return $this->arrDBFields['misc5'];
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
            case ('IdAtheleteObject'):
                if (!is_null($this->objIdAthelete)) {
                    return $this->objIdAthelete;
                }
                if ((array_key_exists('idAthelete', $this->arrDBFields)) && (!is_null($this->arrDBFields['idAthelete']))) {
                    $this->objIdAthelete = Athelete::LoadById($this->arrDBFields['idAthelete']);
                    return $this->objIdAthelete;
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
            case ('IdSessionObject'):
                if (!is_null($this->objIdSession)) {
                    return $this->objIdSession;
                }
                if ((array_key_exists('idSession', $this->arrDBFields)) && (!is_null($this->arrDBFields['idSession']))) {
                    $this->objIdSession = Session::LoadById($this->arrDBFields['idSession']);
                    return $this->objIdSession;
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
            case ('IdEnrollment'):
            case ('idEnrollment'):
                $this->arrDBFields['idEnrollment'] = $mixValue;
            break;
            case ('IdAthelete'):
            case ('idAthelete'):
                $this->arrDBFields['idAthelete'] = $mixValue;
                $this->objIdAthelete = null;
            break;
            case ('IdCompetition'):
            case ('idCompetition'):
                $this->arrDBFields['idCompetition'] = $mixValue;
                $this->objIdCompetition = null;
            break;
            case ('IdSession'):
            case ('idSession'):
                $this->arrDBFields['idSession'] = $mixValue;
                $this->objIdSession = null;
            break;
            case ('Flight'):
            case ('flight'):
                $this->arrDBFields['flight'] = $mixValue;
            break;
            case ('Division'):
            case ('division'):
                $this->arrDBFields['division'] = $mixValue;
            break;
            case ('AgeGroup'):
            case ('ageGroup'):
                $this->arrDBFields['ageGroup'] = $mixValue;
            break;
            case ('Misc1'):
            case ('misc1'):
                $this->arrDBFields['misc1'] = $mixValue;
            break;
            case ('Misc2'):
            case ('misc2'):
                $this->arrDBFields['misc2'] = $mixValue;
            break;
            case ('Misc3'):
            case ('misc3'):
                $this->arrDBFields['misc3'] = $mixValue;
            break;
            case ('Misc4'):
            case ('misc4'):
                $this->arrDBFields['misc4'] = $mixValue;
            break;
            case ('Misc5'):
            case ('misc5'):
                $this->arrDBFields['misc5'] = $mixValue;
            break;
            case ('CreDate'):
            case ('creDate'):
                $this->arrDBFields['creDate'] = $mixValue;
            break;
            case ('Level'):
            case ('level'):
                $this->arrDBFields['level'] = $mixValue;
            break;
            case ('IdAtheleteObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof Athelete)))) {
                    throw new MLCWrongTypeException('__set', $strName);
                }
                if (!is_null($mixValue)) {
                    $this->arrDBFields['idAthelete'] = $mixValue->idAthelete;
                } else {
                    $this->arrDBFields['idAthelete'] = null;
                }
                $this->objIdAthelete = $mixValue;
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
            case ('IdSessionObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof Session)))) {
                    throw new MLCWrongTypeException('__set', $strName);
                }
                if (!is_null($mixValue)) {
                    $this->arrDBFields['idSession'] = $mixValue->idSession;
                } else {
                    $this->arrDBFields['idSession'] = null;
                }
                $this->objIdSession = $mixValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>