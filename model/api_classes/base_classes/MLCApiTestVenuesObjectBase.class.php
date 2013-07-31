<?php
class MLCApiTestVenuesObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'TestVenues';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
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