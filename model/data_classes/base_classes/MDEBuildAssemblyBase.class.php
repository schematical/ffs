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
* - MDEBuildAssemblyBase extends BaseEntity
*/
class MDEBuildAssemblyBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'MDEBuildAssembly';
    const P_KEY = 'idBuildAssembly';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idBuildAssembly = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEBuildAssembly();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, MDEBuildAssembly::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEBuildAssembly();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<MDEBuildAssembly>";
        $xmlStr.= "<idBuildAssembly>";
        $xmlStr.= $this->idBuildAssembly;
        $xmlStr.= "</idBuildAssembly>";
        $xmlStr.= "<shortDesc>";
        $xmlStr.= $this->shortDesc;
        $xmlStr.= "</shortDesc>";
        $xmlStr.= "<idAccount>";
        $xmlStr.= $this->idAccount;
        $xmlStr.= "</idAccount>";
        $xmlStr.= "<longDesc>";
        $xmlStr.= $this->longDesc;
        $xmlStr.= "</longDesc>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<idAsset>";
        $xmlStr.= $this->idAsset;
        $xmlStr.= "</idAsset>";
        $xmlStr.= "<featured>";
        $xmlStr.= $this->featured;
        $xmlStr.= "</featured>";
        $xmlStr.= "<idAppBase>";
        $xmlStr.= $this->idAppBase;
        $xmlStr.= "</idAppBase>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</MDEBuildAssembly>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEBuildAssembly();
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
            return MDEBuildAssembly::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'MDEBuildAssembly')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdBuildAssembly;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . '->Parse - Parameter 1 must be either an intiger or a class type "MDEBuildAssembly"');
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
            $tObj = new MDEBuildAssembly();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "MDEBuildAssembly";
        $arrReturn['idBuildAssembly'] = $this->idBuildAssembly;
        $arrReturn['shortDesc'] = $this->shortDesc;
        $arrReturn['idAccount'] = $this->idAccount;
        $arrReturn['longDesc'] = $this->longDesc;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['idAsset'] = $this->idAsset;
        $arrReturn['featured'] = $this->featured;
        $arrReturn['idAppBase'] = $this->idAppBase;
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
            case ('IdBuildAssembly'):
            case ('idBuildAssembly'):
                if (array_key_exists('idBuildAssembly', $this->arrDBFields)) {
                    return $this->arrDBFields['idBuildAssembly'];
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
            case ('IdAccount'):
            case ('idAccount'):
                if (array_key_exists('idAccount', $this->arrDBFields)) {
                    return $this->arrDBFields['idAccount'];
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
            case ('IdAsset'):
            case ('idAsset'):
                if (array_key_exists('idAsset', $this->arrDBFields)) {
                    return $this->arrDBFields['idAsset'];
                }
                return null;
            break;
            case ('Featured'):
            case ('featured'):
                if (array_key_exists('featured', $this->arrDBFields)) {
                    return $this->arrDBFields['featured'];
                }
                return null;
            break;
            case ('IdAppBase'):
            case ('idAppBase'):
                if (array_key_exists('idAppBase', $this->arrDBFields)) {
                    return $this->arrDBFields['idAppBase'];
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
                case ('IdBuildAssembly'):
                case ('idBuildAssembly'):
                    $this->arrDBFields['idBuildAssembly'] = $strValue;
                break;
                case ('ShortDesc'):
                case ('shortDesc'):
                    $this->arrDBFields['shortDesc'] = $strValue;
                break;
                case ('IdAccount'):
                case ('idAccount'):
                    $this->arrDBFields['idAccount'] = $strValue;
                break;
                case ('LongDesc'):
                case ('longDesc'):
                    $this->arrDBFields['longDesc'] = $strValue;
                break;
                case ('CreDate'):
                case ('creDate'):
                    $this->arrDBFields['creDate'] = $strValue;
                break;
                case ('IdAsset'):
                case ('idAsset'):
                    $this->arrDBFields['idAsset'] = $strValue;
                break;
                case ('Featured'):
                case ('featured'):
                    $this->arrDBFields['featured'] = $strValue;
                break;
                case ('IdAppBase'):
                case ('idAppBase'):
                    $this->arrDBFields['idAppBase'] = $strValue;
                break;
                    defualt:
                        throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
                    break;
                }
            }
        }
?>