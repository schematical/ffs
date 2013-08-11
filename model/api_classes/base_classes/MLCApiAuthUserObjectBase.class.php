<?php
class MLCApiAuthUserObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'AuthUser';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
		     	case('mlcnotifications'):
		       		$arrMLCNotifications = MLCNotification::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
		       		return new MLCApiResponse($arrMLCNotifications);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}