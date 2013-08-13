<?php
class OrgBase extends BaseEntity {
	const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Org';
    const P_KEY = 'idOrg';
    
    public function __construct(){
        $this->table = DB_PREFIX . self::TABLE_NAME;
		$this->pKey = self::P_KEY;
		$this->strDBConn = self::DB_CONN;
    }
 
	public static function LoadById($intId){
		$sql = sprintf("SELECT * FROM %s WHERE idOrg = %s;", self::TABLE_NAME, $intId);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Org();
			$tObj->materilize($data);
			return $tObj;
		}
	}
	public static function LoadAll(){
		$sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
		$result = MLCDBDriver::Query($sql, Org::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Org();
			$tObj->materilize($data);
			$coll->addItem($tObj);
		}
		return $coll;
	}
	public function ToXml($blnReclusive = false){
        $xmlStr = "";
        $xmlStr .= "<Org>";
        
        $xmlStr .= "<idOrg>";
        $xmlStr .= $this->idOrg;
        $xmlStr .= "</idOrg>";
        
        $xmlStr .= "<namespace>";
        $xmlStr .= $this->namespace;
        $xmlStr .= "</namespace>";
        
        $xmlStr .= "<name>";
        $xmlStr .= $this->name;
        $xmlStr .= "</name>";
        
        $xmlStr .= "<creDate>";
        $xmlStr .= $this->creDate;
        $xmlStr .= "</creDate>";
        
        $xmlStr .= "<psData>";
        $xmlStr .= $this->psData;
        $xmlStr .= "</psData>";
        
        $xmlStr .= "<idImportAuthUser>";
        $xmlStr .= $this->idImportAuthUser;
        $xmlStr .= "</idImportAuthUser>";
        
        $xmlStr .= "<clubNum>";
        $xmlStr .= $this->clubNum;
        $xmlStr .= "</clubNum>";
        
        if($blnReclusive){
           //Finish FK Rel stuff
        }
        $xmlStr .= "</Org>";
        return $xmlStr;
        
    }
   
	public static function Query($strExtra, $blnReturnSingle = false){
		$sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME,  $strExtra);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Org();
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
    
    public function GetDeviceArr(){
       return Device::LoadCollByIdOrg($this->idOrg);
    }
	

    //Load by foregin key
    
    
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
       
         
            
             if(array_key_exists('idorg', $arrData)){
                $this->intIdOrg = $arrData['idorg'];
             }
        
    }
        
        
        
        
        
       public static function Parse($mixData, $blnReturnId = false){
        	if(is_numeric($mixData)){
        		if($blnReturnId){
        			return $mixData;
        		}
        		return Org::Load($mixData);
        	}elseif(
        		(is_object($mixData)) && 
        		(get_class($mixData) == 'Org')
        	){
        		if(!$blnReturnId){
        			return $mixData;
        		}
        		return $mixData->intIdOrg;
        	}elseif(is_null($mixData)){
        		return null;
        	}else{
        		throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Org"');
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
				
				$tObj = new Org();
				$tObj->materilize($data);
				$coll->addItem($tObj);
			}
			$arrResults = $coll->getCollection();
			
			return $arrResults;
		}
        public function __toArray(){
        	$arrReturn = array();
            $arrReturn['_ClassName'] = "Org %>";
            
                                 
                 $arrReturn['idOrg'] = $this->idOrg;
            
                                 
                 $arrReturn['namespace'] = $this->namespace;
            
                                 
                 $arrReturn['name'] = $this->name;
            
                                 
                 $arrReturn['creDate'] = $this->creDate;
            
                                 
                 $arrReturn['psData'] = $this->psData;
            
                                 
                 $arrReturn['idImportAuthUser'] = $this->idImportAuthUser;
            
                                 
                 $arrReturn['clubNum'] = $this->clubNum;
            
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
	        	
	   			case('IdOrg'): 
	   			case('idOrg'): 
	   				if(array_key_exists('idOrg', $this->arrDBFields)){
	        			return $this->arrDBFields['idOrg'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Namespace'): 
	   			case('namespace'): 
	   				if(array_key_exists('namespace', $this->arrDBFields)){
	        			return $this->arrDBFields['namespace'];
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
	        	
	   			case('CreDate'): 
	   			case('creDate'): 
	   				if(array_key_exists('creDate', $this->arrDBFields)){
	        			return $this->arrDBFields['creDate'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('PsData'): 
	   			case('psData'): 
	   				if(array_key_exists('psData', $this->arrDBFields)){
	        			return $this->arrDBFields['psData'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('IdImportAuthUser'): 
	   			case('idImportAuthUser'): 
	   				if(array_key_exists('idImportAuthUser', $this->arrDBFields)){
	        			return $this->arrDBFields['idImportAuthUser'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('ClubNum'): 
	   			case('clubNum'): 
	   				if(array_key_exists('clubNum', $this->arrDBFields)){
	        			return $this->arrDBFields['clubNum'];
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
	   			
	   			case('IdOrg'): 
	   			case('idOrg'): 
	        		$this->arrDBFields['idOrg'] = $strValue;
	        	break;
	        	
	   			case('Namespace'): 
	   			case('namespace'): 
	        		$this->arrDBFields['namespace'] = $strValue;
	        	break;
	        	
	   			case('Name'): 
	   			case('name'): 
	        		$this->arrDBFields['name'] = $strValue;
	        	break;
	        	
	   			case('CreDate'): 
	   			case('creDate'): 
	        		$this->arrDBFields['creDate'] = $strValue;
	        	break;
	        	
	   			case('PsData'): 
	   			case('psData'): 
	        		$this->arrDBFields['psData'] = $strValue;
	        	break;
	        	
	   			case('IdImportAuthUser'): 
	   			case('idImportAuthUser'): 
	        		$this->arrDBFields['idImportAuthUser'] = $strValue;
	        	break;
	        	
	   			case('ClubNum'): 
	   			case('clubNum'): 
	        		$this->arrDBFields['clubNum'] = $strValue;
	        	break;
	        	
	        	default:
	        		throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
	        	break;
	        }
	    }
}
?>