<?php
class MLCApiAuthRollBase extends MLCApiClassBase{
	protected $strClassName = 'AuthRoll';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objAuthRoll = AuthRoll::LoadById($strName);
        }else{
            $objAuthRoll = null;
        }

      
        if(!is_null($objAuthRoll)){
        	return new MLCApiAuthRollObject($objAuthRoll);
        }else{
            throw new MLCApiException("No AuthRoll found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>