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
* - AWSInstanceBase extends BaseEntity
*/
class AWSInstanceBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'AWSInstance';
    const P_KEY = 'idInstance';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idInstance = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new AWSInstance();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, AWSInstance::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new AWSInstance();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<AWSInstance>";
        $xmlStr.= "<idInstance>";
        $xmlStr.= $this->idInstance;
        $xmlStr.= "</idInstance>";
        $xmlStr.= "<awsId>";
        $xmlStr.= $this->awsId;
        $xmlStr.= "</awsId>";
        $xmlStr.= "<namespace>";
        $xmlStr.= $this->namespace;
        $xmlStr.= "</namespace>";
        $xmlStr.= "<dns>";
        $xmlStr.= $this->dns;
        $xmlStr.= "</dns>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<idAccount>";
        $xmlStr.= $this->idAccount;
        $xmlStr.= "</idAccount>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</AWSInstance>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new AWSInstance();
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
            return AWSInstance::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'AWSInstance')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdInstance;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . '->Parse - Parameter 1 must be either an intiger or a class type "AWSInstance"');
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
            $tObj = new AWSInstance();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "AWSInstance";
        $arrReturn['idInstance'] = $this->idInstance;
        $arrReturn['awsId'] = $this->awsId;
        $arrReturn['namespace'] = $this->namespace;
        $arrReturn['dns'] = $this->dns;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['idAccount'] = $this->idAccount;
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
            case ('IdInstance'):
            case ('idInstance'):
                if (array_key_exists('idInstance', $this->arrDBFields)) {
                    return $this->arrDBFields['idInstance'];
                }
                return null;
            break;
            case ('AwsId'):
            case ('awsId'):
                if (array_key_exists('awsId', $this->arrDBFields)) {
                    return $this->arrDBFields['awsId'];
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
            case ('Dns'):
            case ('dns'):
                if (array_key_exists('dns', $this->arrDBFields)) {
                    return $this->arrDBFields['dns'];
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
            case ('IdAccount'):
            case ('idAccount'):
                if (array_key_exists('idAccount', $this->arrDBFields)) {
                    return $this->arrDBFields['idAccount'];
                }
                return null;
            break;
                defualt:
                    throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
                break;
            }
        }
        public function __set($strName, $strValue) {
            $this->modified = 1;
            switch ($strName) {
                case ('IdInstance'):
                case ('idInstance'):
                    $this->arrDBFields['idInstance'] = $strValue;
                break;
                case ('AwsId'):
                case ('awsId'):
                    $this->arrDBFields['awsId'] = $strValue;
                break;
                case ('Namespace'):
                case ('namespace'):
                    $this->arrDBFields['namespace'] = $strValue;
                break;
                case ('Dns'):
                case ('dns'):
                    $this->arrDBFields['dns'] = $strValue;
                break;
                case ('CreDate'):
                case ('creDate'):
                    $this->arrDBFields['creDate'] = $strValue;
                break;
                case ('IdAccount'):
                case ('idAccount'):
                    $this->arrDBFields['idAccount'] = $strValue;
                break;
                    defualt:
                        throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
                    break;
                }
            }
        }
?>