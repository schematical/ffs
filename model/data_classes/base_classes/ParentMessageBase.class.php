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
* Classes list:
* - ParentMessageBase extends BaseEntity
*/
/**
 * Class Competition
 * @property-read mixed $IdParentMessage
 * @property-write mixed $IdParentMessage
 * @property-read mixed $IdAthelete
 * @property-write mixed $IdAthelete
 * @property-read mixed $AtheleteName
 * @property-write mixed $AtheleteName
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
 * @property-read mixed $InviteData
 * @property-write mixed $InviteData
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
 * @property-read mixed $IdStripeData
 * @property-write mixed $IdStripeData
 * @property-read ParentMessage $IdAtheleteObject
 * @property-read ParentMessage $IdCompetitionObject
 */
class ParentMessageBase extends BaseEntity {
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
        $coll = new BaseEntityCollection(self::Query(''));
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
            if (array_key_exists('ParentMessage.idParentMessage', $arrData)) {
                //New Smart Way
                $this->arrDBFields['idParentMessage'] = $arrData['ParentMessage.idParentMessage'];
                $this->arrDBFields['idAthelete'] = $arrData['ParentMessage.idAthelete'];
                $this->arrDBFields['atheleteName'] = $arrData['ParentMessage.atheleteName'];
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
                if (array_key_exists('Athelete.idAthelete', $arrData)) {
                    $this->objIdCompetition = new Athelete();
                    $this->objIdCompetition->Materilize($arrData);
                }
                if (array_key_exists('Competition.idCompetition', $arrData)) {
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
    public static function Query($strExtra, $blnReturnSingle = false, $arrJoins = null) {
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
                        $strJoin.= ' JOIN Athelete ON ParentMessage.idAthelete = Athelete.idAthelete';
                    break;
                    case ('Competition'):
                        $strJoin.= ' JOIN Competition ON ParentMessage.idCompetition = Competition.idCompetition';
                    break;
                }
            }
        }
        $sql = sprintf("SELECT %s FROM ParentMessage %s %s;", $strFields, $strJoin, $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new ParentMessage();
            $tObj->Materilize($data);
            $arrReturn[] = $tObj;
        }
        //$arrReturn = $coll->getCollection();
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
        $sql = sprintf("SELECT ParentMessage.* FROM ParentMessage %s;", $strExtra);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        return mysql_num_rows($result);
    }
    //Get children
    //Load by foregin key
    public static function LoadCollByIdAthelete($intIdAthelete) {
        $sql = sprintf("SELECT ParentMessage.* FROM ParentMessage WHERE idAthelete = %s;", $intIdAthelete);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objParentMessage = new ParentMessage();
            $objParentMessage->materilize($data);
            $coll->addItem($objParentMessage);
        }
        return $coll;
    }
    public static function LoadCollByIdCompetition($intIdCompetition) {
        $sql = sprintf("SELECT ParentMessage.* FROM ParentMessage WHERE idCompetition = %s;", $intIdCompetition);
        $result = MLCDBDriver::Query($sql, self::DB_CONN);
        $coll = new BaseEntityCollection();
        while ($data = mysql_fetch_assoc($result)) {
            $objParentMessage = new ParentMessage();
            $objParentMessage->materilize($data);
            $coll->addItem($objParentMessage);
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
        $arrReturn = array();
        $arrReturn['_ClassName'] = "ParentMessage %>";
        $arrReturn['idParentMessage'] = $this->idParentMessage;
        $arrReturn['idAthelete'] = $this->idAthelete;
        $arrReturn['atheleteName'] = $this->atheleteName;
        $arrReturn['message'] = $this->message;
        $arrReturn['creDate'] = $this->creDate;
        $arrReturn['dispDate'] = $this->dispDate;
        $arrReturn['idUser'] = $this->idUser;
        $arrReturn['queDate'] = $this->queDate;
        $arrReturn['inviteData'] = $this->inviteData;
        $arrReturn['inviteType'] = $this->inviteType;
        $arrReturn['inviteToken'] = $this->inviteToken;
        $arrReturn['inviteViewDate'] = $this->inviteViewDate;
        $arrReturn['idCompetition'] = $this->idCompetition;
        $arrReturn['approveDate'] = $this->approveDate;
        $arrReturn['idStripeData'] = $this->idStripeData;
        return $arrReturn;
    }
    public function __toString() {
        return 'ParentMessage(' . $this->getId() . ')';
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
            case ('InviteData'):
            case ('inviteData'):
                if (array_key_exists('inviteData', $this->arrDBFields)) {
                    return $this->arrDBFields['inviteData'];
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
    public function __set($strName, $strValue) {
        $this->modified = 1;
        switch ($strName) {
            case ('IdParentMessage'):
            case ('idParentMessage'):
                $this->arrDBFields['idParentMessage'] = $strValue;
            break;
            case ('IdAthelete'):
            case ('idAthelete'):
                $this->arrDBFields['idAthelete'] = $strValue;
                $this->objAthelete = null;
            break;
            case ('AtheleteName'):
            case ('atheleteName'):
                $this->arrDBFields['atheleteName'] = $strValue;
            break;
            case ('Message'):
            case ('message'):
                $this->arrDBFields['message'] = $strValue;
            break;
            case ('CreDate'):
            case ('creDate'):
                $this->arrDBFields['creDate'] = $strValue;
            break;
            case ('DispDate'):
            case ('dispDate'):
                $this->arrDBFields['dispDate'] = $strValue;
            break;
            case ('IdUser'):
            case ('idUser'):
                $this->arrDBFields['idUser'] = $strValue;
            break;
            case ('QueDate'):
            case ('queDate'):
                $this->arrDBFields['queDate'] = $strValue;
            break;
            case ('InviteData'):
            case ('inviteData'):
                $this->arrDBFields['inviteData'] = $strValue;
            break;
            case ('InviteType'):
            case ('inviteType'):
                $this->arrDBFields['inviteType'] = $strValue;
            break;
            case ('InviteToken'):
            case ('inviteToken'):
                $this->arrDBFields['inviteToken'] = $strValue;
            break;
            case ('InviteViewDate'):
            case ('inviteViewDate'):
                $this->arrDBFields['inviteViewDate'] = $strValue;
            break;
            case ('IdCompetition'):
            case ('idCompetition'):
                $this->arrDBFields['idCompetition'] = $strValue;
                $this->objCompetition = null;
            break;
            case ('ApproveDate'):
            case ('approveDate'):
                $this->arrDBFields['approveDate'] = $strValue;
            break;
            case ('IdStripeData'):
            case ('idStripeData'):
                $this->arrDBFields['idStripeData'] = $strValue;
            break;
            case ('IdAtheleteObject'):
                $this->arrDBFields['idAthelete'] = $strValue->idAthelete;
                $this->objIdAthelete = $strValue;
            break;
            case ('IdCompetitionObject'):
                $this->arrDBFields['idCompetition'] = $strValue->idCompetition;
                $this->objIdCompetition = $strValue;
            break;
            default:
                throw new MLCMissingPropertyException($this, $strName);
            break;
        }
    }
}
?>