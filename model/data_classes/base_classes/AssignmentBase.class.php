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
* - LoadCollByIdDevice()
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
* - AssignmentBase extends BaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdAssignment
 * @property-write mixed $IdAssignment
 * @property-read mixed $IdDevice
 * @property-write mixed $IdDevice
 * @property-read mixed $IdSession
 * @property-write mixed $IdSession
 * @property-read mixed $Event
 * @property-write mixed $Event
 * @property-read mixed $Apartatus
 * @property-write mixed $Apartatus
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $IdUser
 * @property-write mixed $IdUser
 * @property-read mixed $RevokeDate
 * @property-write mixed $RevokeDate
 * @property-read Assignment $IdDeviceObject
 * @property-read Assignment $IdSessionObject
 */
class AssignmentBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Assignment_rel';
    const P_KEY = 'idAssignment';
    protected $objIdDevice = null;
    protected $objIdSession = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE Assignment_rel.idAssignment = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = new BaseEntityCollection(self::Query(''));
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<Assignment>";
        $xmlStr.= "<idAssignment>";
        $xmlStr.= $this->idAssignment;
        $xmlStr.= "</idAssignment>";
        $xmlStr.= "<idDevice>";
        $xmlStr.= $this->idDevice;
        $xmlStr.= "</idDevice>";
        $xmlStr.= "<idSession>";
        $xmlStr.= $this->idSession;
        $xmlStr.= "</idSession>";
        $xmlStr.= "<event>";
        $xmlStr.= $this->event;
        $xmlStr.= "</event>";
        $xmlStr.= "<apartatus>";
        $xmlStr.= $this->apartatus;
        $xmlStr.= "</apartatus>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<idUser>";
        $xmlStr.= $this->idUser;
        $xmlStr.= "</idUser>";
        $xmlStr.= "<revokeDate>";
        $xmlStr.= $this->revokeDate;
        $xmlStr.= "</revokeDate>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</Assignment>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if (array_key_exists('Assignment_rel.idAssignment', $arrData)) {
                //New Smart Way
                $this->arrDBFields['idAssignment'] = $arrData['Assignment_rel.idAssignment'];
                $this->arrDBFields['idDevice'] = $arrData['Assignment_rel.idDevice'];
                $this->arrDBFields['idSession'] = $arrData['Assignment_rel.idSession'];
                $this->arrDBFields['event'] = $arrData['Assignment_rel.event'];
                $this->arrDBFields['apartatus'] = $arrData['Assignment_rel.apartatus'];
                $this->arrDBFields['creDate'] = $arrData['Assignment_rel.creDate'];
                $this->arrDBFields['idUser'] = $arrData['Assignment_rel.idUser'];
                $this->arrDBFields['revokeDate'] = $arrData['Assignment_rel.revokeDate'];
                //Foregin Key
                if (array_key_exists('Device.idDevice', $arrData)) {
                    $this->objIdSession = new Device();
                    $this->objIdSession->Materilize($arrData);
                }
                if (array_key_exists('Session.idSession', $arrData)) {
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
        $arrFields[] = 'Assignment_rel.idAssignment ' . (($blnLongSelect) ? ' as "Assignment_rel.idAssignment"' : '');
        $arrFields[] = 'Assignment_rel.idDevice ' . (($blnLongSelect) ? ' as "Assignment_rel.idDevice"' : '');
        $arrFields[] = 'Assignment_rel.idSession ' . (($blnLongSelect) ? ' as "Assignment_rel.idSession"' : '');
        $arrFields[] = 'Assignment_rel.event ' . (($blnLongSelect) ? ' as "Assignment_rel.event"' : '');
        $arrFields[] = 'Assignment_rel.apartatus ' . (($blnLongSelect) ? ' as "Assignment_rel.apartatus"' : '');
        $arrFields[] = 'Assignment_rel.creDate ' . (($blnLongSelect) ? ' as "Assignment_rel.creDate"' : '');
        $arrFields[] = 'Assignment_rel.idUser ' . (($blnLongSelect) ? ' as "Assignment_rel.idUser"' : '');
        $arrFields[] = 'Assignment_rel.revokeDate ' . (($blnLongSelect) ? ' as "Assignment_rel.revokeDate"' : '');
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
                    case ('Device'):
                        $strJoin.= ' JOIN Device ON Assignment_rel.idDevice = Device.idDevice';
                    break;
                    case ('Session'):
                        $strJoin.= ' JOIN Session ON Assignment_rel.idSession = Session.idSession';
                    break;
                }
            }
        }
        $sql = sprintf("SELECT %s FROM Assignment_rel %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Assignment();
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
        $sql = sprintf("SELECT Assignment_rel.* FROM Assignment_rel %s;", $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdDevice($intIdDevice) {
        $sql = sprintf("SELECT Assignment_rel.* FROM Assignment_rel WHERE idDevice = %s;", $intIdDevice);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objAssignment = new Assignment();
            $objAssignment->materilize($data);
            $coll->addItem($objAssignment);
        }
        return $coll;
    }
    public static function LoadCollByIdSession($intIdSession) {
        $sql = sprintf("SELECT Assignment_rel.* FROM Assignment_rel WHERE idSession = %s;", $intIdSession);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objAssignment = new Assignment();
            $objAssignment->materilize($data);
            $coll->addItem($objAssignment);
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
            return Assignment::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'Assignment')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdAssignment;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Assignment"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Assignment_rel.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Assignment_rel.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "Assignment %>";
        $arrReturn['idAssignment'] = $this->idAssignment;
        $arrReturn['idDevice'] = $this->idDevice;
        $arrReturn['idSession'] = $this->idSession;
        $arrReturn['event'] = $this->event;
        $arrReturn['apartatus'] = $this->apartatus;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['idUser'] = $this->idUser;
        $arrReturn['revokeDate'] = $this->revokeDate;
        return $arrReturn;
    }
    public function __toString() {
        return 'Assignment(' . $this->getId() . ')';
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
            case ('IdAssignment'):
            case ('idAssignment'):
                if (array_key_exists('idAssignment', $this->arrDBFields)) {
                    return $this->arrDBFields['idAssignment'];
                }
                return null;
            break;
            case ('IdDevice'):
            case ('idDevice'):
                if (array_key_exists('idDevice', $this->arrDBFields)) {
                    return $this->arrDBFields['idDevice'];
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
            case ('Event'):
            case ('event'):
                if (array_key_exists('event', $this->arrDBFields)) {
                    return $this->arrDBFields['event'];
                }
                return null;
            break;
            case ('Apartatus'):
            case ('apartatus'):
                if (array_key_exists('apartatus', $this->arrDBFields)) {
                    return $this->arrDBFields['apartatus'];
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
            case ('RevokeDate'):
            case ('revokeDate'):
                if (array_key_exists('revokeDate', $this->arrDBFields)) {
                    return $this->arrDBFields['revokeDate'];
                }
                return null;
            break;
            case ('IdDeviceObject'):
                if (!is_null($this->objIdDevice)) {
                    return $this->objIdDevice;
                }
                if ((array_key_exists('idDevice', $this->arrDBFields)) && (!is_null($this->arrDBFields['idDevice']))) {
                    $this->objIdDevice = Device::LoadById($this->arrDBFields['idDevice']);
                    return $this->objIdDevice;
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
    public function __set($strName, $strValue) {
        $this->modified = 1;
        switch ($strName) {
            case ('IdAssignment'):
            case ('idAssignment'):
                $this->arrDBFields['idAssignment'] = $strValue;
            break;
            case ('IdDevice'):
            case ('idDevice'):
                $this->arrDBFields['idDevice'] = $strValue;
                $this->objDevice = null;
            break;
            case ('IdSession'):
            case ('idSession'):
                $this->arrDBFields['idSession'] = $strValue;
                $this->objSession = null;
            break;
            case ('Event'):
            case ('event'):
                $this->arrDBFields['event'] = $strValue;
            break;
            case ('Apartatus'):
            case ('apartatus'):
                $this->arrDBFields['apartatus'] = $strValue;
            break;
            case ('CreDate'):
            case ('creDate'):
                $this->arrDBFields['creDate'] = $strValue;
            break;
            case ('IdUser'):
            case ('idUser'):
                $this->arrDBFields['idUser'] = $strValue;
            break;
            case ('RevokeDate'):
            case ('revokeDate'):
                $this->arrDBFields['revokeDate'] = $strValue;
            break;
            case ('IdDeviceObject'):
                $this->arrDBFields['idDevice'] = $strValue->idDevice;
                $this->objIdDevice = $strValue;
            break;
            case ('IdSessionObject'):
                $this->arrDBFields['idSession'] = $strValue->idSession;
                $this->objIdSession = $strValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>