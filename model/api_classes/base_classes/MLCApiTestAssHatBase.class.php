<?php
class MLCApiTestAssHatBase extends MLCApiClassBase{
	protected $strClassName = 'TestAssHat';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objTestAssHat = TestAssHat::LoadById($strName);
	
      
        if(!is_null($objTestAssHat)){
        	return new MLCApiTestAssHatObject($objTestAssHat);
        }else{
            throw new MLCApiException("No TestAssHat found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>