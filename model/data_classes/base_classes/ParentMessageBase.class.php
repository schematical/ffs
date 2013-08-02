<?php
class ParentMessageBase extends BaseEntity {
	const DB_CONN = 'DB_1';
    const TABLE_NAME = 'ParentMessage';
    const P_KEY = 'idParentMessage';
    
    public function __construct(){
        $this->table = DB_PREFIX . self::TABLE_NAME;
		$this->pKey = self::P_KEY;
		$this->strDBConn = self::DB_CONN;
    }
 
	public static function LoadById($intId){
		$sql = sprintf("SELECT * FROM %s WHERE idParentMessage = %s;", self::TABLE_NAME, $intId);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		while($data = mysql_fetch_assoc($result)){
			$tObj = new ParentMessage();
			$tObj->materilize($data);
			return $tObj;
		}
	}
	public static function LoadAll(){
		$sql = sprintf("SELECT * FROM %s;", self::TABLE_NAME);
		$result = MLCDBDriver::Query($sql, ParentMessage::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new ParentMessage();
			$tObj->materilize($data);
			$coll->addItem($tObj);
		}
		return $coll;
	}
	public function ToXml($blnReclusive = false){
        $xmlStr = "";
        $xmlStr .= "<ParentMessage>";
        
        $xmlStr .= "<idParentMessage>";
        $xmlStr .= $this->idParentMessage;
        $xmlStr .= "</idParentMessage>";
        
        $xmlStr .= "<idAthelete>";
        $xmlStr .= $this->idAthelete;
        $xmlStr .= "</idAthelete>";
        
        $xmlStr .= "<atheleteName>";
        $xmlStr .= $this->atheleteName;
        $xmlStr .= "</atheleteName>";
        
        $xmlStr .= "<message>";
        $xmlStr .= $this->message;
        $xmlStr .= "</message>";
        
        $xmlStr .= "<creDate>";
        $xmlStr .= $this->creDate;
        $xmlStr .= "</creDate>";
        
        $xmlStr .= "<dispDate>";
        $xmlStr .= $this->dispDate;
        $xmlStr .= "</dispDate>";
        
        $xmlStr .= "<idUser>";
        $xmlStr .= $this->idUser;
        $xmlStr .= "</idUser>";
        
        if($blnReclusive){
           //Finish FK Rel stuff
        }
        $xmlStr .= "</ParentMessage>";
        return $xmlStr;
        
    }
   
	public static function Query($strExtra, $blnReturnSingle = false){
		$sql = sprintf("SELECT * FROM %s %s;", self::TABLE_NAME,  $strExtra);
		$result = MLCDBDriver::Query($sql, self::DB_CONN);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$tObj = new ParentMessage();
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
        $sql = sprintf("SELECT * FROM ParentMessage WHERE idAthelete = %s;", $intIdAthelete);
		$result = MLCDBDriver::Query($sql);
		$coll = new BaseEntityCollection();
		while($data = mysql_fetch_assoc($result)){
			$objParentMessage = new ParentMessage();
			$objParentMessage->materilize($data);
			$coll->addItem($objParentMessage);
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
        		return ParentMessage::Load($mixData);
        	}elseif(
        		(is_object($mixData)) && 
        		(get_class($mixData) == 'ParentMessage')
        	){
        		if(!$blnReturnId){
        			return $mixData;
        		}
        		return $mixData->intIdParentMessage;
        	}elseif(is_null($mixData)){
        		return null;
        	}else{
        		throw new Exception(__FUNCTION__ . ' - Parameter 1 must be either an intiger or a class type "ParentMessage"');
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
				
				$tObj = new ParentMessage();
				$tObj->materilize($data);
				$coll->addItem($tObj);
			}
			$arrResults = $coll->getCollection();
			
			return $arrResults;
		}
        public function __toArray(){
        	$arrReturn = array();
            $arrReturn['_ClassName'] = "ParentMessage %>";
            
                                 
                 $arrReturn['idParentMessage'] = $this->idParentMessage;
            
                                 
                 $arrReturn['idAthelete'] = $this->idAthelete;
            
                                 
                 $arrReturn['atheleteName'] = $this->atheleteName;
            
                                 
                 $arrReturn['message'] = $this->message;
            
                                 
                 $arrReturn['creDate'] = $this->creDate;
            
                                 
                 $arrReturn['dispDate'] = $this->dispDate;
            
                                 
                 $arrReturn['idUser'] = $this->idUser;
            
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
	        	
	   			case('IdParentMessage'): 
	   			case('idParentMessage'): 
	   				if(array_key_exists('idParentMessage', $this->arrDBFields)){
	        			return $this->arrDBFields['idParentMessage'];
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
	        	
	   			case('AtheleteName'): 
	   			case('atheleteName'): 
	   				if(array_key_exists('atheleteName', $this->arrDBFields)){
	        			return $this->arrDBFields['atheleteName'];
	        		}
	        		return null;
	        	break;
	        	
	   			case('Message'): 
	   			case('message'): 
	   				if(array_key_exists('message', $this->arrDBFields)){
	        			return $this->arrDBFields['message'];
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
	        	
	   			case('DispDate'): 
	   			case('dispDate'): 
	   				if(array_key_exists('dispDate', $this->arrDBFields)){
	        			return $this->arrDBFields['dispDate'];
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
	        	
	        	defualt:
	        		throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
	        	break;
	        }
	       
	    }
	    public function __set($strName, $strValue){
	   		$this->modified = 1;
	   		switch($strName){
	   			
	   			case('IdParentMessage'): 
	   			case('idParentMessage'): 
	        		$this->arrDBFields['idParentMessage'] = $strValue;
	        	break;
	        	
	   			case('IdAthelete'): 
	   			case('idAthelete'): 
	        		$this->arrDBFields['idAthelete'] = $strValue;
	        	break;
	        	
	   			case('AtheleteName'): 
	   			case('atheleteName'): 
	        		$this->arrDBFields['atheleteName'] = $strValue;
	        	break;
	        	
	   			case('Message'): 
	   			case('message'): 
	        		$this->arrDBFields['message'] = $strValue;
	        	break;
	        	
	   			case('CreDate'): 
	   			case('creDate'): 
	        		$this->arrDBFields['creDate'] = $strValue;
	        	break;
	        	
	   			case('DispDate'): 
	   			case('dispDate'): 
	        		$this->arrDBFields['dispDate'] = $strValue;
	        	break;
	        	
	   			case('IdUser'): 
	   			case('idUser'): 
	        		$this->arrDBFields['idUser'] = $strValue;
	        	break;
	        	
	        	defualt:
	        		throw new Exception('No property with name "' . $strName . '" exists in class ". get_class($this) . "');
	        	break;
	        }
	    }
}
?>