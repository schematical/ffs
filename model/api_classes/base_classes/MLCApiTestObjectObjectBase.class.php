<?php
class MLCApiTestObjectObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'TestObject';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('TestAssHat'):
					//Load 
					$objTestAssHat = $this->GetEntity()->IdTestAssHat;
					return new MLCApiTestAssHatObject($objIdTestAssHat);
			    break;
			    
		       	case('AuthUser'):
					//Load 
					$objAuthUser = $this->GetEntity()->IdUser;
					return new MLCApiAuthUserObject($objIdUser);
			    break;
			    
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}