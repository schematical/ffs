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
* - MDEPackageBase extends BaseEntity
*/
class MDEPackageBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'MDEPackage';
    const P_KEY = 'idPackage';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idPackage = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEPackage();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, MDEPackage::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEPackage();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<MDEPackage>";
        $xmlStr.= "<idPackage>";
        $xmlStr.= $this->idPackage;
        $xmlStr.= "</idPackage>";
        $xmlStr.= "<idAsset>";
        $xmlStr.= $this->idAsset;
        $xmlStr.= "</idAsset>";
        $xmlStr.= "<repoType>";
        $xmlStr.= $this->repoType;
        $xmlStr.= "</repoType>";
        $xmlStr.= "<repoUrl>";
        $xmlStr.= $this->repoUrl;
        $xmlStr.= "</repoUrl>";
        $xmlStr.= "<shortDesc>";
        $xmlStr.= $this->shortDesc;
        $xmlStr.= "</shortDesc>";
        $xmlStr.= "<longDesc>";
        $xmlStr.= $this->longDesc;
        $xmlStr.= "</longDesc>";
        $xmlStr.= "<namespace>";
        $xmlStr.= $this->namespace;
        $xmlStr.= "</namespace>";
        $xmlStr.= "<idAccount>";
        $xmlStr.= $this->idAccount;
        $xmlStr.= "</idAccount>";
        $xmlStr.= "<idBuildAssembly>";
        $xmlStr.= $this->idBuildAssembly;
        $xmlStr.= "</idBuildAssembly>";
        $xmlStr.= "<aboutUrl>";
        $xmlStr.= $this->aboutUrl;
        $xmlStr.= "</aboutUrl>";
        $xmlStr.= "<includeByDefault>";
        $xmlStr.= $this->includeByDefault;
        $xmlStr.= "</includeByDefault>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</MDEPackage>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEPackage();
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
            return MDEPackage::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'MDEPackage')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdPackage;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . '->Parse - Parameter 1 must be either an intiger or a class type "MDEPackage"');
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
            $tObj = new MDEPackage();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "MDEPackage";
        $arrReturn['idPackage'] = $this->idPackage;
        $arrReturn['idAsset'] = $this->idAsset;
        $arrReturn['repoType'] = $this->repoType;
        $arrReturn['repoUrl'] = $this->repoUrl;
        $arrReturn['shortDesc'] = $this->shortDesc;
        $arrReturn['longDesc'] = $this->longDesc;
        $arrReturn['namespace'] = $this->namespace;
        $arrReturn['idAccount'] = $this->idAccount;
        $arrReturn['idBuildAssembly'] = $this->idBuildAssembly;
        $arrReturn['aboutUrl'] = $this->aboutUrl;
        $arrReturn['includeByDefault'] = $this->includeByDefault;
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
            case ('IdPackage'):
            case ('idPackage'):
                if (array_key_exists('idPackage', $this->arrDBFields)) {
                    return $this->arrDBFields['idPackage'];
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
            case ('RepoType'):
            case ('repoType'):
                if (array_key_exists('repoType', $this->arrDBFields)) {
                    return $this->arrDBFields['repoType'];
                }
                return null;
            break;
            case ('RepoUrl'):
            case ('repoUrl'):
                if (array_key_exists('repoUrl', $this->arrDBFields)) {
                    return $this->arrDBFields['repoUrl'];
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
            case ('LongDesc'):
            case ('longDesc'):
                if (array_key_exists('longDesc', $this->arrDBFields)) {
                    return $this->arrDBFields['longDesc'];
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
            case ('IdAccount'):
            case ('idAccount'):
                if (array_key_exists('idAccount', $this->arrDBFields)) {
                    return $this->arrDBFields['idAccount'];
                }
                return null;
            break;
            case ('IdBuildAssembly'):
            case ('idBuildAssembly'):
                if (array_key_exists('idBuildAssembly', $this->arrDBFields)) {
                    return $this->arrDBFields['idBuildAssembly'];
                }
                return null;
            break;
            case ('AboutUrl'):
            case ('aboutUrl'):
                if (array_key_exists('aboutUrl', $this->arrDBFields)) {
                    return $this->arrDBFields['aboutUrl'];
                }
                return null;
            break;
            case ('IncludeByDefault'):
            case ('includeByDefault'):
                if (array_key_exists('includeByDefault', $this->arrDBFields)) {
                    return $this->arrDBFields['includeByDefault'];
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
                case ('IdPackage'):
                case ('idPackage'):
                    $this->arrDBFields['idPackage'] = $strValue;
                break;
                case ('IdAsset'):
                case ('idAsset'):
                    $this->arrDBFields['idAsset'] = $strValue;
                break;
                case ('RepoType'):
                case ('repoType'):
                    $this->arrDBFields['repoType'] = $strValue;
                break;
                case ('RepoUrl'):
                case ('repoUrl'):
                    $this->arrDBFields['repoUrl'] = $strValue;
                break;
                case ('ShortDesc'):
                case ('shortDesc'):
                    $this->arrDBFields['shortDesc'] = $strValue;
                break;
                case ('LongDesc'):
                case ('longDesc'):
                    $this->arrDBFields['longDesc'] = $strValue;
                break;
                case ('Namespace'):
                case ('namespace'):
                    $this->arrDBFields['namespace'] = $strValue;
                break;
                case ('IdAccount'):
                case ('idAccount'):
                    $this->arrDBFields['idAccount'] = $strValue;
                break;
                case ('IdBuildAssembly'):
                case ('idBuildAssembly'):
                    $this->arrDBFields['idBuildAssembly'] = $strValue;
                break;
                case ('AboutUrl'):
                case ('aboutUrl'):
                    $this->arrDBFields['aboutUrl'] = $strValue;
                break;
                case ('IncludeByDefault'):
                case ('includeByDefault'):
                    $this->arrDBFields['includeByDefault'] = $strValue;
                break;
                    defualt:
                        throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
                    break;
                }
            }
        }
?>