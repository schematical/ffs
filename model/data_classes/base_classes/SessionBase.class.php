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
* - SessionBase extends MLCBaseEntity
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
class SessionBase extends MLCBaseEntity {
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
            if ((array_key_exists('Session.idSession', $arrData))) {
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
                if ((array_key_exists('Competition.idCompetition', $arrData)) && (!is_null($arrData['Competition.idCompetition']))) {
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
    public static function Query($strExtra, $mixReturnSingle = false, $arrJoins = null) {
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
                        $strJoin.= ' LEFT JOIN Competition ON Session.idCompetition = Competition.idCompetition';
                    break;
                }
            }
        }
        $strSql = sprintf("SELECT %s FROM Session %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('Session');
        }
        $collReturn->AddQueryToHistory($strSql);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Session();
            $tObj->Materilize($data);
            $collReturn[] = $tObj;
        }
        //$collReturn = $coll->getCollection();
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
    public static function QueryCount($strExtra = '') {
        $strSql = sprintf("SELECT Session.* FROM Session %s;", $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
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
        $strSql = sprintf("SELECT Session.* FROM Session WHERE idCompetition = %s;", $intIdCompetition);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
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
        $collReturn = array();
        $collReturn['_ClassName'] = "Session %>";
        $collReturn['idSession'] = $this->idSession;
        $collReturn['startDate'] = $this->startDate;
        $collReturn['endDate'] = $this->endDate;
        $collReturn['idCompetition'] = $this->idCompetition;
        $collReturn['name'] = $this->name;
        $collReturn['notes'] = $this->notes;
        $collReturn['data'] = $this->data;
        $collReturn['equipmentSet'] = $this->equipmentSet;
        $collReturn['eventData'] = $this->eventData;
        return $collReturn;
    }
    public function __toString() {
        return 'Session(' . $this->getId() . ')';
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
    public function __set($strName, $mixValue) {
        $this->modified = 1;
        switch ($strName) {
            case ('IdSession'):
            case ('idSession'):
                $this->arrDBFields['idSession'] = $mixValue;
            break;
            case ('StartDate'):
            case ('startDate'):
            case ('_StartDate'):
                $this->arrDBFields['startDate'] = $mixValue;
            break;
            case ('EndDate'):
            case ('endDate'):
            case ('_EndDate'):
                $this->arrDBFields['endDate'] = $mixValue;
            break;
            case ('IdCompetition'):
            case ('idCompetition'):
                $this->arrDBFields['idCompetition'] = $mixValue;
                $this->objIdCompetition = null;
            break;
            case ('Name'):
            case ('name'):
            case ('_Name'):
                $this->arrDBFields['name'] = $mixValue;
            break;
            case ('Notes'):
            case ('notes'):
            case ('_Notes'):
                $this->arrDBFields['notes'] = $mixValue;
            break;
            case ('_Data'):
                $this->arrDBFields['data'] = $mixValue;
            break;
            case ('EquipmentSet'):
            case ('equipmentSet'):
            case ('_EquipmentSet'):
                $this->arrDBFields['equipmentSet'] = $mixValue;
            break;
            case ('_EventData'):
                $this->arrDBFields['eventData'] = $mixValue;
            break;
            case ('IdCompetitionObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof Competition)))) {
                    throw new MLCWrongTypeException('__set', $strName);
                }
                if (!is_null($mixValue)) {
                    $this->arrDBFields['idCompetition'] = $mixValue->idCompetition;
                } else {
                    $this->arrDBFields['idCompetition'] = null;
                }
                $this->objIdCompetition = $mixValue;
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