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
* - LoadCollByIdSession()
* - LoadCollByIdAthelete()
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
* - ResultBase extends BaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdResult
 * @property-write mixed $IdResult
 * @property-read mixed $IdSession
 * @property-write mixed $IdSession
 * @property-read mixed $IdAthelete
 * @property-write mixed $IdAthelete
 * @property-read mixed $Score
 * @property-write mixed $Score
 * @property-read mixed $Judge
 * @property-write mixed $Judge
 * @property-read mixed $Flag
 * @property-write mixed $Flag
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $Event
 * @property-write mixed $Event
 * @property-read mixed $DispDate
 * @property-write mixed $DispDate
 * @property-read Result $IdSessionObject
 * @property-read Result $IdAtheleteObject
 */
class ResultBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Result';
    const P_KEY = 'idResult';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idResult = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Result();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, Result::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Result();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<Result>";
        $xmlStr.= "<idResult>";
        $xmlStr.= $this->idResult;
        $xmlStr.= "</idResult>";
        $xmlStr.= "<idSession>";
        $xmlStr.= $this->idSession;
        $xmlStr.= "</idSession>";
        $xmlStr.= "<idAthelete>";
        $xmlStr.= $this->idAthelete;
        $xmlStr.= "</idAthelete>";
        $xmlStr.= "<score>";
        $xmlStr.= $this->score;
        $xmlStr.= "</score>";
        $xmlStr.= "<judge>";
        $xmlStr.= $this->judge;
        $xmlStr.= "</judge>";
        $xmlStr.= "<flag>";
        $xmlStr.= $this->flag;
        $xmlStr.= "</flag>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<event>";
        $xmlStr.= $this->event;
        $xmlStr.= "</event>";
        $xmlStr.= "<dispDate>";
        $xmlStr.= $this->dispDate;
        $xmlStr.= "</dispDate>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</Result>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Result();
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
    public static function LoadCollByIdSession($intIdSession) {
        $sql = sprintf("SELECT * FROM Result WHERE idSession = %s;", $intIdSession);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objResult = new Result();
            $objResult->materilize($data);
            $coll->addItem($objResult);
        }
        return $coll;
    }
    public static function LoadCollByIdAthelete($intIdAthelete) {
        $sql = sprintf("SELECT * FROM Result WHERE idAthelete = %s;", $intIdAthelete);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objResult = new Result();
            $objResult->materilize($data);
            $coll->addItem($objResult);
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
            return Result::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'Result')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdResult;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Result"');
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
            $tObj = new Result();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "Result %>";
        $arrReturn['idResult'] = $this->idResult;
        $arrReturn['idSession'] = $this->idSession;
        $arrReturn['idAthelete'] = $this->idAthelete;
        $arrReturn['score'] = $this->score;
        $arrReturn['judge'] = $this->judge;
        $arrReturn['flag'] = $this->flag;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['event'] = $this->event;
        $arrReturn['dispDate'] = $this->dispDate;
        return $arrReturn;
    }
    public function __toString() {
        return 'Result(' . $this->getId() . ')';
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
            case ('IdResult'):
            case ('idResult'):
                if (array_key_exists('idResult', $this->arrDBFields)) {
                    return $this->arrDBFields['idResult'];
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
            case ('IdAthelete'):
            case ('idAthelete'):
                if (array_key_exists('idAthelete', $this->arrDBFields)) {
                    return $this->arrDBFields['idAthelete'];
                }
                return null;
            break;
            case ('Score'):
            case ('score'):
                if (array_key_exists('score', $this->arrDBFields)) {
                    return $this->arrDBFields['score'];
                }
                return null;
            break;
            case ('Judge'):
            case ('judge'):
                if (array_key_exists('judge', $this->arrDBFields)) {
                    return $this->arrDBFields['judge'];
                }
                return null;
            break;
            case ('Flag'):
            case ('flag'):
                if (array_key_exists('flag', $this->arrDBFields)) {
                    return $this->arrDBFields['flag'];
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
            case ('Event'):
            case ('event'):
                if (array_key_exists('event', $this->arrDBFields)) {
                    return $this->arrDBFields['event'];
                }
                return null;
            break;
            case ('DispDate'):
            case ('dispDate'):
                if (array_key_exists('dispDate', $this->arrDBFields)) {
                    return $this->arrDBFields['dispDate'];
                }
                return null;
            break;
            case ('IdSessionObject'):
            case ('idAtheleteObject'):
                if ((array_key_exists('idSession', $this->arrDBFields)) && (!is_null($this->arrDBFields['idSession']))) {
                    return Session::LoadById($this->arrDBFields['idSession']);
                }
                return null;
            break;
            case ('IdAtheleteObject'):
            case ('idAtheleteObject'):
                if ((array_key_exists('idAthelete', $this->arrDBFields)) && (!is_null($this->arrDBFields['idAthelete']))) {
                    return Athelete::LoadById($this->arrDBFields['idAthelete']);
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
            case ('IdResult'):
            case ('idResult'):
                $this->arrDBFields['idResult'] = $strValue;
            break;
            case ('IdSession'):
            case ('idSession'):
                $this->arrDBFields['idSession'] = $strValue;
            break;
            case ('IdAthelete'):
            case ('idAthelete'):
                $this->arrDBFields['idAthelete'] = $strValue;
            break;
            case ('Score'):
            case ('score'):
                $this->arrDBFields['score'] = $strValue;
            break;
            case ('Judge'):
            case ('judge'):
                $this->arrDBFields['judge'] = $strValue;
            break;
            case ('Flag'):
            case ('flag'):
                $this->arrDBFields['flag'] = $strValue;
            break;
            case ('CreDate'):
            case ('creDate'):
                $this->arrDBFields['creDate'] = $strValue;
            break;
            case ('Event'):
            case ('event'):
                $this->arrDBFields['event'] = $strValue;
            break;
            case ('DispDate'):
            case ('dispDate'):
                $this->arrDBFields['dispDate'] = $strValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>