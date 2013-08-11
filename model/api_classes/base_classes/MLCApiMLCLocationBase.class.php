<?php
class MLCApiMLCLocationBase extends MLCApiClassBase{
	protected $strClassName = 'MLCLocation';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objMLCLocation = MLCLocation::LoadById($strName);
        }else{
            $objMLCLocation = null;
        }

      
        if(!is_null($objMLCLocation)){
        	return new MLCApiMLCLocationObject($objMLCLocation);
        }else{
            throw new MLCApiException("No MLCLocation found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>