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
* - GetAssignmentArr()
* - LoadCollByIdOrg()
* - LoadByTag()
* - AddTag()
* - ParseArray()
* - Parse()
* - LoadSingleByField()
* - LoadArrayByField()
* - __toArray()
* - __toJson()
* - __get()
* - __set()
* Classes list:
* - DeviceBase extends BaseEntity
*/
class DeviceBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Device';
    const P_KEY = 'idDevice';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idDevice = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Device();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, Device::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Device();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<Device>";
        $xmlStr.= "<idDevice>";
        $xmlStr.= $this->idDevice;
        $xmlStr.= "</idDevice>";
        $xmlStr.= "<name>";
        $xmlStr.= $this->name;
        $xmlStr.= "</name>";
        $xmlStr.= "<token>";
        $xmlStr.= $this->token;
        $xmlStr.= "</token>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<inviteEmail>";
        $xmlStr.= $this->inviteEmail;
        $xmlStr.= "</inviteEmail>";
        $xmlStr.= "<idOrg>";
        $xmlStr.= $this->idOrg;
        $xmlStr.= "</idOrg>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</Device>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Device();
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
    public function GetAssignmentArr() {
        return Assignment::LoadCollByIdDevice($this->idDevice);
    }
    //Load by foregin key
    public static function LoadCollByIdOrg($intIdOrg) {
        $sql = sprintf("SELECT * FROM Device WHERE idOrg = %s;", $intIdOrg);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objDevice = new Device();
            $objDevice->materilize($data);
            $coll->addItem($objDevice);
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
        if (array_key_exists('iddevice', $arrData)) {
            $this->intIdDevice = $arrData['iddevice'];
        }
    }
    public static function Parse($mixData, $blnReturnId = false) {
        if (is_numeric($mixData)) {
            if ($blnReturnId) {
                return $mixData;
            }
            return Device::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'Device')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdDevice;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Device"');
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
            $tObj = new Device();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "Device %>";
        $arrReturn['idDevice'] = $this->idDevice;
        $arrReturn['name'] = $this->name;
        $arrReturn['token'] = $this->token;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['inviteEmail'] = $this->inviteEmail;
        $arrReturn['idOrg'] = $this->idOrg;
        return $arrReturn;
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
            case ('IdDevice'):
            case ('idDevice'):
                if (array_key_exists('idDevice', $this->arrDBFields)) {
                    return $this->arrDBFields['idDevice'];
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
            case ('Token'):
            case ('token'):
                if (array_key_exists('token', $this->arrDBFields)) {
                    return $this->arrDBFields['token'];
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
            case ('InviteEmail'):
            case ('inviteEmail'):
                if (array_key_exists('inviteEmail', $this->arrDBFields)) {
                    return $this->arrDBFields['inviteEmail'];
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
            case ('IdDevice'):
            case ('idDevice'):
                $this->arrDBFields['idDevice'] = $strValue;
            break;
            case ('Name'):
            case ('name'):
                $this->arrDBFields['name'] = $strValue;
            break;
            case ('Token'):
            case ('token'):
                $this->arrDBFields['token'] = $strValue;
            break;
            case ('CreDate'):
            case ('creDate'):
                $this->arrDBFields['creDate'] = $strValue;
            break;
            case ('InviteEmail'):
            case ('inviteEmail'):
                $this->arrDBFields['inviteEmail'] = $strValue;
            break;
            case ('IdOrg'):
            case ('idOrg'):
                $this->arrDBFields['idOrg'] = $strValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>