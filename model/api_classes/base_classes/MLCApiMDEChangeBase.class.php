<?php
class MLCApiMDEChangeBase extends MLCApiClassBase{
	protected $strClassName = 'MDEChange';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objMDEChange = MDEChange::LoadById($strName);
	
      
        if(!is_null($objMDEChange)){
        	return new MLCApiMDEChangeObject($objMDEChange);
        }else{
            throw new MLCApiException("No MDEChange found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>