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
* - MDEBuildBase extends BaseEntity
*/
class MDEBuildBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'MDEBuild';
    const P_KEY = 'idBuild';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idBuild = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEBuild();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, MDEBuild::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEBuild();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<MDEBuild>";
        $xmlStr.= "<idBuild>";
        $xmlStr.= $this->idBuild;
        $xmlStr.= "</idBuild>";
        $xmlStr.= "<idApp>";
        $xmlStr.= $this->idApp;
        $xmlStr.= "</idApp>";
        $xmlStr.= "<idUser>";
        $xmlStr.= $this->idUser;
        $xmlStr.= "</idUser>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<log>";
        $xmlStr.= $this->log;
        $xmlStr.= "</log>";
        $xmlStr.= "<idBuildStatus>";
        $xmlStr.= $this->idBuildStatus;
        $xmlStr.= "</idBuildStatus>";
        $xmlStr.= "<s3Loc>";
        $xmlStr.= $this->s3Loc;
        $xmlStr.= "</s3Loc>";
        $xmlStr.= "<ipAddress>";
        $xmlStr.= $this->ipAddress;
        $xmlStr.= "</ipAddress>";
        $xmlStr.= "<lines>";
        $xmlStr.= $this->lines;
        $xmlStr.= "</lines>";
        $xmlStr.= "<duration>";
        $xmlStr.= $this->duration;
        $xmlStr.= "</duration>";
        $xmlStr.= "<chars>";
        $xmlStr.= $this->chars;
        $xmlStr.= "</chars>";
        $xmlStr.= "<idBuildAssembly>";
        $xmlStr.= $this->idBuildAssembly;
        $xmlStr.= "</idBuildAssembly>";
        $xmlStr.= "<files>";
        $xmlStr.= $this->files;
        $xmlStr.= "</files>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</MDEBuild>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEBuild();
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
            return MDEBuild::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'MDEBuild')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdBuild;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . '->Parse - Parameter 1 must be either an intiger or a class type "MDEBuild"');
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
            $tObj = new MDEBuild();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "MDEBuild";
        $arrReturn['idBuild'] = $this->idBuild;
        $arrReturn['idApp'] = $this->idApp;
        $arrReturn['idUser'] = $this->idUser;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['log'] = $this->log;
        $arrReturn['idBuildStatus'] = $this->idBuildStatus;
        $arrReturn['s3Loc'] = $this->s3Loc;
        $arrReturn['ipAddress'] = $this->ipAddress;
        $arrReturn['lines'] = $this->lines;
        $arrReturn['duration'] = $this->duration;
        $arrReturn['chars'] = $this->chars;
        $arrReturn['idBuildAssembly'] = $this->idBuildAssembly;
        $arrReturn['files'] = $this->files;
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
            case ('IdBuild'):
            case ('idBuild'):
                if (array_key_exists('idBuild', $this->arrDBFields)) {
                    return $this->arrDBFields['idBuild'];
                }
                return null;
            break;
            case ('IdApp'):
            case ('idApp'):
                if (array_key_exists('idApp', $this->arrDBFields)) {
                    return $this->arrDBFields['idApp'];
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
            case ('CreDate'):
            case ('creDate'):
                if (array_key_exists('creDate', $this->arrDBFields)) {
                    return $this->arrDBFields['creDate'];
                }
                return null;
            break;
            case ('Log'):
            case ('log'):
                if (array_key_exists('log', $this->arrDBFields)) {
                    return $this->arrDBFields['log'];
                }
                return null;
            break;
            case ('IdBuildStatus'):
            case ('idBuildStatus'):
                if (array_key_exists('idBuildStatus', $this->arrDBFields)) {
                    return $this->arrDBFields['idBuildStatus'];
                }
                return null;
            break;
            case ('S3Loc'):
            case ('s3Loc'):
                if (array_key_exists('s3Loc', $this->arrDBFields)) {
                    return $this->arrDBFields['s3Loc'];
                }
                return null;
            break;
            case ('IpAddress'):
            case ('ipAddress'):
                if (array_key_exists('ipAddress', $this->arrDBFields)) {
                    return $this->arrDBFields['ipAddress'];
                }
                return null;
            break;
            case ('Lines'):
            case ('lines'):
                if (array_key_exists('lines', $this->arrDBFields)) {
                    return $this->arrDBFields['lines'];
                }
                return null;
            break;
            case ('Duration'):
            case ('duration'):
                if (array_key_exists('duration', $this->arrDBFields)) {
                    return $this->arrDBFields['duration'];
                }
                return null;
            break;
            case ('Chars'):
            case ('chars'):
                if (array_key_exists('chars', $this->arrDBFields)) {
                    return $this->arrDBFields['chars'];
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
            case ('Files'):
            case ('files'):
                if (array_key_exists('files', $this->arrDBFields)) {
                    return $this->arrDBFields['files'];
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
                case ('IdBuild'):
                case ('idBuild'):
                    $this->arrDBFields['idBuild'] = $strValue;
                break;
                case ('IdApp'):
                case ('idApp'):
                    $this->arrDBFields['idApp'] = $strValue;
                break;
                case ('IdUser'):
                case ('idUser'):
                    $this->arrDBFields['idUser'] = $strValue;
                break;
                case ('CreDate'):
                case ('creDate'):
                    $this->arrDBFields['creDate'] = $strValue;
                break;
                case ('Log'):
                case ('log'):
                    $this->arrDBFields['log'] = $strValue;
                break;
                case ('IdBuildStatus'):
                case ('idBuildStatus'):
                    $this->arrDBFields['idBuildStatus'] = $strValue;
                break;
                case ('S3Loc'):
                case ('s3Loc'):
                    $this->arrDBFields['s3Loc'] = $strValue;
                break;
                case ('IpAddress'):
                case ('ipAddress'):
                    $this->arrDBFields['ipAddress'] = $strValue;
                break;
                case ('Lines'):
                case ('lines'):
                    $this->arrDBFields['lines'] = $strValue;
                break;
                case ('Duration'):
                case ('duration'):
                    $this->arrDBFields['duration'] = $strValue;
                break;
                case ('Chars'):
                case ('chars'):
                    $this->arrDBFields['chars'] = $strValue;
                break;
                case ('IdBuildAssembly'):
                case ('idBuildAssembly'):
                    $this->arrDBFields['idBuildAssembly'] = $strValue;
                break;
                case ('Files'):
                case ('files'):
                    $this->arrDBFields['files'] = $strValue;
                break;
                    defualt:
                        throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
                    break;
                }
            }
        }
?>