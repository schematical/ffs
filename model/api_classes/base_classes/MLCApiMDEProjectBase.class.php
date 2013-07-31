<?php
class MLCApiMDEProjectBase extends MLCApiClassBase{
	protected $strClassName = 'MDEProject';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objMDEProject = MDEProject::LoadById($strName);
	
      
        if(!is_null($objMDEProject)){
        	return new MLCApiMDEProjectObject($objMDEProject);
        }else{
            throw new MLCApiException("No MDEProject found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>