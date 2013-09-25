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
* - LoadCollByIdAccount()
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
* - MLCLocationBase extends MLCBaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdLocation
 * @property-write mixed $IdLocation
 * @property-read mixed $ShortDesc
 * @property-write mixed $ShortDesc
 * @property-read mixed $Address1
 * @property-write mixed $Address1
 * @property-read mixed $Address2
 * @property-write mixed $Address2
 * @property-read mixed $City
 * @property-write mixed $City
 * @property-read mixed $State
 * @property-write mixed $State
 * @property-read mixed $Zip
 * @property-write mixed $Zip
 * @property-read mixed $Country
 * @property-write mixed $Country
 * @property-read mixed $Lat
 * @property-write mixed $Lat
 * @property-read mixed $Lng
 * @property-write mixed $Lng
 * @property-read mixed $IdAccount
 * @property-write mixed $IdAccount
 * @property-read MLCLocation $IdAccountObject
 */
class MLCLocationBase extends MLCBaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'MLCLocation';
    const P_KEY = 'idLocation';
    protected $objIdAccount = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE MLCLocation.idLocation = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = self::Query('');
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<MLCLocation>";
        $xmlStr.= "<idLocation>";
        $xmlStr.= $this->idLocation;
        $xmlStr.= "</idLocation>";
        $xmlStr.= "<shortDesc>";
        $xmlStr.= $this->shortDesc;
        $xmlStr.= "</shortDesc>";
        $xmlStr.= "<address1>";
        $xmlStr.= $this->address1;
        $xmlStr.= "</address1>";
        $xmlStr.= "<address2>";
        $xmlStr.= $this->address2;
        $xmlStr.= "</address2>";
        $xmlStr.= "<city>";
        $xmlStr.= $this->city;
        $xmlStr.= "</city>";
        $xmlStr.= "<state>";
        $xmlStr.= $this->state;
        $xmlStr.= "</state>";
        $xmlStr.= "<zip>";
        $xmlStr.= $this->zip;
        $xmlStr.= "</zip>";
        $xmlStr.= "<country>";
        $xmlStr.= $this->country;
        $xmlStr.= "</country>";
        $xmlStr.= "<lat>";
        $xmlStr.= $this->lat;
        $xmlStr.= "</lat>";
        $xmlStr.= "<lng>";
        $xmlStr.= $this->lng;
        $xmlStr.= "</lng>";
        $xmlStr.= "<idAccount>";
        $xmlStr.= $this->idAccount;
        $xmlStr.= "</idAccount>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</MLCLocation>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('MLCLocation.idLocation', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idLocation'] = $arrData['MLCLocation.idLocation'];
                $this->arrDBFields['shortDesc'] = $arrData['MLCLocation.shortDesc'];
                $this->arrDBFields['address1'] = $arrData['MLCLocation.address1'];
                $this->arrDBFields['address2'] = $arrData['MLCLocation.address2'];
                $this->arrDBFields['city'] = $arrData['MLCLocation.city'];
                $this->arrDBFields['state'] = $arrData['MLCLocation.state'];
                $this->arrDBFields['zip'] = $arrData['MLCLocation.zip'];
                $this->arrDBFields['country'] = $arrData['MLCLocation.country'];
                $this->arrDBFields['lat'] = $arrData['MLCLocation.lat'];
                $this->arrDBFields['lng'] = $arrData['MLCLocation.lng'];
                $this->arrDBFields['idAccount'] = $arrData['MLCLocation.idAccount'];
                //Foregin Key
                if ((array_key_exists('AuthAccount.idAccount', $arrData)) && (!is_null($arrData['AuthAccount.idAccount']))) {
                    $this->objIdAccount = new AuthAccount();
                    $this->objIdAccount->Materilize($arrData);
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
        $arrFields[] = 'MLCLocation.idLocation ' . (($blnLongSelect) ? ' as "MLCLocation.idLocation"' : '');
        $arrFields[] = 'MLCLocation.shortDesc ' . (($blnLongSelect) ? ' as "MLCLocation.shortDesc"' : '');
        $arrFields[] = 'MLCLocation.address1 ' . (($blnLongSelect) ? ' as "MLCLocation.address1"' : '');
        $arrFields[] = 'MLCLocation.address2 ' . (($blnLongSelect) ? ' as "MLCLocation.address2"' : '');
        $arrFields[] = 'MLCLocation.city ' . (($blnLongSelect) ? ' as "MLCLocation.city"' : '');
        $arrFields[] = 'MLCLocation.state ' . (($blnLongSelect) ? ' as "MLCLocation.state"' : '');
        $arrFields[] = 'MLCLocation.zip ' . (($blnLongSelect) ? ' as "MLCLocation.zip"' : '');
        $arrFields[] = 'MLCLocation.country ' . (($blnLongSelect) ? ' as "MLCLocation.country"' : '');
        $arrFields[] = 'MLCLocation.lat ' . (($blnLongSelect) ? ' as "MLCLocation.lat"' : '');
        $arrFields[] = 'MLCLocation.lng ' . (($blnLongSelect) ? ' as "MLCLocation.lng"' : '');
        $arrFields[] = 'MLCLocation.idAccount ' . (($blnLongSelect) ? ' as "MLCLocation.idAccount"' : '');
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
                    case ('AuthAccount'):
                        $strJoin.= ' LEFT JOIN AuthAccount ON MLCLocation.idAccount = AuthAccount.idAccount';
                    break;
                }
            }
        }
        if (!is_null($strExtra)) {
            $strSql = sprintf("SELECT %s FROM MLCLocation %s %s;", $strFields, $strJoin, $strExtra);
            $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        }
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('MLCLocation');
        }
        if (!is_null($strExtra)) {
            $collReturn->AddQueryToHistory($strSql);
            while ($data = mysql_fetch_assoc($result)) {
                $tObj = new MLCLocation();
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
                    case ('AuthAccount'):
                        $strJoin.= ' LEFT JOIN AuthAccount ON MLCLocation.idAccount = AuthAccount.idAccount';
                    break;
                }
            }
        }
        $strSql = sprintf("SELECT %s FROM MLCLocation %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdAccount($intIdAccount) {
        $strSql = sprintf(" WHERE idAccount = %s;", $intIdAccount);
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
            return MLCLocation::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'MLCLocation')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdLocation;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "MLCLocation"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE MLCLocation.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE MLCLocation.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $collReturn = array();
        $collReturn['_ClassName'] = "MLCLocation %>";
        $collReturn['idLocation'] = $this->idLocation;
        $collReturn['shortDesc'] = $this->shortDesc;
        $collReturn['address1'] = $this->address1;
        $collReturn['address2'] = $this->address2;
        $collReturn['city'] = $this->city;
        $collReturn['state'] = $this->state;
        $collReturn['zip'] = $this->zip;
        $collReturn['country'] = $this->country;
        $collReturn['lat'] = $this->lat;
        $collReturn['lng'] = $this->lng;
        $collReturn['idAccount'] = $this->idAccount;
        return $collReturn;
    }
    public function __toString() {
        return 'MLCLocation(' . $this->getId() . ')';
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
            case ('IdLocation'):
            case ('idLocation'):
                if (array_key_exists('idLocation', $this->arrDBFields)) {
                    return $this->arrDBFields['idLocation'];
                }
                return null;
            break;
            case ('ShortDesc'):
            case ('shortDesc'):
                if (array_key_exists('shortDesc', $this->arrDBFields)) {
                    return $this->arrDBFields['shortDesc'];
                }
                return null;
            break;
            case ('Address1'):
            case ('address1'):
                if (array_key_exists('address1', $this->arrDBFields)) {
                    return $this->arrDBFields['address1'];
                }
                return null;
            break;
            case ('Address2'):
            case ('address2'):
                if (array_key_exists('address2', $this->arrDBFields)) {
                    return $this->arrDBFields['address2'];
                }
                return null;
            break;
            case ('City'):
            case ('city'):
                if (array_key_exists('city', $this->arrDBFields)) {
                    return $this->arrDBFields['city'];
                }
                return null;
            break;
            case ('State'):
            case ('state'):
                if (array_key_exists('state', $this->arrDBFields)) {
                    return $this->arrDBFields['state'];
                }
                return null;
            break;
            case ('Zip'):
            case ('zip'):
                if (array_key_exists('zip', $this->arrDBFields)) {
                    return $this->arrDBFields['zip'];
                }
                return null;
            break;
            case ('Country'):
            case ('country'):
                if (array_key_exists('country', $this->arrDBFields)) {
                    return $this->arrDBFields['country'];
                }
                return null;
            break;
            case ('Lat'):
            case ('lat'):
                if (array_key_exists('lat', $this->arrDBFields)) {
                    return $this->arrDBFields['lat'];
                }
                return null;
            break;
            case ('Lng'):
            case ('lng'):
                if (array_key_exists('lng', $this->arrDBFields)) {
                    return $this->arrDBFields['lng'];
                }
                return null;
            break;
            case ('IdAccount'):
            case ('idAccount'):
                if (array_key_exists('idAccount', $this->arrDBFields)) {
                    return $this->arrDBFields['idAccount'];
                }
                return null;
            break;
            case ('IdAccountObject'):
                if (!is_null($this->objIdAccount)) {
                    return $this->objIdAccount;
                }
                if ((array_key_exists('idAccount', $this->arrDBFields)) && (!is_null($this->arrDBFields['idAccount']))) {
                    $this->objIdAccount = AuthAccount::LoadById($this->arrDBFields['idAccount']);
                    return $this->objIdAccount;
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
            case ('IdLocation'):
            case ('idLocation'):
                $this->arrDBFields['idLocation'] = $mixValue;
            break;
            case ('ShortDesc'):
            case ('shortDesc'):
            case ('_ShortDesc'):
                $this->arrDBFields['shortDesc'] = $mixValue;
            break;
            case ('Address1'):
            case ('address1'):
            case ('_Address1'):
                $this->arrDBFields['address1'] = $mixValue;
            break;
            case ('Address2'):
            case ('address2'):
            case ('_Address2'):
                $this->arrDBFields['address2'] = $mixValue;
            break;
            case ('City'):
            case ('city'):
            case ('_City'):
                $this->arrDBFields['city'] = $mixValue;
            break;
            case ('State'):
            case ('state'):
            case ('_State'):
                $this->arrDBFields['state'] = $mixValue;
            break;
            case ('Zip'):
            case ('zip'):
            case ('_Zip'):
                $this->arrDBFields['zip'] = $mixValue;
            break;
            case ('Country'):
            case ('country'):
            case ('_Country'):
                $this->arrDBFields['country'] = $mixValue;
            break;
            case ('Lat'):
            case ('lat'):
            case ('_Lat'):
                $this->arrDBFields['lat'] = $mixValue;
            break;
            case ('Lng'):
            case ('lng'):
            case ('_Lng'):
                $this->arrDBFields['lng'] = $mixValue;
            break;
            case ('IdAccount'):
            case ('idAccount'):
                $this->arrDBFields['idAccount'] = $mixValue;
                $this->objIdAccount = null;
            break;
            case ('IdAccountObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof AuthAccount)))) {
                    throw new MLCWrongTypeException('__set', $strName);
                }
                if (!is_null($mixValue)) {
                    $this->arrDBFields['idAccount'] = $mixValue->idAccount;
                } else {
                    $this->arrDBFields['idAccount'] = null;
                }
                $this->objIdAccount = $mixValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>