<?php
class EnrollmentBase extends BaseEntity {
	const DB_CONN = 'DB_1';
    const TABLE_NAME = 'Enrollment';
    const P_KEY = 'idEnrollment';
    
    public function __construct(){
        $this->table = DB_PREFIX . self::TABLE_NAME;
		$this->pKey = self::P_KEY;
		$this->strDBConn = self::DB_CONN;
    }
 
	public static function LoadById($intId){
		$sql = sprintf("SELECT * FROM %s WHERE idEnrollment = %s;", self::TABLE_NAME, $intId);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Enrollment();
			$tObj->materilize($data);
			return $tObj;
		}
	}
	public static function LoadAll(){
		$sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
		$result = MLCDBDriver::Query($sql, Enrollment::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Enrollment();
			$tObj->materilize($data);
			$coll->addItem($tObj);
		}
		return $coll;
	}
	public function ToXml($blnReclusive = false){
        $xmlStr = "";
        $xmlStr .= "<Enrollment>";
        
        $xmlStr .= "<idEnrollment>";
        $xmlStr .= $this->idEnrollment;
        $xmlStr .= "</idEnrollment>";
        
        $xmlStr .= "<idAthelete>";
        $xmlStr .= $this->idAthelete;
        $xmlStr .= "</idAthelete>";
        
        $xmlStr .= "<idCompetition>";
        $xmlStr .= $this->idCompetition;
        $xmlStr .= "</idCompetition>";
        
        $xmlStr .= "<idSession>";
        $xmlStr .= $this->idSession;
        $xmlStr .= "</idSession>";
        
        $xmlStr .= "<flight>";
        $xmlStr .= $this->flight;
        $xmlStr .= "</flight>";
        
        $xmlStr .= "<division>";
        $xmlStr .= $this->division;
        $xmlStr .= "</division>";
        
        $xmlStr .= "<ageGroup>";
        $xmlStr .= $this->ageGroup;
        $xmlStr .= "</ageGroup>";
        
        $xmlStr .= "<misc1>";
        $xmlStr .= $this->misc1;
        $xmlStr .= "</misc1>";
        
        $xmlStr .= "<misc2>";
        $xmlStr .= $this->misc2;
        $xmlStr .= "</misc2>";
        
        $xmlStr .= "<misc3>";
        $xmlStr .= $this->misc3;
        $xmlStr .= "</misc3>";
        
        if($blnReclusive){
           //Finish FK Rel stuff
        }
        $xmlStr .= "</Enrollment>";
        return $xmlStr;
        
    }
   
	public static function Query($strExtra, $blnReturnSingle = false){
		$sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME,  $strExtra);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new Enrollment();
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
    
    public static function LoadCollByIdAthelete($intIdAthelete){
        $sql = sprintf("SELECT * FROM Enrollment WHERE idAthelete = %s;", $intIdAthelete);
		$result = MLCDBDriver::Query($sql);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$objEnrollment = new Enrollment();
			$objEnrollment->materilize($data);
			$coll->addItem($objEnrollment);
		}
		return $coll;
    }

    
    public static function LoadCollByIdCompetition($intIdCompetition){
        $sql = sprintf("SELECT * FROM Enrollment WHERE idCompetition = %s;", $intIdCompetition);
		$result = MLCDBDriver::Query($sql);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$objEnrollment = new Enrollment();
			$objEnrollment->materilize($data);
			$coll->addItem($objEnrollment);
		}
		return $coll;
    }

    
    public static function LoadCollByIdSession($intIdSession){
        $sql = sprintf("SELECT * FROM Enrollment WHERE idSession = %s;", $intIdSession);
		$result = MLCDBDriver::Query($sql);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$objEnrollment = new Enrollment();
			$objEnrollment->materilize($data);
			$coll->addItem($objEnrollment);
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
        		return Enrollment::Load($mixData);
        	}elseif(
        		(is_object($mixData)) && 
        		(get_class($mixData) == 'Enrollment')
        	){
        		if(!$blnReturnId){
        			return $mixData;
        		}
        		return $mixData->intIdEnrollment;
        	}elseif(is_null($mixData)){
        		return null;
        	}else{
        		throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "Enrollment"');
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
				
				$tObj = new Enrollment();
				$tObj->materilize($data);
				$coll->addItem($tObj);
			}
			$arrResults = $coll->getCollection();
			
			return $arrResults;
		}
        public function __toArray(){
        	$arrReturn = array();
            $arrReturn['_ClassName'] = "Enrollment %>";
            
                                 
                 $arrReturn['idEnrollment'] = $this->idEnrollment;
            
                                 
                 $arrReturn['idAthelete'] = $this->idAthelete;
            
                                 
                 $arrReturn['idCompetition'] = $this->idCompetition;
            
                                 
                 $arrReturn['idSession'] = $this->idSession;
            
                                 
                 $arrReturn['flight'] = $this->flight;
            
                                 
                 $arrReturn['division'] = $this->division;
            
                                 
                 $arrReturn['ageGroup'] = $this->ageGroup;
            
                                 
                 $arrReturn['misc1'] = $this->misc1;
            
                                 
                 $arrReturn['misc2'] = $this->misc2;
            
                                 
                 $arrReturn['misc3'] = $this->misc3;
            
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
	        	
	   			case('IdEnrollment'): 
	   			case('idEnrollment'): 
	   				if(array_key_exists('idEnrollment', $this->arrDBFields)){
	        			return $this->arrDBFields['idEnrollment'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('IdAthelete'): 
	   			case('idAthelete'): 
	   				if(array_key_exists('idAthelete', $this->arrDBFields)){
	        			return $this->arrDBFields['idAthelete'];
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
	        	
	   			case('IdSession'): 
	   			case('idSession'): 
	   				if(array_key_exists('idSession', $this->arrDBFields)){
	        			return $this->arrDBFields['idSession'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Flight'): 
	   			case('flight'): 
	   				if(array_key_exists('flight', $this->arrDBFields)){
	        			return $this->arrDBFields['flight'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Division'): 
	   			case('division'): 
	   				if(array_key_exists('division', $this->arrDBFields)){
	        			return $this->arrDBFields['division'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('AgeGroup'): 
	   			case('ageGroup'): 
	   				if(array_key_exists('ageGroup', $this->arrDBFields)){
	        			return $this->arrDBFields['ageGroup'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Misc1'): 
	   			case('misc1'): 
	   				if(array_key_exists('misc1', $this->arrDBFields)){
	        			return $this->arrDBFields['misc1'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Misc2'): 
	   			case('misc2'): 
	   				if(array_key_exists('misc2', $this->arrDBFields)){
	        			return $this->arrDBFields['misc2'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Misc3'): 
	   			case('misc3'): 
	   				if(array_key_exists('misc3', $this->arrDBFields)){
	        			return $this->arrDBFields['misc3'];
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
	   			
	   			case('IdEnrollment'): 
	   			case('idEnrollment'): 
	        		$this->arrDBFields['idEnrollment'] = $strValue;
	        	break;
	        	
	   			case('IdAthelete'): 
	   			case('idAthelete'): 
	        		$this->arrDBFields['idAthelete'] = $strValue;
	        	break;
	        	
	   			case('IdCompetition'): 
	   			case('idCompetition'): 
	        		$this->arrDBFields['idCompetition'] = $strValue;
	        	break;
	        	
	   			case('IdSession'): 
	   			case('idSession'): 
	        		$this->arrDBFields['idSession'] = $strValue;
	        	break;
	        	
	   			case('Flight'): 
	   			case('flight'): 
	        		$this->arrDBFields['flight'] = $strValue;
	        	break;
	        	
	   			case('Division'): 
	   			case('division'): 
	        		$this->arrDBFields['division'] = $strValue;
	        	break;
	        	
	   			case('AgeGroup'): 
	   			case('ageGroup'): 
	        		$this->arrDBFields['ageGroup'] = $strValue;
	        	break;
	        	
	   			case('Misc1'): 
	   			case('misc1'): 
	        		$this->arrDBFields['misc1'] = $strValue;
	        	break;
	        	
	   			case('Misc2'): 
	   			case('misc2'): 
	        		$this->arrDBFields['misc2'] = $strValue;
	        	break;
	        	
	   			case('Misc3'): 
	   			case('misc3'): 
	        		$this->arrDBFields['misc3'] = $strValue;
	        	break;
	        	
	        	defualt:
	        		throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
	        	break;
	        }
	    }
}
?>