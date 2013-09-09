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
* - GetAssignmentArr()
* - GetAssignmentArrBySession()
* - CreateAssignmentFromSession()
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
* - DeviceBase extends BaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdDevice
 * @property-write mixed $IdDevice
 * @property-read mixed $Name
 * @property-write mixed $Name
 * @property-read mixed $Token
 * @property-write mixed $Token
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $InviteEmail
 * @property-write mixed $InviteEmail
 * @property-read mixed $IdOrg
 * @property-write mixed $IdOrg
 * @property-read Device $IdOrgObject
 */
class DeviceBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Device';
    const P_KEY = 'idDevice';
    protected $objIdOrg = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE Device.idDevice = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = new BaseEntityCollection(self::Query(''));
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
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('Device.idDevice', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idDevice'] = $arrData['Device.idDevice'];
                $this->arrDBFields['name'] = $arrData['Device.name'];
                $this->arrDBFields['token'] = $arrData['Device.token'];
                $this->arrDBFields['creDate'] = $arrData['Device.creDate'];
                $this->arrDBFields['inviteEmail'] = $arrData['Device.inviteEmail'];
                $this->arrDBFields['idOrg'] = $arrData['Device.idOrg'];
                //Foregin Key
                if ((array_key_exists('Org.idOrg', $arrData)) && (!is_null($arrData['Org.idOrg']))) {
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
        $arrFields[] = 'Device.idDevice ' . (($blnLongSelect) ? ' as "Device.idDevice"' : '');
        $arrFields[] = 'Device.name ' . (($blnLongSelect) ? ' as "Device.name"' : '');
        $arrFields[] = 'Device.token ' . (($blnLongSelect) ? ' as "Device.token"' : '');
        $arrFields[] = 'Device.creDate ' . (($blnLongSelect) ? ' as "Device.creDate"' : '');
        $arrFields[] = 'Device.inviteEmail ' . (($blnLongSelect) ? ' as "Device.inviteEmail"' : '');
        $arrFields[] = 'Device.idOrg ' . (($blnLongSelect) ? ' as "Device.idOrg"' : '');
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
                        $strJoin.= ' LEFT JOIN Org ON Device.idOrg = Org.idOrg';
                    break;
                }
            }
        }
        $sql = sprintf("SELECT %s FROM Device %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Device();
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
        $sql = sprintf("SELECT Device.* FROM Device %s;", $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    public function GetAssignmentArr($strExtra = '') {
        return Assignment::Query('WHERE Assignment_rel.idDevice = ' . $this->idDevice . ' ' . $strExtra);
    }
    public function GetAssignmentArrBySession($objSession, $strExtra = '') {
        return Assignment::GetArrByDeviceAndSession($this, $objSession, $strExtra);
    }
    public function CreateAssignmentFromSession($objSession) {
        $objAssignment = new Assignment();
        $objAssignment->IdDevice = $this->IdDevice;
        $objAssignment->IdSession = $objSession->IdSession;
        //$objAssignment->Save();
        return $objAssignment;
    }
    //Load by foregin key
    public static function LoadCollByIdOrg($intIdOrg) {
        $sql = sprintf("SELECT Device.* FROM Device WHERE idOrg = %s;", $intIdOrg);
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
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Device.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Device.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
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
    public function __toString() {
        return 'Device(' . $this->getId() . ')';
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
    public function __set($strName, $mixValue) {
        $this->modified = 1;
        switch ($strName) {
            case ('IdDevice'):
            case ('idDevice'):
                $this->arrDBFields['idDevice'] = $mixValue;
            break;
            case ('Name'):
            case ('name'):
            case ('_Name'):
                $this->arrDBFields['name'] = $mixValue;
            break;
            case ('Token'):
            case ('token'):
            case ('_Token'):
                $this->arrDBFields['token'] = $mixValue;
            break;
            case ('CreDate'):
            case ('creDate'):
            case ('_CreDate'):
                $this->arrDBFields['creDate'] = $mixValue;
            break;
            case ('InviteEmail'):
            case ('inviteEmail'):
            case ('_InviteEmail'):
                $this->arrDBFields['inviteEmail'] = $mixValue;
            break;
            case ('IdOrg'):
            case ('idOrg'):
                $this->arrDBFields['idOrg'] = $mixValue;
                $this->objIdOrg = null;
            break;
            case ('IdOrgObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof Org)))) {
                    throw new MLCWrongTypeException('__set', $strName);
                }
                if (!is_null($mixValue)) {
                    $this->arrDBFields['idOrg'] = $mixValue->idOrg;
                } else {
                    $this->arrDBFields['idOrg'] = null;
                }
                $this->objIdOrg = $mixValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>