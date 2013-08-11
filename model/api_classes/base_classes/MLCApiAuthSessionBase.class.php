<?php
class MLCApiAuthSessionBase extends MLCApiClassBase{
	protected $strClassName = 'AuthSession';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objAuthSession = AuthSession::LoadById($strName);
        }else{
            $objAuthSession = null;
        }

      
        if(!is_null($objAuthSession)){
        	return new MLCApiAuthSessionObject($objAuthSession);
        }else{
            throw new MLCApiException("No AuthSession found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>