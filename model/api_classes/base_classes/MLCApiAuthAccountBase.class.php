<?php
class MLCApiAuthAccountBase extends MLCApiClassBase{
	protected $strClassName = 'AuthAccount';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objAuthAccount = AuthAccount::LoadById($strName);
        }else{
            $objAuthAccount = null;
        }

      
        if(!is_null($objAuthAccount)){
        	return new MLCApiAuthAccountObject($objAuthAccount);
        }else{
            throw new MLCApiException("No AuthAccount found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>