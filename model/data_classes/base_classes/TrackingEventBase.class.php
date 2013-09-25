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
* - TrackingEventBase extends MLCBaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdTrackingEvent
 * @property-write mixed $IdTrackingEvent
 * @property-read mixed $Name
 * @property-write mixed $Name
 * @property-read mixed $Value
 * @property-write mixed $Value
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $IdUser
 * @property-write mixed $IdUser
 * @property-read mixed $IdSession
 * @property-write mixed $IdSession
 * @property-read mixed $IdApplication
 * @property-write mixed $IdApplication
 * @property-read mixed $App
 * @property-write mixed $App
 * @property-read TrackingEvent $IdSessionObject
 */
class TrackingEventBase extends MLCBaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'TrackingEvent';
    const P_KEY = 'idTrackingEvent';
    protected $objIdSession = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE TrackingEvent.idTrackingEvent = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = self::Query('');
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<TrackingEvent>";
        $xmlStr.= "<idTrackingEvent>";
        $xmlStr.= $this->idTrackingEvent;
        $xmlStr.= "</idTrackingEvent>";
        $xmlStr.= "<name>";
        $xmlStr.= $this->name;
        $xmlStr.= "</name>";
        $xmlStr.= "<value>";
        $xmlStr.= $this->value;
        $xmlStr.= "</value>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<idUser>";
        $xmlStr.= $this->idUser;
        $xmlStr.= "</idUser>";
        $xmlStr.= "<idSession>";
        $xmlStr.= $this->idSession;
        $xmlStr.= "</idSession>";
        $xmlStr.= "<idApplication>";
        $xmlStr.= $this->idApplication;
        $xmlStr.= "</idApplication>";
        $xmlStr.= "<app>";
        $xmlStr.= $this->app;
        $xmlStr.= "</app>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</TrackingEvent>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('TrackingEvent.idTrackingEvent', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idTrackingEvent'] = $arrData['TrackingEvent.idTrackingEvent'];
                $this->arrDBFields['name'] = $arrData['TrackingEvent.name'];
                $this->arrDBFields['value'] = $arrData['TrackingEvent.value'];
                $this->arrDBFields['creDate'] = $arrData['TrackingEvent.creDate'];
                $this->arrDBFields['idUser'] = $arrData['TrackingEvent.idUser'];
                $this->arrDBFields['idSession'] = $arrData['TrackingEvent.idSession'];
                $this->arrDBFields['idApplication'] = $arrData['TrackingEvent.idApplication'];
                $this->arrDBFields['app'] = $arrData['TrackingEvent.app'];
                //Foregin Key
                if ((array_key_exists('AuthSession.idSession', $arrData)) && (!is_null($arrData['AuthSession.idSession']))) {
                    $this->objIdSession = new AuthSession();
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
        $arrFields[] = 'TrackingEvent.idTrackingEvent ' . (($blnLongSelect) ? ' as "TrackingEvent.idTrackingEvent"' : '');
        $arrFields[] = 'TrackingEvent.name ' . (($blnLongSelect) ? ' as "TrackingEvent.name"' : '');
        $arrFields[] = 'TrackingEvent.value ' . (($blnLongSelect) ? ' as "TrackingEvent.value"' : '');
        $arrFields[] = 'TrackingEvent.creDate ' . (($blnLongSelect) ? ' as "TrackingEvent.creDate"' : '');
        $arrFields[] = 'TrackingEvent.idUser ' . (($blnLongSelect) ? ' as "TrackingEvent.idUser"' : '');
        $arrFields[] = 'TrackingEvent.idSession ' . (($blnLongSelect) ? ' as "TrackingEvent.idSession"' : '');
        $arrFields[] = 'TrackingEvent.idApplication ' . (($blnLongSelect) ? ' as "TrackingEvent.idApplication"' : '');
        $arrFields[] = 'TrackingEvent.app ' . (($blnLongSelect) ? ' as "TrackingEvent.app"' : '');
        return $arrFields;
    }
    public static function Query($strExtra = null, $mixReturnSingle = false, $arrJoins = null) {
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
                    case ('AuthSession'):
                        $strJoin.= ' LEFT JOIN AuthSession ON TrackingEvent.idSession = AuthSession.idSession';
                    break;
                }
            }
        }
        if (!is_null($strExtra)) {
            $strSql = sprintf("SELECT %s FROM TrackingEvent %s %s;", $strFields, $strJoin, $strExtra);
            $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        }
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('TrackingEvent');
        }
        if (!is_null($strExtra)) {
            $collReturn->AddQueryToHistory($strSql);
            while ($data = mysql_fetch_assoc($result)) {
                $tObj = new TrackingEvent();
                $tObj->Materilize($data);
                $collReturn[] = $tObj;
            }
        }
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
    public static function QueryCount($strExtra = '', $arrJoins = array()) {
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
                    case ('AuthSession'):
                        $strJoin.= ' LEFT JOIN AuthSession ON TrackingEvent.idSession = AuthSession.idSession';
                    break;
                }
            }
        }
        $strSql = sprintf("SELECT %s FROM TrackingEvent %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdSession($intIdSession) {
        $strSql = sprintf(" WHERE idSession = %s;", $intIdSession);
        $coll = self::Query($strSql);
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
            return TrackingEvent::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'TrackingEvent')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdTrackingEvent;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "TrackingEvent"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE TrackingEvent.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE TrackingEvent.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $collReturn = array();
        $collReturn['_ClassName'] = "TrackingEvent %>";
        $collReturn['idTrackingEvent'] = $this->idTrackingEvent;
        $collReturn['name'] = $this->name;
        $collReturn['value'] = $this->value;
        $collReturn['creDate'] = $this->creDate;
        $collReturn['idUser'] = $this->idUser;
        $collReturn['idSession'] = $this->idSession;
        $collReturn['idApplication'] = $this->idApplication;
        $collReturn['app'] = $this->app;
        return $collReturn;
    }
    public function __toString() {
        return 'TrackingEvent(' . $this->getId() . ')';
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
            case ('IdTrackingEvent'):
            case ('idTrackingEvent'):
                if (array_key_exists('idTrackingEvent', $this->arrDBFields)) {
                    return $this->arrDBFields['idTrackingEvent'];
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
            case ('Value'):
            case ('value'):
                if (array_key_exists('value', $this->arrDBFields)) {
                    return $this->arrDBFields['value'];
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
            case ('IdUser'):
            case ('idUser'):
                if (array_key_exists('idUser', $this->arrDBFields)) {
                    return $this->arrDBFields['idUser'];
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
            case ('IdApplication'):
            case ('idApplication'):
                if (array_key_exists('idApplication', $this->arrDBFields)) {
                    return $this->arrDBFields['idApplication'];
                }
                return null;
            break;
            case ('App'):
            case ('app'):
                if (array_key_exists('app', $this->arrDBFields)) {
                    return $this->arrDBFields['app'];
                }
                return null;
            break;
            case ('IdSessionObject'):
                if (!is_null($this->objIdSession)) {
                    return $this->objIdSession;
                }
                if ((array_key_exists('idSession', $this->arrDBFields)) && (!is_null($this->arrDBFields['idSession']))) {
                    $this->objIdSession = AuthSession::LoadById($this->arrDBFields['idSession']);
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
            case ('IdTrackingEvent'):
            case ('idTrackingEvent'):
                $this->arrDBFields['idTrackingEvent'] = $mixValue;
            break;
            case ('Name'):
            case ('name'):
            case ('_Name'):
                $this->arrDBFields['name'] = $mixValue;
            break;
            case ('Value'):
            case ('value'):
            case ('_Value'):
                $this->arrDBFields['value'] = $mixValue;
            break;
            case ('CreDate'):
            case ('creDate'):
            case ('_CreDate'):
                $this->arrDBFields['creDate'] = $mixValue;
            break;
            case ('IdUser'):
            case ('idUser'):
                $this->arrDBFields['idUser'] = $mixValue;
            break;
            case ('IdSession'):
            case ('idSession'):
                $this->arrDBFields['idSession'] = $mixValue;
                $this->objIdSession = null;
            break;
            case ('IdApplication'):
            case ('idApplication'):
                $this->arrDBFields['idApplication'] = $mixValue;
            break;
            case ('App'):
            case ('app'):
            case ('_App'):
                $this->arrDBFields['app'] = $mixValue;
            break;
            case ('IdSessionObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof AuthSession)))) {
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