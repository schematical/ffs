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
* Classes list:
* - MLCBatchBase extends MLCBaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdBatch
 * @property-write mixed $IdBatch
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $JobName
 * @property-write mixed $JobName
 * @property-read mixed $Report
 * @property-write mixed $Report
 * @property-read mixed $IdBatchStatus
 * @property-write mixed $IdBatchStatus
 */
class MLCBatchBase extends MLCBaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'MLCBatch';
    const P_KEY = 'idBatch';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE MLCBatch.idBatch = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = self::Query('');
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<MLCBatch>";
        $xmlStr.= "<idBatch>";
        $xmlStr.= $this->idBatch;
        $xmlStr.= "</idBatch>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<jobName>";
        $xmlStr.= $this->jobName;
        $xmlStr.= "</jobName>";
        $xmlStr.= "<report>";
        $xmlStr.= $this->report;
        $xmlStr.= "</report>";
        $xmlStr.= "<idBatchStatus>";
        $xmlStr.= $this->idBatchStatus;
        $xmlStr.= "</idBatchStatus>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</MLCBatch>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('MLCBatch.idBatch', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idBatch'] = $arrData['MLCBatch.idBatch'];
                $this->arrDBFields['creDate'] = $arrData['MLCBatch.creDate'];
                $this->arrDBFields['jobName'] = $arrData['MLCBatch.jobName'];
                $this->arrDBFields['report'] = $arrData['MLCBatch.report'];
                $this->arrDBFields['idBatchStatus'] = $arrData['MLCBatch.idBatchStatus'];
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
        $arrFields[] = 'MLCBatch.idBatch ' . (($blnLongSelect) ? ' as "MLCBatch.idBatch"' : '');
        $arrFields[] = 'MLCBatch.creDate ' . (($blnLongSelect) ? ' as "MLCBatch.creDate"' : '');
        $arrFields[] = 'MLCBatch.jobName ' . (($blnLongSelect) ? ' as "MLCBatch.jobName"' : '');
        $arrFields[] = 'MLCBatch.report ' . (($blnLongSelect) ? ' as "MLCBatch.report"' : '');
        $arrFields[] = 'MLCBatch.idBatchStatus ' . (($blnLongSelect) ? ' as "MLCBatch.idBatchStatus"' : '');
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
            $strSql = sprintf("SELECT %s FROM MLCBatch %s %s;", $strFields, $strJoin, $strExtra);
            $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        }
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('MLCBatch');
        }
        if (!is_null($strExtra)) {
            $collReturn->AddQueryToHistory($strSql);
            while ($data = mysql_fetch_assoc($result)) {
                $tObj = new MLCBatch();
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
        $strSql = sprintf("SELECT %s FROM MLCBatch %s %s;", $strFields, $strJoin, $strExtra);
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
            return MLCBatch::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'MLCBatch')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdBatch;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "MLCBatch"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE MLCBatch.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE MLCBatch.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $collReturn = array();
        $collReturn['_ClassName'] = "MLCBatch %>";
        $collReturn['idBatch'] = $this->idBatch;
        $collReturn['creDate'] = $this->creDate;
        $collReturn['jobName'] = $this->jobName;
        $collReturn['report'] = $this->report;
        $collReturn['idBatchStatus'] = $this->idBatchStatus;
        return $collReturn;
    }
    public function __toString() {
        return 'MLCBatch(' . $this->getId() . ')';
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
            case ('IdBatch'):
            case ('idBatch'):
                if (array_key_exists('idBatch', $this->arrDBFields)) {
                    return $this->arrDBFields['idBatch'];
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
            case ('JobName'):
            case ('jobName'):
                if (array_key_exists('jobName', $this->arrDBFields)) {
                    return $this->arrDBFields['jobName'];
                }
                return null;
            break;
            case ('Report'):
            case ('report'):
                if (array_key_exists('report', $this->arrDBFields)) {
                    return $this->arrDBFields['report'];
                }
                return null;
            break;
            case ('IdBatchStatus'):
            case ('idBatchStatus'):
                if (array_key_exists('idBatchStatus', $this->arrDBFields)) {
                    return $this->arrDBFields['idBatchStatus'];
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
            case ('IdBatch'):
            case ('idBatch'):
                $this->arrDBFields['idBatch'] = $mixValue;
            break;
            case ('CreDate'):
            case ('creDate'):
            case ('_CreDate'):
                $this->arrDBFields['creDate'] = $mixValue;
            break;
            case ('JobName'):
            case ('jobName'):
            case ('_JobName'):
                $this->arrDBFields['jobName'] = $mixValue;
            break;
            case ('Report'):
            case ('report'):
            case ('_Report'):
                $this->arrDBFields['report'] = $mixValue;
            break;
            case ('IdBatchStatus'):
            case ('idBatchStatus'):
                $this->arrDBFields['idBatchStatus'] = $mixValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>