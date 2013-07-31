<?php
class MLCApiTestVenuesBase extends MLCApiClassBase{
	protected $strClassName = 'TestVenues';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objTestVenues = TestVenues::LoadById($strName);
	
      
        if(!is_null($objTestVenues)){
        	return new MLCApiTestVenuesObject($objTestVenues);
        }else{
            throw new MLCApiException("No TestVenues found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>