<?php
class AtheleteBase extends BaseEntity {
	const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Athelete';
    const P_KEY = 'idAthelete';
    
    public function __construct(){
        $this->table = DB_PREFIX . self::TABLE_NAME;
		$this->pKey = self::P_KEY;
		$this->strDBConn = self::DB_CONN;
    }
 
	public static function LoadById($intId){
		$sql = sprintf("SELECT * FROM %s WHERE idAthelete = %s;", self::TABLE_NAME, $intId);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Athelete();
			$tObj->materilize($data);
			return $tObj;
		}
	}
	public static function LoadAll(){
		$sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
		$result = MLCDBDriver::Query($sql, Athelete::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Athelete();
			$tObj->materilize($data);
			$coll->addItem($tObj);
		}
		return $coll;
	}
	public function ToXml($blnReclusive = false){
        $xmlStr = "";
        $xmlStr .= "<Athelete>";
        
        $xmlStr .= "<idAthelete>";
        $xmlStr .= $this->idAthelete;
        $xmlStr .= "</idAthelete>";
        
        $xmlStr .= "<idOrg>";
        $xmlStr .= $this->idOrg;
        $xmlStr .= "</idOrg>";
        
        $xmlStr .= "<firstName>";
        $xmlStr .= $this->firstName;
        $xmlStr .= "</firstName>";
        
        $xmlStr .= "<lastName>";
        $xmlStr .= $this->lastName;
        $xmlStr .= "</lastName>";
        
        $xmlStr .= "<birthDate>";
        $xmlStr .= $this->birthDate;
        $xmlStr .= "</birthDate>";
        
        if($blnReclusive){
           //Finish FK Rel stuff
        }
        $xmlStr .= "</Athelete>";
        return $xmlStr;
        
    }
   
	public static function Query($strExtra, $blnReturnSingle = false){
		$sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME,  $strExtra);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Athelete();
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
       return Result::LoadCollByIdAthelete($this->idAthelete);
    }
	

    //Load by foregin key
    
    public static function LoadCollByIdOrg($intIdOrg){
        $sql = sprintf("SELECT * FROM Athelete WHERE idOrg = %s;", $intIdOrg);
		$result = MLCDBDriver::Query($sql);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$objAthelete = new Athelete();
			$objAthelete->materilize($data);
			$coll->addItem($objAthelete);
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
       
         
            
             if(array_key_exists('idathelete', $arrData)){
                $this->intIdAthelete = $arrData['idathelete'];
             }
        
    }
        
        
        
        
        
       public static function Parse($mixData, $blnReturnId = false){
        	if(is_numeric($mixData)){
        		if($blnReturnId){
        			return $mixData;
        		}
        		return Athelete::Load($mixData);
        	}elseif(
        		(is_object($mixData)) && 
        		(get_class($mixData) == 'Athelete')
        	){
        		if(!$blnReturnId){
        			return $mixData;
        		}
        		return $mixData->intIdAthelete;
        	}elseif(is_null($mixData)){
        		return null;
        	}else{
        		throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Athelete"');
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
				
				$tObj = new Athelete();
				$tObj->materilize($data);
				$coll->addItem($tObj);
			}
			$arrResults = $coll->getCollection();
			
			return $arrResults;
		}
        public function __toArray(){
        	$arrReturn = array();
            $arrReturn['_ClassName'] = "Athelete %>";
            
                                 
                 $arrReturn['idAthelete'] = $this->idAthelete;
            
                                 
                 $arrReturn['idOrg'] = $this->idOrg;
            
                                 
                 $arrReturn['firstName'] = $this->firstName;
            
                                 
                 $arrReturn['lastName'] = $this->lastName;
            
                                 
                 $arrReturn['birthDate'] = $this->birthDate;
            
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
	        	
	   			case('IdAthelete'): 
	   			case('idAthelete'): 
	   				if(array_key_exists('idAthelete', $this->arrDBFields)){
	        			return $this->arrDBFields['idAthelete'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('IdOrg'): 
	   			case('idOrg'): 
	   				if(array_key_exists('idOrg', $this->arrDBFields)){
	        			return $this->arrDBFields['idOrg'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('FirstName'): 
	   			case('firstName'): 
	   				if(array_key_exists('firstName', $this->arrDBFields)){
	        			return $this->arrDBFields['firstName'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('LastName'): 
	   			case('lastName'): 
	   				if(array_key_exists('lastName', $this->arrDBFields)){
	        			return $this->arrDBFields['lastName'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('BirthDate'): 
	   			case('birthDate'): 
	   				if(array_key_exists('birthDate', $this->arrDBFields)){
	        			return $this->arrDBFields['birthDate'];
	        		}
	        		return null;
	        	break;
	        	
	        	defualt:
	        		throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
	        	break;
	        }
	       
	    }
	    public function __set($strName, $strValue){
	   		$this->modified = 1;
	   		switch($strName){
	   			
	   			case('IdAthelete'): 
	   			case('idAthelete'): 
	        		$this->arrDBFields['idAthelete'] = $strValue;
	        	break;
	        	
	   			case('IdOrg'): 
	   			case('idOrg'): 
	        		$this->arrDBFields['idOrg'] = $strValue;
	        	break;
	        	
	   			case('FirstName'): 
	   			case('firstName'): 
	        		$this->arrDBFields['firstName'] = $strValue;
	        	break;
	        	
	   			case('LastName'): 
	   			case('lastName'): 
	        		$this->arrDBFields['lastName'] = $strValue;
	        	break;
	        	
	   			case('BirthDate'): 
	   			case('birthDate'): 
	        		$this->arrDBFields['birthDate'] = $strValue;
	        	break;
	        	
	        	defualt:
	        		throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
	        	break;
	        }
	    }
}
?>