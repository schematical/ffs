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
* - GetAssignmentArrByDevice()
* - CreateAssignmentFromDevice()
* - GetEnrollmentArr()
* - GetEnrollmentArrByAthelete()
* - CreateEnrollmentFromAthelete()
* - GetEnrollmentArrByCompetition()
* - CreateEnrollmentFromCompetition()
* - GetResultArr()
* - LoadCollByIdCompetition()
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
* - EventData()
* Classes list:
* - SessionBase extends BaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdSession
 * @property-write mixed $IdSession
 * @property-read mixed $StartDate
 * @property-write mixed $StartDate
 * @property-read mixed $EndDate
 * @property-write mixed $EndDate
 * @property-read mixed $IdCompetition
 * @property-write mixed $IdCompetition
 * @property-read mixed $Name
 * @property-write mixed $Name
 * @property-read mixed $Notes
 * @property-write mixed $Notes
 * @property-read mixed $EquipmentSet
 * @property-write mixed $EquipmentSet
 * @property-read Session $IdCompetitionObject
 */
class SessionBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Session';
    const P_KEY = 'idSession';
    protected $objIdCompetition = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE Session.idSession = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = new BaseEntityCollection(self::Query(''));
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<Session>";
        $xmlStr.= "<idSession>";
        $xmlStr.= $this->idSession;
        $xmlStr.= "</idSession>";
        $xmlStr.= "<startDate>";
        $xmlStr.= $this->startDate;
        $xmlStr.= "</startDate>";
        $xmlStr.= "<endDate>";
        $xmlStr.= $this->endDate;
        $xmlStr.= "</endDate>";
        $xmlStr.= "<idCompetition>";
        $xmlStr.= $this->idCompetition;
        $xmlStr.= "</idCompetition>";
        $xmlStr.= "<name>";
        $xmlStr.= $this->name;
        $xmlStr.= "</name>";
        $xmlStr.= "<notes>";
        $xmlStr.= $this->notes;
        $xmlStr.= "</notes>";
        $xmlStr.= "<data>";
        $xmlStr.= $this->data;
        $xmlStr.= "</data>";
        $xmlStr.= "<equipmentSet>";
        $xmlStr.= $this->equipmentSet;
        $xmlStr.= "</equipmentSet>";
        $xmlStr.= "<eventData>";
        $xmlStr.= $this->eventData;
        $xmlStr.= "</eventData>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</Session>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if (array_key_exists('Session.idSession', $arrData)) {
                //New Smart Way
                $this->arrDBFields['idSession'] = $arrData['Session.idSession'];
                $this->arrDBFields['startDate'] = $arrData['Session.startDate'];
                $this->arrDBFields['endDate'] = $arrData['Session.endDate'];
                $this->arrDBFields['idCompetition'] = $arrData['Session.idCompetition'];
                $this->arrDBFields['name'] = $arrData['Session.name'];
                $this->arrDBFields['notes'] = $arrData['Session.notes'];
                $this->arrDBFields['data'] = $arrData['Session.data'];
                $this->arrDBFields['equipmentSet'] = $arrData['Session.equipmentSet'];
                $this->arrDBFields['eventData'] = $arrData['Session.eventData'];
                //Foregin Key
                if (array_key_exists('Competition.idCompetition', $arrData)) {
                    $this->objIdCompetition = new Competition();
                    $this->objIdCompetition->Materilize($arrData);
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
        $arrFields[] = 'Session.idSession ' . (($blnLongSelect) ? ' as "Session.idSession"' : '');
        $arrFields[] = 'Session.startDate ' . (($blnLongSelect) ? ' as "Session.startDate"' : '');
        $arrFields[] = 'Session.endDate ' . (($blnLongSelect) ? ' as "Session.endDate"' : '');
        $arrFields[] = 'Session.idCompetition ' . (($blnLongSelect) ? ' as "Session.idCompetition"' : '');
        $arrFields[] = 'Session.name ' . (($blnLongSelect) ? ' as "Session.name"' : '');
        $arrFields[] = 'Session.notes ' . (($blnLongSelect) ? ' as "Session.notes"' : '');
        $arrFields[] = 'Session.data ' . (($blnLongSelect) ? ' as "Session.data"' : '');
        $arrFields[] = 'Session.equipmentSet ' . (($blnLongSelect) ? ' as "Session.equipmentSet"' : '');
        $arrFields[] = 'Session.eventData ' . (($blnLongSelect) ? ' as "Session.eventData"' : '');
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
                    case ('Competition'):
                        $strJoin.= ' JOIN Competition ON Session.idCompetition = Competition.idCompetition';
                    break;
                }
            }
        }
        $sql = sprintf("SELECT %s FROM Session %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Session();
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
        $sql = sprintf("SELECT Session.* FROM Session %s;", $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    public function GetAssignmentArr($strExtra = '') {
        return Assignment::Query('WHERE Assignment_rel.idSession = ' . $this->idSession . ' ' . $strExtra);
    }
    public function GetAssignmentArrByDevice($objDevice, $strExtra = '') {
        return Assignment::GetArrBySessionAndDevice($this, $objDevice, $strExtra);
    }
    public function CreateAssignmentFromDevice($objDevice) {
        $objAssignment = new Assignment();
        $objAssignment->IdSession = $this->IdSession;
        $objAssignment->IdDevice = $objDevice->IdDevice;
        //$objAssignment->Save();
        return $objAssignment;
    }
    public function GetEnrollmentArr($strExtra = '') {
        return Enrollment::Query('WHERE Enrollment_rel.idSession = ' . $this->idSession . ' ' . $strExtra);
    }
    public function GetEnrollmentArrByAthelete($objAthelete, $strExtra = '') {
        return Enrollment::GetArrBySessionAndAthelete($this, $objAthelete, $strExtra);
    }
    public function CreateEnrollmentFromAthelete($objAthelete) {
        $objEnrollment = new Enrollment();
        $objEnrollment->IdSession = $this->IdSession;
        $objEnrollment->IdAthelete = $objAthelete->IdAthelete;
        //$objEnrollment->Save();
        return $objEnrollment;
    }
    public function GetEnrollmentArrByCompetition($objCompetition, $strExtra = '') {
        return Enrollment::GetArrBySessionAndCompetition($this, $objCompetition, $strExtra);
    }
    public function CreateEnrollmentFromCompetition($objCompetition) {
        $objEnrollment = new Enrollment();
        $objEnrollment->IdSession = $this->IdSession;
        $objEnrollment->IdCompetition = $objCompetition->IdCompetition;
        //$objEnrollment->Save();
        return $objEnrollment;
    }
    public function GetResultArr() {
        return Result::LoadCollByIdSession($this->idSession)->getCollection();
    }
    //Load by foregin key
    public static function LoadCollByIdCompetition($intIdCompetition) {
        $sql = sprintf("SELECT Session.* FROM Session WHERE idCompetition = %s;", $intIdCompetition);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objSession = new Session();
            $objSession->materilize($data);
            $coll->addItem($objSession);
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
        if (array_key_exists('idsession', $arrData)) {
            $this->intIdSession = $arrData['idsession'];
        }
        if (array_key_exists('idsession', $arrData)) {
            $this->intIdSession = $arrData['idsession'];
        }
        if (array_key_exists('idsession', $arrData)) {
            $this->intIdSession = $arrData['idsession'];
        }
    }
    public static function Parse($mixData, $blnReturnId = false) {
        if (is_numeric($mixData)) {
            if ($blnReturnId) {
                return $mixData;
            }
            return Session::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'Session')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdSession;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Session"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Session.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Session.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "Session %>";
        $arrReturn['idSession'] = $this->idSession;
        $arrReturn['startDate'] = $this->startDate;
        $arrReturn['endDate'] = $this->endDate;
        $arrReturn['idCompetition'] = $this->idCompetition;
        $arrReturn['name'] = $this->name;
        $arrReturn['notes'] = $this->notes;
        $arrReturn['data'] = $this->data;
        $arrReturn['equipmentSet'] = $this->equipmentSet;
        $arrReturn['eventData'] = $this->eventData;
        return $arrReturn;
    }
    public function __toString() {
        return 'Session(' . $this->getId() . ')';
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
            case ('IdSession'):
            case ('idSession'):
                if (array_key_exists('idSession', $this->arrDBFields)) {
                    return $this->arrDBFields['idSession'];
                }
                return null;
            break;
            case ('StartDate'):
            case ('startDate'):
                if (array_key_exists('startDate', $this->arrDBFields)) {
                    return $this->arrDBFields['startDate'];
                }
                return null;
            break;
            case ('EndDate'):
            case ('endDate'):
                if (array_key_exists('endDate', $this->arrDBFields)) {
                    return $this->arrDBFields['endDate'];
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
            case ('Name'):
            case ('name'):
                if (array_key_exists('name', $this->arrDBFields)) {
                    return $this->arrDBFields['name'];
                }
                return null;
            break;
            case ('Notes'):
            case ('notes'):
                if (array_key_exists('notes', $this->arrDBFields)) {
                    return $this->arrDBFields['notes'];
                }
                return null;
            break;
            case ('EquipmentSet'):
            case ('equipmentSet'):
                if (array_key_exists('equipmentSet', $this->arrDBFields)) {
                    return $this->arrDBFields['equipmentSet'];
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
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
    public function __set($strName, $strValue) {
        $this->modified = 1;
        switch ($strName) {
            case ('IdSession'):
            case ('idSession'):
                $this->arrDBFields['idSession'] = $strValue;
            break;
            case ('StartDate'):
            case ('startDate'):
                $this->arrDBFields['startDate'] = $strValue;
            break;
            case ('EndDate'):
            case ('endDate'):
                $this->arrDBFields['endDate'] = $strValue;
            break;
            case ('IdCompetition'):
            case ('idCompetition'):
                $this->arrDBFields['idCompetition'] = $strValue;
                $this->objIdCompetition = null;
            break;
            case ('Name'):
            case ('name'):
                $this->arrDBFields['name'] = $strValue;
            break;
            case ('Notes'):
            case ('notes'):
                $this->arrDBFields['notes'] = $strValue;
            break;
            case ('EquipmentSet'):
            case ('equipmentSet'):
                $this->arrDBFields['equipmentSet'] = $strValue;
            break;
            case ('IdCompetitionObject'):
                $this->arrDBFields['idCompetition'] = $strValue->idCompetition;
                $this->objIdCompetition = $strValue;
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
    public function EventData($strKey, $mixData = null) {
        if (is_null($mixData)) {
            if ((!array_key_exists('eventData', $this->arrDBFields))) {
                return null;
            }
            if ((strlen($this->arrDBFields['eventData']) < 1)) {
                return null;
            }
            $arrData = json_decode($this->arrDBFields['eventData'], true);
            if (!array_key_exists($strKey, $arrData)) {
                return null;
            }
            return $arrData[$strKey];
        } else {
            if ((!array_key_exists('eventData', $this->arrDBFields)) || (strlen($this->arrDBFields['eventData']) < 1)) {
                $arrData = array();
            } else {
                $arrData = json_decode($this->arrDBFields['eventData'], true);
            }
            $arrData[$strKey] = $mixData;
            $this->arrDBFields['eventData'] = json_encode($arrData);
            $this->Save();
        }
    }
}
?>