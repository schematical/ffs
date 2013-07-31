<?php
class MLCApiCheckinBase extends MLCApiClassBase{
	protected $strClassName = 'Checkin';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objCheckin = Checkin::LoadById($strName);
	
      
        if(!is_null($objCheckin)){
        	return new MLCApiCheckinObject($objCheckin);
        }else{
            throw new MLCApiException("No Checkin found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>