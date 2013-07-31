<?php
class MLCApiMDEEnviromentBase extends MLCApiClassBase{
	protected $strClassName = 'MDEEnviroment';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objMDEEnviroment = MDEEnviroment::LoadById($strName);
	
      
        if(!is_null($objMDEEnviroment)){
        	return new MLCApiMDEEnviromentObject($objMDEEnviroment);
        }else{
            throw new MLCApiException("No MDEEnviroment found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>