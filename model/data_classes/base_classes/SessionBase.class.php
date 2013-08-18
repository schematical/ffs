<?php
class SessionBase extends BaseEntity {
	const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Session';
    const P_KEY = 'idSession';
    
    public function __construct(){
        $this->table = DB_PREFIX . self::TABLE_NAME;
		$this->pKey = self::P_KEY;
		$this->strDBConn = self::DB_CONN;
    }
 
	public static function LoadById($intId){
		$sql = sprintf("SELECT * FROM %s WHERE idSession = %s;", self::TABLE_NAME, $intId);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Session();
			$tObj->materilize($data);
			return $tObj;
		}
	}
	public static function LoadAll(){
		$sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
		$result = MLCDBDriver::Query($sql, Session::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Session();
			$tObj->materilize($data);
			$coll->addItem($tObj);
		}
		return $coll;
	}
	public function ToXml($blnReclusive = false){
        $xmlStr = "";
        $xmlStr .= "<Session>";
        
        $xmlStr .= "<idSession>";
        $xmlStr .= $this->idSession;
        $xmlStr .= "</idSession>";
        
        $xmlStr .= "<startDate>";
        $xmlStr .= $this->startDate;
        $xmlStr .= "</startDate>";
        
        $xmlStr .= "<endDate>";
        $xmlStr .= $this->endDate;
        $xmlStr .= "</endDate>";
        
        $xmlStr .= "<idCompetition>";
        $xmlStr .= $this->idCompetition;
        $xmlStr .= "</idCompetition>";
        
        $xmlStr .= "<name>";
        $xmlStr .= $this->name;
        $xmlStr .= "</name>";
        
        $xmlStr .= "<notes>";
        $xmlStr .= $this->notes;
        $xmlStr .= "</notes>";
        
        $xmlStr .= "<data>";
        $xmlStr .= $this->data;
        $xmlStr .= "</data>";
        
        $xmlStr .= "<equipmentSet>";
        $xmlStr .= $this->equipmentSet;
        $xmlStr .= "</equipmentSet>";
        
        $xmlStr .= "<eventData>";
        $xmlStr .= $this->eventData;
        $xmlStr .= "</eventData>";
        
        if($blnReclusive){
           //Finish FK Rel stuff
        }
        $xmlStr .= "</Session>";
        return $xmlStr;
        
    }
   
	public static function Query($strExtra, $blnReturnSingle = false){
		$sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME,  $strExtra);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Session();
			$tObj->materilize($data);
			$coll->addItem($tObj);
		}
		$arrReturn = $coll->getCollection();
		if($blnReturnSingle){
			if(count($arrReturn) == 0){
				return null;
			}else{
				return $arrReturn[0];
			}	
		}else{
			return $arrReturn;
		}		
	}
	public static function QueryCount($strExtra = ''){
		$sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME,  $strExtra);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		return mysql_num_rows($result);
			
	}
     //Get children
    
    public function GetResultArr(){
       return Result::LoadCollByIdSession($this->idSession);
    }
	

    //Load by foregin key
    
    public static function LoadCollByIdCompetition($intIdCompetition){
        $sql = sprintf("SELECT * FROM Session WHERE idCompetition = %s;", $intIdCompetition);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$objSession = new Session();
			$objSession->materilize($data);
			$coll->addItem($objSession);
		}
		return $coll;
    }

    
    
      public function LoadByTag($strTag){
	  	return MLCTagDriver::LoadTaggedEntites($strTag, get_class($this));
	  }
	       
    
	  public function AddTag($mixTag){
	  	return MLCTagDriver::AddTag($mixTag, $this);
	  }
	  
    public function ParseArray($arrData){
    	foreach($arrData as $strKey => $mixVal){
    		$arrData[strtolower($strKey)] = $mixVal;
    	}
       
         
            
             if(array_key_exists('idsession', $arrData)){
                $this->intIdSession = $arrData['idsession'];
             }
        
    }
        
        
        
        
        
       public static function Parse($mixData, $blnReturnId = false){
        	if(is_numeric($mixData)){
        		if($blnReturnId){
        			return $mixData;
        		}
        		return Session::Load($mixData);
        	}elseif(
        		(is_object($mixData)) && 
        		(get_class($mixData) == 'Session')
        	){
        		if(!$blnReturnId){
        			return $mixData;
        		}
        		return $mixData->intIdSession;
        	}elseif(is_null($mixData)){
        		return null;
        	}else{
        		throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Session"');
        	}        	
        }
        public static function LoadSingleByField( $strField, $mixValue, $strCompairison = '='){
        	$arrResults = self::LoadArrayByField($strField, $mixValue, $strCompairison);
        	if(count($arrResults)){
        		return $arrResults[0];
        	}
        	return null;
        }
        public static function LoadArrayByField( $strField, $mixValue, $strCompairison = '='){
			if(is_numeric($mixValue)){
				$strValue = $mixValue;
			}else{
				$strValue = sprintf('"%s"', $mixValue);
			} 
			$strExtra = sprintf(' WHERE %s %s %s', $strField, $strCompairison, $strValue);
			
			$sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME, $strExtra);
			//die($sql);
			$result = MLCDBDriver::query($sql, self::DB_CONN);
			$coll = new BaseEntityCollection();
			while($data = mysql_fetch_assoc($result)){
				
				$tObj = new Session();
				$tObj->materilize($data);
				$coll->addItem($tObj);
			}
			$arrResults = $coll->getCollection();
			
			return $arrResults;
		}
        public function __toArray(){
        	$arrReturn = array();
            $arrReturn['_ClassName'] = "Session %>";
            
                                 
                 $arrReturn['idSession'] = $this->idSession;
            
                                 
                 $arrReturn['startDate'] = $this->startDate;
            
                                 
                 $arrReturn['endDate'] = $this->endDate;
            
                                 
                 $arrReturn['idCompetition'] = $this->idCompetition;
            
                                 
                 $arrReturn['name'] = $this->name;
            
                                 
                 $arrReturn['notes'] = $this->notes;
            
                                 
                 $arrReturn['data'] = $this->data;
            
                                 
                 $arrReturn['equipmentSet'] = $this->equipmentSet;
            
                                 
                 $arrReturn['eventData'] = $this->eventData;
            
            return $arrReturn;
        }
        public function __toJson($blnPosponeEncode = false){
        	$arrReturn = $this->__toArray();  
        	if($blnPosponeEncode){
        		return json_encode($arrReturn);
        	}else{
        		return $arrReturn;
        	} 
        }
        public function __get($strName){
	        switch($strName){
	        	
	   			case('IdSession'): 
	   			case('idSession'): 
	   				if(array_key_exists('idSession', $this->arrDBFields)){
	        			return $this->arrDBFields['idSession'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('StartDate'): 
	   			case('startDate'): 
	   				if(array_key_exists('startDate', $this->arrDBFields)){
	        			return $this->arrDBFields['startDate'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('EndDate'): 
	   			case('endDate'): 
	   				if(array_key_exists('endDate', $this->arrDBFields)){
	        			return $this->arrDBFields['endDate'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('IdCompetition'): 
	   			case('idCompetition'): 
	   				if(array_key_exists('idCompetition', $this->arrDBFields)){
	        			return $this->arrDBFields['idCompetition'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Name'): 
	   			case('name'): 
	   				if(array_key_exists('name', $this->arrDBFields)){
	        			return $this->arrDBFields['name'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Notes'): 
	   			case('notes'): 
	   				if(array_key_exists('notes', $this->arrDBFields)){
	        			return $this->arrDBFields['notes'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Data'): 
	   			case('data'): 
	   				if(array_key_exists('data', $this->arrDBFields)){
	        			return $this->arrDBFields['data'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('EquipmentSet'): 
	   			case('equipmentSet'): 
	   				if(array_key_exists('equipmentSet', $this->arrDBFields)){
	        			return $this->arrDBFields['equipmentSet'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('EventData'): 
	   			case('eventData'): 
	   				if(array_key_exists('eventData', $this->arrDBFields)){
	        			return $this->arrDBFields['eventData'];
	        		}
	        		return null;
	        	break;
	        	
	        	
                case('IdCompetitionObject'):
                case('idCompetitionObject'):
	   				if(
	   				    (array_key_exists('idCompetition', $this->arrDBFields)) &&
	   				    (!is_null($this->arrDBFields['idCompetition']))
                    ){
	        			return Competition::LoadById(
	        			    $this->arrDBFields['idCompetition']
                        );
	        		}
	        		return null;
	        	break;
	        	
	        	default:
	        		throw new Exception('No property with name "' . $strName . '" exists in class "'. get_class($this) . '"');
	        	break;
	        }
	       
	    }
	    public function __set($strName, $strValue){
	   		$this->modified = 1;
	   		switch($strName){
	   			
	   			case('IdSession'): 
	   			case('idSession'): 
	        		$this->arrDBFields['idSession'] = $strValue;
	        	break;
	        	
	   			case('StartDate'): 
	   			case('startDate'): 
	        		$this->arrDBFields['startDate'] = $strValue;
	        	break;
	        	
	   			case('EndDate'): 
	   			case('endDate'): 
	        		$this->arrDBFields['endDate'] = $strValue;
	        	break;
	        	
	   			case('IdCompetition'): 
	   			case('idCompetition'): 
	        		$this->arrDBFields['idCompetition'] = $strValue;
	        	break;
	        	
	   			case('Name'): 
	   			case('name'): 
	        		$this->arrDBFields['name'] = $strValue;
	        	break;
	        	
	   			case('Notes'): 
	   			case('notes'): 
	        		$this->arrDBFields['notes'] = $strValue;
	        	break;
	        	
	   			case('Data'): 
	   			case('data'): 
	        		$this->arrDBFields['data'] = $strValue;
	        	break;
	        	
	   			case('EquipmentSet'): 
	   			case('equipmentSet'): 
	        		$this->arrDBFields['equipmentSet'] = $strValue;
	        	break;
	        	
	   			case('EventData'): 
	   			case('eventData'): 
	        		$this->arrDBFields['eventData'] = $strValue;
	        	break;
	        	
	        	default:
	        		throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
	        	break;
	        }
	    }
}
?>