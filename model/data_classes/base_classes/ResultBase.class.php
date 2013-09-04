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
    protected $objIdSession = null;
    protected $objIdAthelete = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE Result.idResult = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = new BaseEntityCollection(self::Query(''));
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
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if (array_key_exists('Result.idResult', $arrData)) {
                //New Smart Way
                $this->arrDBFields['idResult'] = $arrData['Result.idResult'];
                $this->arrDBFields['idSession'] = $arrData['Result.idSession'];
                $this->arrDBFields['idAthelete'] = $arrData['Result.idAthelete'];
                $this->arrDBFields['score'] = $arrData['Result.score'];
                $this->arrDBFields['judge'] = $arrData['Result.judge'];
                $this->arrDBFields['flag'] = $arrData['Result.flag'];
                $this->arrDBFields['creDate'] = $arrData['Result.creDate'];
                $this->arrDBFields['event'] = $arrData['Result.event'];
                $this->arrDBFields['dispDate'] = $arrData['Result.dispDate'];
                //Foregin Key
                if (array_key_exists('Session.idSession', $arrData)) {
                    $this->objIdAthelete = new Session();
                    $this->objIdAthelete->Materilize($arrData);
                }
                if (array_key_exists('Athelete.idAthelete', $arrData)) {
                    $this->objIdAthelete = new Athelete();
                    $this->objIdAthelete->Materilize($arrData);
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
        $arrFields[] = 'Result.idResult ' . (($blnLongSelect) ? ' as "Result.idResult"' : '');
        $arrFields[] = 'Result.idSession ' . (($blnLongSelect) ? ' as "Result.idSession"' : '');
        $arrFields[] = 'Result.idAthelete ' . (($blnLongSelect) ? ' as "Result.idAthelete"' : '');
        $arrFields[] = 'Result.score ' . (($blnLongSelect) ? ' as "Result.score"' : '');
        $arrFields[] = 'Result.judge ' . (($blnLongSelect) ? ' as "Result.judge"' : '');
        $arrFields[] = 'Result.flag ' . (($blnLongSelect) ? ' as "Result.flag"' : '');
        $arrFields[] = 'Result.creDate ' . (($blnLongSelect) ? ' as "Result.creDate"' : '');
        $arrFields[] = 'Result.event ' . (($blnLongSelect) ? ' as "Result.event"' : '');
        $arrFields[] = 'Result.dispDate ' . (($blnLongSelect) ? ' as "Result.dispDate"' : '');
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
                    case ('Session'):
                        $strJoin.= ' JOIN Session ON Result.idSession = Session.idSession';
                    break;
                    case ('Athelete'):
                        $strJoin.= ' JOIN Athelete ON Result.idAthelete = Athelete.idAthelete';
                    break;
                }
            }
        }
        $sql = sprintf("SELECT %s FROM Result %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Result();
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
        $sql = sprintf("SELECT Result.* FROM Result %s;", $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdSession($intIdSession) {
        $sql = sprintf("SELECT Result.* FROM Result WHERE idSession = %s;", $intIdSession);
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
        $sql = sprintf("SELECT Result.* FROM Result WHERE idAthelete = %s;", $intIdAthelete);
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
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Result.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Result.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
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
                if (!is_null($this->objIdSession)) {
                    return $this->objIdSession;
                }
                if ((array_key_exists('idSession', $this->arrDBFields)) && (!is_null($this->arrDBFields['idSession']))) {
                    $this->objIdSession = Session::LoadById($this->arrDBFields['idSession']);
                    return $this->objIdSession;
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
                $this->objIdSession = null;
            break;
            case ('IdAthelete'):
            case ('idAthelete'):
                $this->arrDBFields['idAthelete'] = $strValue;
                $this->objIdAthelete = null;
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
            case ('IdSessionObject'):
                $this->arrDBFields['idSession'] = $strValue->idSession;
                $this->objIdSession = $strValue;
            break;
            case ('IdAtheleteObject'):
                $this->arrDBFields['idAthelete'] = $strValue->idAthelete;
                $this->objIdAthelete = $strValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>