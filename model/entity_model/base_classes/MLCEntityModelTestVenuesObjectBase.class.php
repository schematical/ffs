<?php
class MLCEntityModelTestVenuesObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'TestVenues';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
	       	case('AuthUser'):
				//Load 
				$objAuthUser = $this->GetEntity()->IdUser;
				return new MLCEntityModelAuthUserObject($objIdUser);
		    break;
		    
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}