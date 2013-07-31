<?php
class MLCApiSessionBase extends MLCApiClassBase{
	protected $strClassName = 'Session';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objSession = Session::LoadById($strName);
        }else{
            $objSession = null;
        }

      
        if(!is_null($objSession)){
        	return new MLCApiSessionObject($objSession);
        }else{
            throw new MLCApiException("No Session found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>