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
* - MDEAppBase extends BaseEntity
*/
class MDEAppBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'MDEApp';
    const P_KEY = 'idApp';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idApp = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEApp();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, MDEApp::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEApp();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<MDEApp>";
        $xmlStr.= "<idApp>";
        $xmlStr.= $this->idApp;
        $xmlStr.= "</idApp>";
        $xmlStr.= "<namespace>";
        $xmlStr.= $this->namespace;
        $xmlStr.= "</namespace>";
        $xmlStr.= "<idAccount>";
        $xmlStr.= $this->idAccount;
        $xmlStr.= "</idAccount>";
        $xmlStr.= "<shortDesc>";
        $xmlStr.= $this->shortDesc;
        $xmlStr.= "</shortDesc>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<repoUrl>";
        $xmlStr.= $this->repoUrl;
        $xmlStr.= "</repoUrl>";
        $xmlStr.= "<repoType>";
        $xmlStr.= $this->repoType;
        $xmlStr.= "</repoType>";
        $xmlStr.= "<buildHook>";
        $xmlStr.= $this->buildHook;
        $xmlStr.= "</buildHook>";
        $xmlStr.= "<domain>";
        $xmlStr.= $this->domain;
        $xmlStr.= "</domain>";
        $xmlStr.= "<prefix>";
        $xmlStr.= $this->prefix;
        $xmlStr.= "</prefix>";
        $xmlStr.= "<docroot>";
        $xmlStr.= $this->docroot;
        $xmlStr.= "</docroot>";
        $xmlStr.= "<idBuildAssembly>";
        $xmlStr.= $this->idBuildAssembly;
        $xmlStr.= "</idBuildAssembly>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</MDEApp>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEApp();
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
            return MDEApp::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'MDEApp')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdApp;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . '->Parse - Parameter 1 must be either an intiger or a class type "MDEApp"');
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
            $tObj = new MDEApp();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "MDEApp";
        $arrReturn['idApp'] = $this->idApp;
        $arrReturn['namespace'] = $this->namespace;
        $arrReturn['idAccount'] = $this->idAccount;
        $arrReturn['shortDesc'] = $this->shortDesc;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['repoUrl'] = $this->repoUrl;
        $arrReturn['repoType'] = $this->repoType;
        $arrReturn['buildHook'] = $this->buildHook;
        $arrReturn['domain'] = $this->domain;
        $arrReturn['prefix'] = $this->prefix;
        $arrReturn['docroot'] = $this->docroot;
        $arrReturn['idBuildAssembly'] = $this->idBuildAssembly;
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
            case ('IdApp'):
            case ('idApp'):
                if (array_key_exists('idApp', $this->arrDBFields)) {
                    return $this->arrDBFields['idApp'];
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
            case ('ShortDesc'):
            case ('shortDesc'):
                if (array_key_exists('shortDesc', $this->arrDBFields)) {
                    return $this->arrDBFields['shortDesc'];
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
            case ('RepoUrl'):
            case ('repoUrl'):
                if (array_key_exists('repoUrl', $this->arrDBFields)) {
                    return $this->arrDBFields['repoUrl'];
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
            case ('BuildHook'):
            case ('buildHook'):
                if (array_key_exists('buildHook', $this->arrDBFields)) {
                    return $this->arrDBFields['buildHook'];
                }
                return null;
            break;
            case ('Domain'):
            case ('domain'):
                if (array_key_exists('domain', $this->arrDBFields)) {
                    return $this->arrDBFields['domain'];
                }
                return null;
            break;
            case ('Prefix'):
            case ('prefix'):
                if (array_key_exists('prefix', $this->arrDBFields)) {
                    return $this->arrDBFields['prefix'];
                }
                return null;
            break;
            case ('Docroot'):
            case ('docroot'):
                if (array_key_exists('docroot', $this->arrDBFields)) {
                    return $this->arrDBFields['docroot'];
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
                defualt:
                    throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
                break;
            }
        }
        public function __set($strName, $strValue) {
            $this->modified = 1;
            switch ($strName) {
                case ('IdApp'):
                case ('idApp'):
                    $this->arrDBFields['idApp'] = $strValue;
                break;
                case ('Namespace'):
                case ('namespace'):
                    $this->arrDBFields['namespace'] = $strValue;
                break;
                case ('IdAccount'):
                case ('idAccount'):
                    $this->arrDBFields['idAccount'] = $strValue;
                break;
                case ('ShortDesc'):
                case ('shortDesc'):
                    $this->arrDBFields['shortDesc'] = $strValue;
                break;
                case ('CreDate'):
                case ('creDate'):
                    $this->arrDBFields['creDate'] = $strValue;
                break;
                case ('RepoUrl'):
                case ('repoUrl'):
                    $this->arrDBFields['repoUrl'] = $strValue;
                break;
                case ('RepoType'):
                case ('repoType'):
                    $this->arrDBFields['repoType'] = $strValue;
                break;
                case ('BuildHook'):
                case ('buildHook'):
                    $this->arrDBFields['buildHook'] = $strValue;
                break;
                case ('Domain'):
                case ('domain'):
                    $this->arrDBFields['domain'] = $strValue;
                break;
                case ('Prefix'):
                case ('prefix'):
                    $this->arrDBFields['prefix'] = $strValue;
                break;
                case ('Docroot'):
                case ('docroot'):
                    $this->arrDBFields['docroot'] = $strValue;
                break;
                case ('IdBuildAssembly'):
                case ('idBuildAssembly'):
                    $this->arrDBFields['idBuildAssembly'] = $strValue;
                break;
                    defualt:
                        throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
                    break;
                }
            }
        }
?>