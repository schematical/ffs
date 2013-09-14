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
* - GetEnrollmentArr()
* - GetEnrollmentArrByAthelete()
* - CreateEnrollmentFromAthelete()
* - GetEnrollmentArrBySession()
* - CreateEnrollmentFromSession()
* - GetOrgCompetitionArr()
* - GetOrgCompetitionArrByOrg()
* - CreateOrgCompetitionFromOrg()
* - GetParentMessageArr()
* - GetSessionArr()
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
* - Data()
* Classes list:
* - CompetitionBase extends MLCBaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdCompetition
 * @property-write mixed $IdCompetition
 * @property-read mixed $Name
 * @property-write mixed $Name
 * @property-read mixed $LongDesc
 * @property-write mixed $LongDesc
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $StartDate
 * @property-write mixed $StartDate
 * @property-read mixed $EndDate
 * @property-write mixed $EndDate
 * @property-read mixed $IdOrg
 * @property-write mixed $IdOrg
 * @property-read mixed $Namespace
 * @property-write mixed $Namespace
 * @property-read mixed $SignupCutOffDate
 * @property-write mixed $SignupCutOffDate
 * @property-read mixed $ClubType
 * @property-write mixed $ClubType
 * @property-read Competition $IdOrgObject
 */
class CompetitionBase extends MLCBaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Competition';
    const P_KEY = 'idCompetition';
    protected $objIdOrg = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE Competition.idCompetition = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = new BaseEntityCollection(self::Query(''));
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<Competition>";
        $xmlStr.= "<idCompetition>";
        $xmlStr.= $this->idCompetition;
        $xmlStr.= "</idCompetition>";
        $xmlStr.= "<name>";
        $xmlStr.= $this->name;
        $xmlStr.= "</name>";
        $xmlStr.= "<longDesc>";
        $xmlStr.= $this->longDesc;
        $xmlStr.= "</longDesc>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<startDate>";
        $xmlStr.= $this->startDate;
        $xmlStr.= "</startDate>";
        $xmlStr.= "<endDate>";
        $xmlStr.= $this->endDate;
        $xmlStr.= "</endDate>";
        $xmlStr.= "<idOrg>";
        $xmlStr.= $this->idOrg;
        $xmlStr.= "</idOrg>";
        $xmlStr.= "<namespace>";
        $xmlStr.= $this->namespace;
        $xmlStr.= "</namespace>";
        $xmlStr.= "<signupCutOffDate>";
        $xmlStr.= $this->signupCutOffDate;
        $xmlStr.= "</signupCutOffDate>";
        $xmlStr.= "<clubType>";
        $xmlStr.= $this->clubType;
        $xmlStr.= "</clubType>";
        $xmlStr.= "<data>";
        $xmlStr.= $this->data;
        $xmlStr.= "</data>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</Competition>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('Competition.idCompetition', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idCompetition'] = $arrData['Competition.idCompetition'];
                $this->arrDBFields['name'] = $arrData['Competition.name'];
                $this->arrDBFields['longDesc'] = $arrData['Competition.longDesc'];
                $this->arrDBFields['creDate'] = $arrData['Competition.creDate'];
                $this->arrDBFields['startDate'] = $arrData['Competition.startDate'];
                $this->arrDBFields['endDate'] = $arrData['Competition.endDate'];
                $this->arrDBFields['idOrg'] = $arrData['Competition.idOrg'];
                $this->arrDBFields['namespace'] = $arrData['Competition.namespace'];
                $this->arrDBFields['signupCutOffDate'] = $arrData['Competition.signupCutOffDate'];
                $this->arrDBFields['clubType'] = $arrData['Competition.clubType'];
                $this->arrDBFields['data'] = $arrData['Competition.data'];
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
        $arrFields[] = 'Competition.idCompetition ' . (($blnLongSelect) ? ' as "Competition.idCompetition"' : '');
        $arrFields[] = 'Competition.name ' . (($blnLongSelect) ? ' as "Competition.name"' : '');
        $arrFields[] = 'Competition.longDesc ' . (($blnLongSelect) ? ' as "Competition.longDesc"' : '');
        $arrFields[] = 'Competition.creDate ' . (($blnLongSelect) ? ' as "Competition.creDate"' : '');
        $arrFields[] = 'Competition.startDate ' . (($blnLongSelect) ? ' as "Competition.startDate"' : '');
        $arrFields[] = 'Competition.endDate ' . (($blnLongSelect) ? ' as "Competition.endDate"' : '');
        $arrFields[] = 'Competition.idOrg ' . (($blnLongSelect) ? ' as "Competition.idOrg"' : '');
        $arrFields[] = 'Competition.namespace ' . (($blnLongSelect) ? ' as "Competition.namespace"' : '');
        $arrFields[] = 'Competition.signupCutOffDate ' . (($blnLongSelect) ? ' as "Competition.signupCutOffDate"' : '');
        $arrFields[] = 'Competition.clubType ' . (($blnLongSelect) ? ' as "Competition.clubType"' : '');
        $arrFields[] = 'Competition.data ' . (($blnLongSelect) ? ' as "Competition.data"' : '');
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
                    case ('Org'):
                        $strJoin.= ' LEFT JOIN Org ON Competition.idOrg = Org.idOrg';
                    break;
                }
            }
        }
        if (!is_null($strExtra)) {
            $strSql = sprintf("SELECT %s FROM Competition %s %s;", $strFields, $strJoin, $strExtra);
            $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        }
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('Competition');
        }
        if (!is_null($strExtra)) {
            $collReturn->AddQueryToHistory($strSql);
            while ($data = mysql_fetch_assoc($result)) {
                $tObj = new Competition();
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
                    case ('Org'):
                        $strJoin.= ' LEFT JOIN Org ON Competition.idOrg = Org.idOrg';
                    break;
                }
            }
        }
        $strSql = sprintf("SELECT %s FROM Competition %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    public function GetEnrollmentArr($strExtra = '') {
        return Enrollment::Query('WHERE Enrollment_rel.idCompetition = ' . $this->idCompetition . ' ' . $strExtra);
    }
    public function GetEnrollmentArrByAthelete($objAthelete, $strExtra = '') {
        return Enrollment::GetArrByCompetitionAndAthelete($this, $objAthelete, $strExtra);
    }
    public function CreateEnrollmentFromAthelete($objAthelete) {
        $objEnrollment = new Enrollment();
        $objEnrollment->IdCompetition = $this->IdCompetition;
        $objEnrollment->IdAthelete = $objAthelete->IdAthelete;
        //$objEnrollment->Save();
        return $objEnrollment;
    }
    public function GetEnrollmentArrBySession($objSession, $strExtra = '') {
        return Enrollment::GetArrByCompetitionAndSession($this, $objSession, $strExtra);
    }
    public function CreateEnrollmentFromSession($objSession) {
        $objEnrollment = new Enrollment();
        $objEnrollment->IdCompetition = $this->IdCompetition;
        $objEnrollment->IdSession = $objSession->IdSession;
        //$objEnrollment->Save();
        return $objEnrollment;
    }
    public function GetOrgCompetitionArr($strExtra = '') {
        return OrgCompetition::Query('WHERE OrgCompetition_rel.idCompetition = ' . $this->idCompetition . ' ' . $strExtra);
    }
    public function GetOrgCompetitionArrByOrg($objOrg, $strExtra = '') {
        return OrgCompetition::GetArrByCompetitionAndOrg($this, $objOrg, $strExtra);
    }
    public function CreateOrgCompetitionFromOrg($objOrg) {
        $objOrgCompetition = new OrgCompetition();
        $objOrgCompetition->IdCompetition = $this->IdCompetition;
        $objOrgCompetition->IdOrg = $objOrg->IdOrg;
        //$objOrgCompetition->Save();
        return $objOrgCompetition;
    }
    public function GetParentMessageArr() {
        return ParentMessage::LoadCollByIdCompetition($this->idCompetition)->getCollection();
    }
    public function GetSessionArr() {
        return Session::LoadCollByIdCompetition($this->idCompetition)->getCollection();
    }
    //Load by foregin key
    public static function LoadCollByIdOrg($intIdOrg) {
        $strSql = sprintf("SELECT Competition.* FROM Competition WHERE idOrg = %s;", $intIdOrg);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objCompetition = new Competition();
            $objCompetition->materilize($data);
            $coll->addItem($objCompetition);
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
        if (array_key_exists('idcompetition', $arrData)) {
            $this->intIdCompetition = $arrData['idcompetition'];
        }
        if (array_key_exists('idcompetition', $arrData)) {
            $this->intIdCompetition = $arrData['idcompetition'];
        }
        if (array_key_exists('idcompetition', $arrData)) {
            $this->intIdCompetition = $arrData['idcompetition'];
        }
        if (array_key_exists('idcompetition', $arrData)) {
            $this->intIdCompetition = $arrData['idcompetition'];
        }
    }
    public static function Parse($mixData, $blnReturnId = false) {
        if (is_numeric($mixData)) {
            if ($blnReturnId) {
                return $mixData;
            }
            return Competition::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'Competition')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdCompetition;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Competition"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Competition.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE Competition.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $collReturn = array();
        $collReturn['_ClassName'] = "Competition %>";
        $collReturn['idCompetition'] = $this->idCompetition;
        $collReturn['name'] = $this->name;
        $collReturn['longDesc'] = $this->longDesc;
        $collReturn['creDate'] = $this->creDate;
        $collReturn['startDate'] = $this->startDate;
        $collReturn['endDate'] = $this->endDate;
        $collReturn['idOrg'] = $this->idOrg;
        $collReturn['namespace'] = $this->namespace;
        $collReturn['signupCutOffDate'] = $this->signupCutOffDate;
        $collReturn['clubType'] = $this->clubType;
        $collReturn['data'] = $this->data;
        return $collReturn;
    }
    public function __toString() {
        return 'Competition(' . $this->getId() . ')';
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
            case ('LongDesc'):
            case ('longDesc'):
                if (array_key_exists('longDesc', $this->arrDBFields)) {
                    return $this->arrDBFields['longDesc'];
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
            case ('IdOrg'):
            case ('idOrg'):
                if (array_key_exists('idOrg', $this->arrDBFields)) {
                    return $this->arrDBFields['idOrg'];
                }
                return null;
            break;
            case ('Namespace'):
            case ('namespace'):
                if (array_key_exists('namespace', $this->arrDBFields)) {
                    return $this->arrDBFields['namespace'];
                }
                return null;
            break;
            case ('SignupCutOffDate'):
            case ('signupCutOffDate'):
                if (array_key_exists('signupCutOffDate', $this->arrDBFields)) {
                    return $this->arrDBFields['signupCutOffDate'];
                }
                return null;
            break;
            case ('ClubType'):
            case ('clubType'):
                if (array_key_exists('clubType', $this->arrDBFields)) {
                    return $this->arrDBFields['clubType'];
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
            case ('IdCompetition'):
            case ('idCompetition'):
                $this->arrDBFields['idCompetition'] = $mixValue;
            break;
            case ('Name'):
            case ('name'):
            case ('_Name'):
                $this->arrDBFields['name'] = $mixValue;
            break;
            case ('LongDesc'):
            case ('longDesc'):
            case ('_LongDesc'):
                $this->arrDBFields['longDesc'] = $mixValue;
            break;
            case ('CreDate'):
            case ('creDate'):
            case ('_CreDate'):
                $this->arrDBFields['creDate'] = $mixValue;
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
            case ('IdOrg'):
            case ('idOrg'):
                $this->arrDBFields['idOrg'] = $mixValue;
                $this->objIdOrg = null;
            break;
            case ('Namespace'):
            case ('namespace'):
            case ('_Namespace'):
                $this->arrDBFields['namespace'] = $mixValue;
            break;
            case ('SignupCutOffDate'):
            case ('signupCutOffDate'):
            case ('_SignupCutOffDate'):
                $this->arrDBFields['signupCutOffDate'] = $mixValue;
            break;
            case ('ClubType'):
            case ('clubType'):
            case ('_ClubType'):
                $this->arrDBFields['clubType'] = $mixValue;
            break;
            case ('_Data'):
                $this->arrDBFields['data'] = $mixValue;
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