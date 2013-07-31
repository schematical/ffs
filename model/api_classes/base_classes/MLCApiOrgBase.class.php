<?php
class MLCApiOrgBase extends MLCApiClassBase{
	protected $strClassName = 'Org';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objOrg = Org::LoadById($strName);
        }else{
            $objOrg = null;
        }

      
        if(!is_null($objOrg)){
        	return new MLCApiOrgObject($objOrg);
        }else{
            throw new MLCApiException("No Org found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>