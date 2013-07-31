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
* - MDEAssetBase extends BaseEntity
*/
class MDEAssetBase extends BaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'MDEAsset';
    const P_KEY = 'idAsset';
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        $sql = sprintf("SELECT * FROM %s WHERE idAsset = %s;", self::TABLE_NAME, $intId);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEAsset();
            $tObj->materilize($data);
            return $tObj;
        }
    }
    public static function LoadAll() {
        $sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
        $result = MLCDBDriver::Query($sql, MDEAsset::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEAsset();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<MDEAsset>";
        $xmlStr.= "<idAsset>";
        $xmlStr.= $this->idAsset;
        $xmlStr.= "</idAsset>";
        $xmlStr.= "<s3Loc>";
        $xmlStr.= $this->s3Loc;
        $xmlStr.= "</s3Loc>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<idUser>";
        $xmlStr.= $this->idUser;
        $xmlStr.= "</idUser>";
        $xmlStr.= "<idApp>";
        $xmlStr.= $this->idApp;
        $xmlStr.= "</idApp>";
        $xmlStr.= "<type>";
        $xmlStr.= $this->type;
        $xmlStr.= "</type>";
        $xmlStr.= "<shortDesc>";
        $xmlStr.= $this->shortDesc;
        $xmlStr.= "</shortDesc>";
        $xmlStr.= "<longDesc>";
        $xmlStr.= $this->longDesc;
        $xmlStr.= "</longDesc>";
        $xmlStr.= "<namespace>";
        $xmlStr.= $this->namespace;
        $xmlStr.= "</namespace>";
        $xmlStr.= "<success>";
        $xmlStr.= $this->success;
        $xmlStr.= "</success>";
        $xmlStr.= "<delDate>";
        $xmlStr.= $this->delDate;
        $xmlStr.= "</delDate>";
        $xmlStr.= "<data>";
        $xmlStr.= $this->data;
        $xmlStr.= "</data>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</MDEAsset>";
        return $xmlStr;
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new MDEAsset();
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
            return MDEAsset::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'MDEAsset')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdAsset;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . '->Parse - Parameter 1 must be either an intiger or a class type "MDEAsset"');
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
            $tObj = new MDEAsset();
            $tObj->materilize($data);
            $coll->addItem($tObj);
        }
        $arrResults = $coll->getCollection();
        return $arrResults;
    }
    public function __toArray() {
        $arrReturn = array();
        $arrReturn['_ClassName'] = "MDEAsset";
        $arrReturn['idAsset'] = $this->idAsset;
        $arrReturn['s3Loc'] = $this->s3Loc;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['idUser'] = $this->idUser;
        $arrReturn['idApp'] = $this->idApp;
        $arrReturn['type'] = $this->type;
        $arrReturn['shortDesc'] = $this->shortDesc;
        $arrReturn['longDesc'] = $this->longDesc;
        $arrReturn['namespace'] = $this->namespace;
        $arrReturn['success'] = $this->success;
        $arrReturn['delDate'] = $this->delDate;
        $arrReturn['data'] = $this->data;
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
            case ('IdAsset'):
            case ('idAsset'):
                if (array_key_exists('idAsset', $this->arrDBFields)) {
                    return $this->arrDBFields['idAsset'];
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
            case ('IdApp'):
            case ('idApp'):
                if (array_key_exists('idApp', $this->arrDBFields)) {
                    return $this->arrDBFields['idApp'];
                }
                return null;
            break;
            case ('Type'):
            case ('type'):
                if (array_key_exists('type', $this->arrDBFields)) {
                    return $this->arrDBFields['type'];
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
            case ('Success'):
            case ('success'):
                if (array_key_exists('success', $this->arrDBFields)) {
                    return $this->arrDBFields['success'];
                }
                return null;
            break;
            case ('DelDate'):
            case ('delDate'):
                if (array_key_exists('delDate', $this->arrDBFields)) {
                    return $this->arrDBFields['delDate'];
                }
                return null;
            break;
            case ('Data'):
            case ('data'):
                if (array_key_exists('data', $this->arrDBFields)) {
                    return $this->arrDBFields['data'];
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
                case ('IdAsset'):
                case ('idAsset'):
                    $this->arrDBFields['idAsset'] = $strValue;
                break;
                case ('S3Loc'):
                case ('s3Loc'):
                    $this->arrDBFields['s3Loc'] = $strValue;
                break;
                case ('CreDate'):
                case ('creDate'):
                    $this->arrDBFields['creDate'] = $strValue;
                break;
                case ('IdUser'):
                case ('idUser'):
                    $this->arrDBFields['idUser'] = $strValue;
                break;
                case ('IdApp'):
                case ('idApp'):
                    $this->arrDBFields['idApp'] = $strValue;
                break;
                case ('Type'):
                case ('type'):
                    $this->arrDBFields['type'] = $strValue;
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
                case ('Success'):
                case ('success'):
                    $this->arrDBFields['success'] = $strValue;
                break;
                case ('DelDate'):
                case ('delDate'):
                    $this->arrDBFields['delDate'] = $strValue;
                break;
                case ('Data'):
                case ('data'):
                    $this->arrDBFields['data'] = $strValue;
                break;
                    defualt:
                        throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
                    break;
                }
            }
        }
?>