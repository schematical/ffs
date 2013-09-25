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
* - IdStripeData()
* - Data()
* - IdParentStripeData()
* Classes list:
* - StripeDataBase extends MLCBaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $Object
 * @property-write mixed $Object
 * @property-read mixed $IdAuthUser
 * @property-write mixed $IdAuthUser
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $Mode
 * @property-write mixed $Mode
 * @property-read mixed $Instance_url
 * @property-write mixed $Instance_url
 * @property-read mixed $StripeId
 * @property-write mixed $StripeId
 */
class StripeDataBase extends MLCBaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'StripeData';
    const P_KEY = 'idStripeData';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE StripeData.idStripeData = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = self::Query('');
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<StripeData>";
        $xmlStr.= "<idStripeData>";
        $xmlStr.= $this->idStripeData;
        $xmlStr.= "</idStripeData>";
        $xmlStr.= "<data>";
        $xmlStr.= $this->data;
        $xmlStr.= "</data>";
        $xmlStr.= "<object>";
        $xmlStr.= $this->object;
        $xmlStr.= "</object>";
        $xmlStr.= "<idAuthUser>";
        $xmlStr.= $this->idAuthUser;
        $xmlStr.= "</idAuthUser>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<idParentStripeData>";
        $xmlStr.= $this->idParentStripeData;
        $xmlStr.= "</idParentStripeData>";
        $xmlStr.= "<mode>";
        $xmlStr.= $this->mode;
        $xmlStr.= "</mode>";
        $xmlStr.= "<instance_url>";
        $xmlStr.= $this->instance_url;
        $xmlStr.= "</instance_url>";
        $xmlStr.= "<stripeId>";
        $xmlStr.= $this->stripeId;
        $xmlStr.= "</stripeId>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</StripeData>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('StripeData.idStripeData', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idStripeData'] = $arrData['StripeData.idStripeData'];
                $this->arrDBFields['data'] = $arrData['StripeData.data'];
                $this->arrDBFields['object'] = $arrData['StripeData.object'];
                $this->arrDBFields['idAuthUser'] = $arrData['StripeData.idAuthUser'];
                $this->arrDBFields['creDate'] = $arrData['StripeData.creDate'];
                $this->arrDBFields['idParentStripeData'] = $arrData['StripeData.idParentStripeData'];
                $this->arrDBFields['mode'] = $arrData['StripeData.mode'];
                $this->arrDBFields['instance_url'] = $arrData['StripeData.instance_url'];
                $this->arrDBFields['stripeId'] = $arrData['StripeData.stripeId'];
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
        $arrFields[] = 'StripeData.idStripeData ' . (($blnLongSelect) ? ' as "StripeData.idStripeData"' : '');
        $arrFields[] = 'StripeData.data ' . (($blnLongSelect) ? ' as "StripeData.data"' : '');
        $arrFields[] = 'StripeData.object ' . (($blnLongSelect) ? ' as "StripeData.object"' : '');
        $arrFields[] = 'StripeData.idAuthUser ' . (($blnLongSelect) ? ' as "StripeData.idAuthUser"' : '');
        $arrFields[] = 'StripeData.creDate ' . (($blnLongSelect) ? ' as "StripeData.creDate"' : '');
        $arrFields[] = 'StripeData.idParentStripeData ' . (($blnLongSelect) ? ' as "StripeData.idParentStripeData"' : '');
        $arrFields[] = 'StripeData.mode ' . (($blnLongSelect) ? ' as "StripeData.mode"' : '');
        $arrFields[] = 'StripeData.instance_url ' . (($blnLongSelect) ? ' as "StripeData.instance_url"' : '');
        $arrFields[] = 'StripeData.stripeId ' . (($blnLongSelect) ? ' as "StripeData.stripeId"' : '');
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
                }
            }
        }
        if (!is_null($strExtra)) {
            $strSql = sprintf("SELECT %s FROM StripeData %s %s;", $strFields, $strJoin, $strExtra);
            $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        }
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('StripeData');
        }
        if (!is_null($strExtra)) {
            $collReturn->AddQueryToHistory($strSql);
            while ($data = mysql_fetch_assoc($result)) {
                $tObj = new StripeData();
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
                }
            }
        }
        $strSql = sprintf("SELECT %s FROM StripeData %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
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
    }
    public static function Parse($mixData, $blnReturnId = false) {
        if (is_numeric($mixData)) {
            if ($blnReturnId) {
                return $mixData;
            }
            return StripeData::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'StripeData')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdStripeData;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "StripeData"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE StripeData.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE StripeData.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $collReturn = array();
        $collReturn['_ClassName'] = "StripeData %>";
        $collReturn['idStripeData'] = $this->idStripeData;
        $collReturn['data'] = $this->data;
        $collReturn['object'] = $this->object;
        $collReturn['idAuthUser'] = $this->idAuthUser;
        $collReturn['creDate'] = $this->creDate;
        $collReturn['idParentStripeData'] = $this->idParentStripeData;
        $collReturn['mode'] = $this->mode;
        $collReturn['instance_url'] = $this->instance_url;
        $collReturn['stripeId'] = $this->stripeId;
        return $collReturn;
    }
    public function __toString() {
        return 'StripeData(' . $this->getId() . ')';
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
            case ('IdStripeData'):
            case ('idStripeData'):
                if (array_key_exists('idStripeData', $this->arrDBFields)) {
                    return $this->arrDBFields['idStripeData'];
                }
                return null;
            break;
            case ('Object'):
            case ('object'):
                if (array_key_exists('object', $this->arrDBFields)) {
                    return $this->arrDBFields['object'];
                }
                return null;
            break;
            case ('IdAuthUser'):
            case ('idAuthUser'):
                if (array_key_exists('idAuthUser', $this->arrDBFields)) {
                    return $this->arrDBFields['idAuthUser'];
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
            case ('IdParentStripeData'):
            case ('idParentStripeData'):
                if (array_key_exists('idParentStripeData', $this->arrDBFields)) {
                    return $this->arrDBFields['idParentStripeData'];
                }
                return null;
            break;
            case ('Mode'):
            case ('mode'):
                if (array_key_exists('mode', $this->arrDBFields)) {
                    return $this->arrDBFields['mode'];
                }
                return null;
            break;
            case ('Instance_url'):
            case ('instance_url'):
                if (array_key_exists('instance_url', $this->arrDBFields)) {
                    return $this->arrDBFields['instance_url'];
                }
                return null;
            break;
            case ('StripeId'):
            case ('stripeId'):
                if (array_key_exists('stripeId', $this->arrDBFields)) {
                    return $this->arrDBFields['stripeId'];
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
            case ('IdStripeData'):
            case ('idStripeData'):
            case ('_IdStripeData'):
                $this->arrDBFields['idStripeData'] = $mixValue;
            break;
            case ('_Data'):
                $this->arrDBFields['data'] = $mixValue;
            break;
            case ('Object'):
            case ('object'):
            case ('_Object'):
                $this->arrDBFields['object'] = $mixValue;
            break;
            case ('IdAuthUser'):
            case ('idAuthUser'):
                $this->arrDBFields['idAuthUser'] = $mixValue;
            break;
            case ('CreDate'):
            case ('creDate'):
            case ('_CreDate'):
                $this->arrDBFields['creDate'] = $mixValue;
            break;
            case ('IdParentStripeData'):
            case ('idParentStripeData'):
            case ('_IdParentStripeData'):
                $this->arrDBFields['idParentStripeData'] = $mixValue;
            break;
            case ('Mode'):
            case ('mode'):
            case ('_Mode'):
                $this->arrDBFields['mode'] = $mixValue;
            break;
            case ('Instance_url'):
            case ('instance_url'):
            case ('_Instance_url'):
                $this->arrDBFields['instance_url'] = $mixValue;
            break;
            case ('StripeId'):
            case ('stripeId'):
            case ('_StripeId'):
                $this->arrDBFields['stripeId'] = $mixValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
    public function IdStripeData($strKey, $mixData = null) {
        if (is_null($mixData)) {
            if ((!array_key_exists('idStripeData', $this->arrDBFields))) {
                return null;
            }
            if ((strlen($this->arrDBFields['idStripeData']) < 1)) {
                return null;
            }
            $arrData = json_decode($this->arrDBFields['idStripeData'], true);
            if (!array_key_exists($strKey, $arrData)) {
                return null;
            }
            return $arrData[$strKey];
        } else {
            if ((!array_key_exists('idStripeData', $this->arrDBFields)) || (strlen($this->arrDBFields['idStripeData']) < 1)) {
                $arrData = array();
            } else {
                $arrData = json_decode($this->arrDBFields['idStripeData'], true);
            }
            $arrData[$strKey] = $mixData;
            $this->arrDBFields['idStripeData'] = json_encode($arrData);
            $this->Save();
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
    public function IdParentStripeData($strKey, $mixData = null) {
        if (is_null($mixData)) {
            if ((!array_key_exists('idParentStripeData', $this->arrDBFields))) {
                return null;
            }
            if ((strlen($this->arrDBFields['idParentStripeData']) < 1)) {
                return null;
            }
            $arrData = json_decode($this->arrDBFields['idParentStripeData'], true);
            if (!array_key_exists($strKey, $arrData)) {
                return null;
            }
            return $arrData[$strKey];
        } else {
            if ((!array_key_exists('idParentStripeData', $this->arrDBFields)) || (strlen($this->arrDBFields['idParentStripeData']) < 1)) {
                $arrData = array();
            } else {
                $arrData = json_decode($this->arrDBFields['idParentStripeData'], true);
            }
            $arrData[$strKey] = $mixData;
            $this->arrDBFields['idParentStripeData'] = json_encode($arrData);
            $this->Save();
        }
    }
}
?>