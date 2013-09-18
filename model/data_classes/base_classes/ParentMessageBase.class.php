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
* - LoadCollByIdAthelete()
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
* - InviteData()
* - IdStripeData()
* Classes list:
* - ParentMessageBase extends MLCBaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdParentMessage
 * @property-write mixed $IdParentMessage
 * @property-read mixed $IdAthelete
 * @property-write mixed $IdAthelete
 * @property-read mixed $AtheleteName
 * @property-write mixed $AtheleteName
 * @property-read mixed $FromName
 * @property-write mixed $FromName
 * @property-read mixed $Message
 * @property-write mixed $Message
 * @property-read mixed $CreDate
 * @property-write mixed $CreDate
 * @property-read mixed $DispDate
 * @property-write mixed $DispDate
 * @property-read mixed $IdUser
 * @property-write mixed $IdUser
 * @property-read mixed $QueDate
 * @property-write mixed $QueDate
 * @property-read mixed $InviteType
 * @property-write mixed $InviteType
 * @property-read mixed $InviteToken
 * @property-write mixed $InviteToken
 * @property-read mixed $InviteViewDate
 * @property-write mixed $InviteViewDate
 * @property-read mixed $IdCompetition
 * @property-write mixed $IdCompetition
 * @property-read mixed $ApproveDate
 * @property-write mixed $ApproveDate
 * @property-read ParentMessage $IdAtheleteObject
 * @property-read ParentMessage $IdCompetitionObject
 */
class ParentMessageBase extends MLCBaseEntity {
    const DB_CONN = 'DB_1';
    const TABLE_NAME = 'ParentMessage';
    const P_KEY = 'idParentMessage';
    protected $objIdAthelete = null;
    protected $objIdCompetition = null;
    public function __construct() {
        $this->table = DB_PREFIX . self::TABLE_NAME;
        $this->pKey = self::P_KEY;
        $this->strDBConn = self::DB_CONN;
    }
    public static function LoadById($intId) {
        return self::Query('WHERE ParentMessage.idParentMessage = ' . $intId, true);
    }
    public static function LoadAll() {
        $coll = self::Query('');
        return $coll;
    }
    public function ToXml($blnReclusive = false) {
        $xmlStr = "";
        $xmlStr.= "<ParentMessage>";
        $xmlStr.= "<idParentMessage>";
        $xmlStr.= $this->idParentMessage;
        $xmlStr.= "</idParentMessage>";
        $xmlStr.= "<idAthelete>";
        $xmlStr.= $this->idAthelete;
        $xmlStr.= "</idAthelete>";
        $xmlStr.= "<atheleteName>";
        $xmlStr.= $this->atheleteName;
        $xmlStr.= "</atheleteName>";
        $xmlStr.= "<fromName>";
        $xmlStr.= $this->fromName;
        $xmlStr.= "</fromName>";
        $xmlStr.= "<message>";
        $xmlStr.= $this->message;
        $xmlStr.= "</message>";
        $xmlStr.= "<creDate>";
        $xmlStr.= $this->creDate;
        $xmlStr.= "</creDate>";
        $xmlStr.= "<dispDate>";
        $xmlStr.= $this->dispDate;
        $xmlStr.= "</dispDate>";
        $xmlStr.= "<idUser>";
        $xmlStr.= $this->idUser;
        $xmlStr.= "</idUser>";
        $xmlStr.= "<queDate>";
        $xmlStr.= $this->queDate;
        $xmlStr.= "</queDate>";
        $xmlStr.= "<inviteData>";
        $xmlStr.= $this->inviteData;
        $xmlStr.= "</inviteData>";
        $xmlStr.= "<inviteType>";
        $xmlStr.= $this->inviteType;
        $xmlStr.= "</inviteType>";
        $xmlStr.= "<inviteToken>";
        $xmlStr.= $this->inviteToken;
        $xmlStr.= "</inviteToken>";
        $xmlStr.= "<inviteViewDate>";
        $xmlStr.= $this->inviteViewDate;
        $xmlStr.= "</inviteViewDate>";
        $xmlStr.= "<idCompetition>";
        $xmlStr.= $this->idCompetition;
        $xmlStr.= "</idCompetition>";
        $xmlStr.= "<approveDate>";
        $xmlStr.= $this->approveDate;
        $xmlStr.= "</approveDate>";
        $xmlStr.= "<idStripeData>";
        $xmlStr.= $this->idStripeData;
        $xmlStr.= "</idStripeData>";
        if ($blnReclusive) {
            //Finish FK Rel stuff
            
        }
        $xmlStr.= "</ParentMessage>";
        return $xmlStr;
    }
    public function Materilize($arrData) {
        if (isset($arrData) && (sizeof($arrData) > 1)) {
            if ((array_key_exists('ParentMessage.idParentMessage', $arrData))) {
                //New Smart Way
                $this->arrDBFields['idParentMessage'] = $arrData['ParentMessage.idParentMessage'];
                $this->arrDBFields['idAthelete'] = $arrData['ParentMessage.idAthelete'];
                $this->arrDBFields['atheleteName'] = $arrData['ParentMessage.atheleteName'];
                $this->arrDBFields['fromName'] = $arrData['ParentMessage.fromName'];
                $this->arrDBFields['message'] = $arrData['ParentMessage.message'];
                $this->arrDBFields['creDate'] = $arrData['ParentMessage.creDate'];
                $this->arrDBFields['dispDate'] = $arrData['ParentMessage.dispDate'];
                $this->arrDBFields['idUser'] = $arrData['ParentMessage.idUser'];
                $this->arrDBFields['queDate'] = $arrData['ParentMessage.queDate'];
                $this->arrDBFields['inviteData'] = $arrData['ParentMessage.inviteData'];
                $this->arrDBFields['inviteType'] = $arrData['ParentMessage.inviteType'];
                $this->arrDBFields['inviteToken'] = $arrData['ParentMessage.inviteToken'];
                $this->arrDBFields['inviteViewDate'] = $arrData['ParentMessage.inviteViewDate'];
                $this->arrDBFields['idCompetition'] = $arrData['ParentMessage.idCompetition'];
                $this->arrDBFields['approveDate'] = $arrData['ParentMessage.approveDate'];
                $this->arrDBFields['idStripeData'] = $arrData['ParentMessage.idStripeData'];
                //Foregin Key
                if ((array_key_exists('Athelete.idAthelete', $arrData)) && (!is_null($arrData['Athelete.idAthelete']))) {
                    $this->objIdAthelete = new Athelete();
                    $this->objIdAthelete->Materilize($arrData);
                }
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
        $arrFields[] = 'ParentMessage.idParentMessage ' . (($blnLongSelect) ? ' as "ParentMessage.idParentMessage"' : '');
        $arrFields[] = 'ParentMessage.idAthelete ' . (($blnLongSelect) ? ' as "ParentMessage.idAthelete"' : '');
        $arrFields[] = 'ParentMessage.atheleteName ' . (($blnLongSelect) ? ' as "ParentMessage.atheleteName"' : '');
        $arrFields[] = 'ParentMessage.fromName ' . (($blnLongSelect) ? ' as "ParentMessage.fromName"' : '');
        $arrFields[] = 'ParentMessage.message ' . (($blnLongSelect) ? ' as "ParentMessage.message"' : '');
        $arrFields[] = 'ParentMessage.creDate ' . (($blnLongSelect) ? ' as "ParentMessage.creDate"' : '');
        $arrFields[] = 'ParentMessage.dispDate ' . (($blnLongSelect) ? ' as "ParentMessage.dispDate"' : '');
        $arrFields[] = 'ParentMessage.idUser ' . (($blnLongSelect) ? ' as "ParentMessage.idUser"' : '');
        $arrFields[] = 'ParentMessage.queDate ' . (($blnLongSelect) ? ' as "ParentMessage.queDate"' : '');
        $arrFields[] = 'ParentMessage.inviteData ' . (($blnLongSelect) ? ' as "ParentMessage.inviteData"' : '');
        $arrFields[] = 'ParentMessage.inviteType ' . (($blnLongSelect) ? ' as "ParentMessage.inviteType"' : '');
        $arrFields[] = 'ParentMessage.inviteToken ' . (($blnLongSelect) ? ' as "ParentMessage.inviteToken"' : '');
        $arrFields[] = 'ParentMessage.inviteViewDate ' . (($blnLongSelect) ? ' as "ParentMessage.inviteViewDate"' : '');
        $arrFields[] = 'ParentMessage.idCompetition ' . (($blnLongSelect) ? ' as "ParentMessage.idCompetition"' : '');
        $arrFields[] = 'ParentMessage.approveDate ' . (($blnLongSelect) ? ' as "ParentMessage.approveDate"' : '');
        $arrFields[] = 'ParentMessage.idStripeData ' . (($blnLongSelect) ? ' as "ParentMessage.idStripeData"' : '');
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
                    case ('Athelete'):
                        $strJoin.= ' LEFT JOIN Athelete ON ParentMessage.idAthelete = Athelete.idAthelete';
                    break;
                    case ('Competition'):
                        $strJoin.= ' LEFT JOIN Competition ON ParentMessage.idCompetition = Competition.idCompetition';
                    break;
                }
            }
        }
        if (!is_null($strExtra)) {
            $strSql = sprintf("SELECT %s FROM ParentMessage %s %s;", $strFields, $strJoin, $strExtra);
            $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        }
        if ((is_object($mixReturnSingle)) && ($mixReturnSingle instanceof MLCBaseEntityCollection)) {
            $collReturn = $mixReturnSingle;
            $collReturn->RemoveAll();
        } else {
            $collReturn = new MLCBaseEntityCollection();
            $collReturn->SetQueryEntity('ParentMessage');
        }
        if (!is_null($strExtra)) {
            $collReturn->AddQueryToHistory($strSql);
            while ($data = mysql_fetch_assoc($result)) {
                $tObj = new ParentMessage();
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
                    case ('Athelete'):
                        $strJoin.= ' LEFT JOIN Athelete ON ParentMessage.idAthelete = Athelete.idAthelete';
                    break;
                    case ('Competition'):
                        $strJoin.= ' LEFT JOIN Competition ON ParentMessage.idCompetition = Competition.idCompetition';
                    break;
                }
            }
        }
        $strSql = sprintf("SELECT %s FROM ParentMessage %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($strSql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdAthelete($intIdAthelete) {
        $strSql = sprintf(" WHERE idAthelete = %s;", $intIdAthelete);
        $coll = self::Query($strSql);
        return $coll;
    }
    public static function LoadCollByIdCompetition($intIdCompetition) {
        $strSql = sprintf(" WHERE idCompetition = %s;", $intIdCompetition);
        $coll = self::Query($strSql);
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
    }
    public static function Parse($mixData, $blnReturnId = false) {
        if (is_numeric($mixData)) {
            if ($blnReturnId) {
                return $mixData;
            }
            return ParentMessage::Load($mixData);
        } elseif ((is_object($mixData)) && (get_class($mixData) == 'ParentMessage')) {
            if (!$blnReturnId) {
                return $mixData;
            }
            return $mixData->intIdParentMessage;
        } elseif (is_null($mixData)) {
            return null;
        } else {
            throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "ParentMessage"');
        }
    }
    public static function LoadSingleByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE ParentMessage.%s %s %s', $strField, $strCompairison, $strValue);
        $objEntity = self::Query($strExtra, true);
        return $objEntity;
    }
    public static function LoadArrayByField($strField, $mixValue, $strCompairison = '=') {
        if (is_numeric($mixValue)) {
            $strValue = $mixValue;
        } else {
            $strValue = sprintf('"%s"', $mixValue);
        }
        $strExtra = sprintf(' WHERE ParentMessage.%s %s %s', $strField, $strCompairison, $strValue);
        $arrResults = self::Query($strExtra);
        return $arrResults;
    }
    public function __toArray() {
        $collReturn = array();
        $collReturn['_ClassName'] = "ParentMessage %>";
        $collReturn['idParentMessage'] = $this->idParentMessage;
        $collReturn['idAthelete'] = $this->idAthelete;
        $collReturn['atheleteName'] = $this->atheleteName;
        $collReturn['fromName'] = $this->fromName;
        $collReturn['message'] = $this->message;
        $collReturn['creDate'] = $this->creDate;
        $collReturn['dispDate'] = $this->dispDate;
        $collReturn['idUser'] = $this->idUser;
        $collReturn['queDate'] = $this->queDate;
        $collReturn['inviteData'] = $this->inviteData;
        $collReturn['inviteType'] = $this->inviteType;
        $collReturn['inviteToken'] = $this->inviteToken;
        $collReturn['inviteViewDate'] = $this->inviteViewDate;
        $collReturn['idCompetition'] = $this->idCompetition;
        $collReturn['approveDate'] = $this->approveDate;
        $collReturn['idStripeData'] = $this->idStripeData;
        return $collReturn;
    }
    public function __toString() {
        return 'ParentMessage(' . $this->getId() . ')';
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
            case ('IdParentMessage'):
            case ('idParentMessage'):
                if (array_key_exists('idParentMessage', $this->arrDBFields)) {
                    return $this->arrDBFields['idParentMessage'];
                }
                return null;
            break;
            case ('IdAthelete'):
            case ('idAthelete'):
                if (array_key_exists('idAthelete', $this->arrDBFields)) {
                    return $this->arrDBFields['idAthelete'];
                }
                return null;
            break;
            case ('AtheleteName'):
            case ('atheleteName'):
                if (array_key_exists('atheleteName', $this->arrDBFields)) {
                    return $this->arrDBFields['atheleteName'];
                }
                return null;
            break;
            case ('FromName'):
            case ('fromName'):
                if (array_key_exists('fromName', $this->arrDBFields)) {
                    return $this->arrDBFields['fromName'];
                }
                return null;
            break;
            case ('Message'):
            case ('message'):
                if (array_key_exists('message', $this->arrDBFields)) {
                    return $this->arrDBFields['message'];
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
            case ('DispDate'):
            case ('dispDate'):
                if (array_key_exists('dispDate', $this->arrDBFields)) {
                    return $this->arrDBFields['dispDate'];
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
            case ('QueDate'):
            case ('queDate'):
                if (array_key_exists('queDate', $this->arrDBFields)) {
                    return $this->arrDBFields['queDate'];
                }
                return null;
            break;
            case ('InviteType'):
            case ('inviteType'):
                if (array_key_exists('inviteType', $this->arrDBFields)) {
                    return $this->arrDBFields['inviteType'];
                }
                return null;
            break;
            case ('InviteToken'):
            case ('inviteToken'):
                if (array_key_exists('inviteToken', $this->arrDBFields)) {
                    return $this->arrDBFields['inviteToken'];
                }
                return null;
            break;
            case ('InviteViewDate'):
            case ('inviteViewDate'):
                if (array_key_exists('inviteViewDate', $this->arrDBFields)) {
                    return $this->arrDBFields['inviteViewDate'];
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
            case ('ApproveDate'):
            case ('approveDate'):
                if (array_key_exists('approveDate', $this->arrDBFields)) {
                    return $this->arrDBFields['approveDate'];
                }
                return null;
            break;
            case ('IdStripeData'):
            case ('idStripeData'):
                if (array_key_exists('idStripeData', $this->arrDBFields)) {
                    return $this->arrDBFields['idStripeData'];
                }
                return null;
            break;
            case ('IdAtheleteObject'):
                if (!is_null($this->objIdAthelete)) {
                    return $this->objIdAthelete;
                }
                if ((array_key_exists('idAthelete', $this->arrDBFields)) && (!is_null($this->arrDBFields['idAthelete']))) {
                    $this->objIdAthelete = Athelete::LoadById($this->arrDBFields['idAthelete']);
                    return $this->objIdAthelete;
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
            case ('IdParentMessage'):
            case ('idParentMessage'):
                $this->arrDBFields['idParentMessage'] = $mixValue;
            break;
            case ('IdAthelete'):
            case ('idAthelete'):
                $this->arrDBFields['idAthelete'] = $mixValue;
                $this->objIdAthelete = null;
            break;
            case ('AtheleteName'):
            case ('atheleteName'):
            case ('_AtheleteName'):
                $this->arrDBFields['atheleteName'] = $mixValue;
            break;
            case ('FromName'):
            case ('fromName'):
            case ('_FromName'):
                $this->arrDBFields['fromName'] = $mixValue;
            break;
            case ('Message'):
            case ('message'):
            case ('_Message'):
                $this->arrDBFields['message'] = $mixValue;
            break;
            case ('CreDate'):
            case ('creDate'):
            case ('_CreDate'):
                $this->arrDBFields['creDate'] = $mixValue;
            break;
            case ('DispDate'):
            case ('dispDate'):
            case ('_DispDate'):
                $this->arrDBFields['dispDate'] = $mixValue;
            break;
            case ('IdUser'):
            case ('idUser'):
                $this->arrDBFields['idUser'] = $mixValue;
            break;
            case ('QueDate'):
            case ('queDate'):
            case ('_QueDate'):
                $this->arrDBFields['queDate'] = $mixValue;
            break;
            case ('_InviteData'):
                $this->arrDBFields['inviteData'] = $mixValue;
            break;
            case ('InviteType'):
            case ('inviteType'):
            case ('_InviteType'):
                $this->arrDBFields['inviteType'] = $mixValue;
            break;
            case ('InviteToken'):
            case ('inviteToken'):
            case ('_InviteToken'):
                $this->arrDBFields['inviteToken'] = $mixValue;
            break;
            case ('InviteViewDate'):
            case ('inviteViewDate'):
            case ('_InviteViewDate'):
                $this->arrDBFields['inviteViewDate'] = $mixValue;
            break;
            case ('IdCompetition'):
            case ('idCompetition'):
                $this->arrDBFields['idCompetition'] = $mixValue;
                $this->objIdCompetition = null;
            break;
            case ('ApproveDate'):
            case ('approveDate'):
            case ('_ApproveDate'):
                $this->arrDBFields['approveDate'] = $mixValue;
            break;
            case ('IdStripeData'):
            case ('idStripeData'):
            case ('_IdStripeData'):
                $this->arrDBFields['idStripeData'] = $mixValue;
            break;
            case ('IdAtheleteObject'):
                if ((!is_null($mixValue)) && ((!is_object($mixValue)) || (!($mixValue instanceof Athelete)))) {
                    throw new MLCWrongTypeException('__set', $strName);
                }
                if (!is_null($mixValue)) {
                    $this->arrDBFields['idAthelete'] = $mixValue->idAthelete;
                } else {
                    $this->arrDBFields['idAthelete'] = null;
                }
                $this->objIdAthelete = $mixValue;
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
    public function InviteData($strKey, $mixData = null) {
        if (is_null($mixData)) {
            if ((!array_key_exists('inviteData', $this->arrDBFields))) {
                return null;
            }
            if ((strlen($this->arrDBFields['inviteData']) < 1)) {
                return null;
            }
            $arrData = json_decode($this->arrDBFields['inviteData'], true);
            if (!array_key_exists($strKey, $arrData)) {
                return null;
            }
            return $arrData[$strKey];
        } else {
            if ((!array_key_exists('inviteData', $this->arrDBFields)) || (strlen($this->arrDBFields['inviteData']) < 1)) {
                $arrData = array();
            } else {
                $arrData = json_decode($this->arrDBFields['inviteData'], true);
            }
            $arrData[$strKey] = $mixData;
            $this->arrDBFields['inviteData'] = json_encode($arrData);
            $this->Save();
        }
    }
    public function IdStripeData($strKey, $mixData = null) {
        if (is_null($mixData)) {
            if ((!array_key_exists('idStripeData', $this->arrDBFields))) {
                return null;
            }
            if ((strlen($this->arrDBFields['idStripeData']) < 1)) {
                return null;
            }
            $arrData = json_decode($this->arrDBFields['idStripeData'], true);
            if (!array_key_exists($strKey, $arrData)) {
                return null;
            }
            return $arrData[$strKey];
        } else {
            if ((!array_key_exists('idStripeData', $this->arrDBFields)) || (strlen($this->arrDBFields['idStripeData']) < 1)) {
                $arrData = array();
            } else {
                $arrData = json_decode($this->arrDBFields['idStripeData'], true);
            }
            $arrData[$strKey] = $mixData;
            $this->arrDBFields['idStripeData'] = json_encode($arrData);
            $this->Save();
        }
    }
}
?>