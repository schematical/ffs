<?php
class AssignmentBase extends BaseEntity {
	const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Assignment';
    const P_KEY = 'idAssignment';
    
    public function __construct(){
        $this->table = DB_PREFIX . self::TABLE_NAME;
		$this->pKey = self::P_KEY;
		$this->strDBConn = self::DB_CONN;
    }
 
	public static function LoadById($intId){
		$sql = sprintf("SELECT * FROM %s WHERE idAssignment = %s;", self::TABLE_NAME, $intId);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Assignment();
			$tObj->materilize($data);
			return $tObj;
		}
	}
	public static function LoadAll(){
		$sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
		$result = MLCDBDriver::Query($sql, Assignment::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Assignment();
			$tObj->materilize($data);
			$coll->addItem($tObj);
		}
		return $coll;
	}
	public function ToXml($blnReclusive = false){
        $xmlStr = "";
        $xmlStr .= "<Assignment>";
        
        $xmlStr .= "<idAssignment>";
        $xmlStr .= $this->idAssignment;
        $xmlStr .= "</idAssignment>";
        
        $xmlStr .= "<idDevice>";
        $xmlStr .= $this->idDevice;
        $xmlStr .= "</idDevice>";
        
        $xmlStr .= "<idSession>";
        $xmlStr .= $this->idSession;
        $xmlStr .= "</idSession>";
        
        $xmlStr .= "<event>";
        $xmlStr .= $this->event;
        $xmlStr .= "</event>";
        
        $xmlStr .= "<apartatus>";
        $xmlStr .= $this->apartatus;
        $xmlStr .= "</apartatus>";
        
        $xmlStr .= "<creDate>";
        $xmlStr .= $this->creDate;
        $xmlStr .= "</creDate>";
        
        $xmlStr .= "<idUser>";
        $xmlStr .= $this->idUser;
        $xmlStr .= "</idUser>";
        
        $xmlStr .= "<revokeDate>";
        $xmlStr .= $this->revokeDate;
        $xmlStr .= "</revokeDate>";
        
        if($blnReclusive){
           //Finish FK Rel stuff
        }
        $xmlStr .= "</Assignment>";
        return $xmlStr;
        
    }
   
	public static function Query($strExtra, $blnReturnSingle = false){
		$sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME,  $strExtra);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Assignment();
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
    

    //Load by foregin key
    
    public static function LoadCollByIdDevice($intIdDevice){
        $sql = sprintf("SELECT * FROM Assignment WHERE idDevice = %s;", $intIdDevice);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$objAssignment = new Assignment();
			$objAssignment->materilize($data);
			$coll->addItem($objAssignment);
		}
		return $coll;
    }

    
    public static function LoadCollByIdSession($intIdSession){
        $sql = sprintf("SELECT * FROM Assignment WHERE idSession = %s;", $intIdSession);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$objAssignment = new Assignment();
			$objAssignment->materilize($data);
			$coll->addItem($objAssignment);
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
       
         
    }
        
        
        
        
        
       public static function Parse($mixData, $blnReturnId = false){
        	if(is_numeric($mixData)){
        		if($blnReturnId){
        			return $mixData;
        		}
        		return Assignment::Load($mixData);
        	}elseif(
        		(is_object($mixData)) && 
        		(get_class($mixData) == 'Assignment')
        	){
        		if(!$blnReturnId){
        			return $mixData;
        		}
        		return $mixData->intIdAssignment;
        	}elseif(is_null($mixData)){
        		return null;
        	}else{
        		throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Assignment"');
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
				
				$tObj = new Assignment();
				$tObj->materilize($data);
				$coll->addItem($tObj);
			}
			$arrResults = $coll->getCollection();
			
			return $arrResults;
		}
        public function __toArray(){
        	$arrReturn = array();
            $arrReturn['_ClassName'] = "Assignment %>";
            
                                 
                 $arrReturn['idAssignment'] = $this->idAssignment;
            
                                 
                 $arrReturn['idDevice'] = $this->idDevice;
            
                                 
                 $arrReturn['idSession'] = $this->idSession;
            
                                 
                 $arrReturn['event'] = $this->event;
            
                                 
                 $arrReturn['apartatus'] = $this->apartatus;
            
                                 
                 $arrReturn['creDate'] = $this->creDate;
            
                                 
                 $arrReturn['idUser'] = $this->idUser;
            
                                 
                 $arrReturn['revokeDate'] = $this->revokeDate;
            
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
	        	
	   			case('IdAssignment'): 
	   			case('idAssignment'): 
	   				if(array_key_exists('idAssignment', $this->arrDBFields)){
	        			return $this->arrDBFields['idAssignment'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('IdDevice'): 
	   			case('idDevice'): 
	   				if(array_key_exists('idDevice', $this->arrDBFields)){
	        			return $this->arrDBFields['idDevice'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('IdSession'): 
	   			case('idSession'): 
	   				if(array_key_exists('idSession', $this->arrDBFields)){
	        			return $this->arrDBFields['idSession'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Event'): 
	   			case('event'): 
	   				if(array_key_exists('event', $this->arrDBFields)){
	        			return $this->arrDBFields['event'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Apartatus'): 
	   			case('apartatus'): 
	   				if(array_key_exists('apartatus', $this->arrDBFields)){
	        			return $this->arrDBFields['apartatus'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('CreDate'): 
	   			case('creDate'): 
	   				if(array_key_exists('creDate', $this->arrDBFields)){
	        			return $this->arrDBFields['creDate'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('IdUser'): 
	   			case('idUser'): 
	   				if(array_key_exists('idUser', $this->arrDBFields)){
	        			return $this->arrDBFields['idUser'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('RevokeDate'): 
	   			case('revokeDate'): 
	   				if(array_key_exists('revokeDate', $this->arrDBFields)){
	        			return $this->arrDBFields['revokeDate'];
	        		}
	        		return null;
	        	break;
	        	
	        	
                case('IdDeviceObject'):
                case('idSessionObject'):
	   				if(
	   				    (array_key_exists('idDevice', $this->arrDBFields)) &&
	   				    (!is_null($this->arrDBFields['idDevice']))
                    ){
	        			return Device::LoadById(
	        			    $this->arrDBFields['idDevice']
                        );
	        		}
	        		return null;
	        	break;
	        	
                case('IdSessionObject'):
                case('idSessionObject'):
	   				if(
	   				    (array_key_exists('idSession', $this->arrDBFields)) &&
	   				    (!is_null($this->arrDBFields['idSession']))
                    ){
	        			return Session::LoadById(
	        			    $this->arrDBFields['idSession']
                        );
	        		}
	        		return null;
	        	break;
	        	
	        	default:
	        		throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
	        	break;
	        }
	       
	    }
	    public function __set($strName, $strValue){
	   		$this->modified = 1;
	   		switch($strName){
	   			
	   			case('IdAssignment'): 
	   			case('idAssignment'): 
	        		$this->arrDBFields['idAssignment'] = $strValue;
	        	break;
	        	
	   			case('IdDevice'): 
	   			case('idDevice'): 
	        		$this->arrDBFields['idDevice'] = $strValue;
	        	break;
	        	
	   			case('IdSession'): 
	   			case('idSession'): 
	        		$this->arrDBFields['idSession'] = $strValue;
	        	break;
	        	
	   			case('Event'): 
	   			case('event'): 
	        		$this->arrDBFields['event'] = $strValue;
	        	break;
	        	
	   			case('Apartatus'): 
	   			case('apartatus'): 
	        		$this->arrDBFields['apartatus'] = $strValue;
	        	break;
	        	
	   			case('CreDate'): 
	   			case('creDate'): 
	        		$this->arrDBFields['creDate'] = $strValue;
	        	break;
	        	
	   			case('IdUser'): 
	   			case('idUser'): 
	        		$this->arrDBFields['idUser'] = $strValue;
	        	break;
	        	
	   			case('RevokeDate'): 
	   			case('revokeDate'): 
	        		$this->arrDBFields['revokeDate'] = $strValue;
	        	break;
	        	
	        	default:
	        		throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
	        	break;
	        }
	    }
}
?>