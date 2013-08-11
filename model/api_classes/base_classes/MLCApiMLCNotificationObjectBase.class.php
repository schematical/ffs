<?php
class MLCApiMLCNotificationObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'MLCNotification';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('MLCNotification'):
					//Load 
					$objAuthUser = $this->GetEntity()->IdUser;
					return new MLCApiAuthUserObject($objIdUser);
			    break;
			    
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}