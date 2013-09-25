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
* - LoadCollByIdUser()
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
* - Data()
* Classes list:
* - MLCNotificationBase extends MLCBaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdNotification
 * @property-write mixed $IdNotification
 * @property-read mixed $IdUser
 * @property-write mixed $IdUser
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $ClassName
 * @property-write mixed $ClassName
 * @property-read mixed $Viewed
 * @property-write mixed $Viewed
 * @property-read MLCNotification $IdUserObject
 */
class MLCNotificationBase extends MLCBaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'MLCNotification';
    const P_KEY = 'idNotification';
    protected $objIdUser = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE MLCNotification.idNotification = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = self::Query('');
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<MLCNotification>";
        $xmlStr.= "<idNotification>";
        $xmlStr.= $this->idNotification;
        $xmlStr.= "</idNotification>";
        $xmlStr.= "<idUser>";
        $xmlStr.= $this->idUser;
        $xmlStr.= "</idUser>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<className>";
        $xmlStr.= $this->className;
        $xmlStr.= "</className>";
        $xmlStr.= "<data>";
        $xmlStr.= $this->data;
        $xmlStr.= "</data>";
        $xmlStr.= "<viewed>";
        $xmlStr.= $this->viewed;
        $xmlStr.= "</viewed>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</MLCNotification>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('MLCNotification.idNotification', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idNotification'] = $arrData['MLCNotification.idNotification'];
                $this->arrDBFields['idUser'] = $arrData['MLCNotification.idUser'];
                $this->arrDBFields['creDate'] = $arrData['MLCNotification.creDate'];
                $this->arrDBFields['className'] = $arrData['MLCNotification.className'];
                $this->arrDBFields['data'] = $arrData['MLCNotification.data'];
                $this->arrDBFields['viewed'] = $arrData['MLCNotification.viewed'];
                //Foregin Key
                if ((array_key_exists('AuthUser.idUser', $arrData)) && (!is_null($arrData['AuthUser.idUser']))) {
                    $this->objIdUser = new AuthUser();
                    $this->objIdUser->Materilize($arrData);
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
        $arrFields[] = 'MLCNotification.idNotification ' . (($blnLongSelect) ? ' as "MLCNotification.idNotification"' : '');
        $arrFields[] = 'MLCNotification.idUser ' . (($blnLongSelect) ? ' as "MLCNotification.idUser"' : '');
        $arrFields[] = 'MLCNotification.creDate ' . (($blnLongSelect) ? ' as "MLCNotification.creDate"' : '');
        $arrFields[] = 'MLCNotification.className ' . (($blnLongSelect) ? ' as "MLCNotification.className"' : '');
        $arrFields[] = 'MLCNotification.data ' . (($blnLongSelect) ? ' as "MLCNotification.data"' : '');
        $arrFields[] = 'MLCNotification.viewed ' . (($blnLongSelect) ? ' as "MLCNotification.viewed"' : '');
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
                    case ('AuthUser'):
                        $strJoin.= ' LEFT JOIN AuthUser ON MLCNotification.idUser = AuthUser.idUser';
                    break;
                }
            }
        }
        if (!is_null($strExtra)) {
            $strSql = sprintf("SELECT %s FROM MLCNotification %s %s;", $strFields, $strJoin, $strExtra);
            $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        }
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('MLCNotification');
        }
        if (!is_null($strExtra)) {
            $collReturn->AddQueryToHistory($strSql);
            while ($data = mysql_fetch_assoc($result)) {
                $tObj = new MLCNotification();
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
                    case ('AuthUser'):
                        $strJoin.= ' LEFT JOIN AuthUser ON MLCNotification.idUser = AuthUser.idUser';
                    break;
                }
            }
        }
        $strSql = sprintf("SELECT %s FROM MLCNotification %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdUser($intIdUser) {
        $strSql = sprintf(" WHERE idUser = %s;", $intIdUser);
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
            return MLCNotification::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'MLCNotification')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdNotification;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "MLCNotification"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE MLCNotification.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE MLCNotification.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $collReturn = array();
        $collReturn['_ClassName'] = "MLCNotification %>";
        $collReturn['idNotification'] = $this->idNotification;
        $collReturn['idUser'] = $this->idUser;
        $collReturn['creDate'] = $this->creDate;
        $collReturn['className'] = $this->className;
        $collReturn['data'] = $this->data;
        $collReturn['viewed'] = $this->viewed;
        return $collReturn;
    }
    public function __toString() {
        return 'MLCNotification(' . $this->getId() . ')';
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
            case ('IdNotification'):
            case ('idNotification'):
                if (array_key_exists('idNotification', $this->arrDBFields)) {
                    return $this->arrDBFields['idNotification'];
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
            case ('CreDate'):
            case ('creDate'):
                if (array_key_exists('creDate', $this->arrDBFields)) {
                    return $this->arrDBFields['creDate'];
                }
                return null;
            break;
            case ('ClassName'):
            case ('className'):
                if (array_key_exists('className', $this->arrDBFields)) {
                    return $this->arrDBFields['className'];
                }
                return null;
            break;
            case ('Viewed'):
            case ('viewed'):
                if (array_key_exists('viewed', $this->arrDBFields)) {
                    return $this->arrDBFields['viewed'];
                }
                return null;
            break;
            case ('IdUserObject'):
                if (!is_null($this->objIdUser)) {
                    return $this->objIdUser;
                }
                if ((array_key_exists('idUser', $this->arrDBFields)) && (!is_null($this->arrDBFields['idUser']))) {
                    $this->objIdUser = AuthUser::LoadById($this->arrDBFields['idUser']);
                    return $this->objIdUser;
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
            case ('IdNotification'):
            case ('idNotification'):
                $this->arrDBFields['idNotification'] = $mixValue;
            break;
            case ('IdUser'):
            case ('idUser'):
                $this->arrDBFields['idUser'] = $mixValue;
                $this->objIdUser = null;
            break;
            case ('CreDate'):
            case ('creDate'):
            case ('_CreDate'):
                $this->arrDBFields['creDate'] = $mixValue;
            break;
            case ('ClassName'):
            case ('className'):
            case ('_ClassName'):
                $this->arrDBFields['className'] = $mixValue;
            break;
            case ('_Data'):
                $this->arrDBFields['data'] = $mixValue;
            break;
            case ('Viewed'):
            case ('viewed'):
            case ('_Viewed'):
                $this->arrDBFields['viewed'] = $mixValue;
            break;
            case ('IdUserObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof AuthUser)))) {
                    throw new MLCWrongTypeException('__set', $strName);
                }
                if (!is_null($mixValue)) {
                    $this->arrDBFields['idUser'] = $mixValue->idUser;
                } else {
                    $this->arrDBFields['idUser'] = null;
                }
                $this->objIdUser = $mixValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
    public function Data($strKey, $mixData = null) {
        if (is_null($mixData)) {
            if ((!array_key_exists('data', $this->arrDBFields))) {
                return null;
            }
            if ((strlen($this->arrDBFields['data']) < 1)) {
                return null;
            }
            $arrData = json_decode($this->arrDBFields['data'], true);
            if (!array_key_exists($strKey, $arrData)) {
                return null;
            }
            return $arrData[$strKey];
        } else {
            if ((!array_key_exists('data', $this->arrDBFields)) || (strlen($this->arrDBFields['data']) < 1)) {
                $arrData = array();
            } else {
                $arrData = json_decode($this->arrDBFields['data'], true);
            }
            $arrData[$strKey] = $mixData;
            $this->arrDBFields['data'] = json_encode($arrData);
            $this->Save();
        }
    }
}
?>