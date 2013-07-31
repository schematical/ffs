<?php
class MLCApiMDEDeploymentBase extends MLCApiClassBase{
	protected $strClassName = 'MDEDeployment';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objMDEDeployment = MDEDeployment::LoadById($strName);
	
      
        if(!is_null($objMDEDeployment)){
        	return new MLCApiMDEDeploymentObject($objMDEDeployment);
        }else{
            throw new MLCApiException("No MDEDeployment found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>