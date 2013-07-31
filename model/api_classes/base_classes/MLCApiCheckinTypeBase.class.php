<?php
class MLCApiCheckinTypeBase extends MLCApiClassBase{
	protected $strClassName = 'CheckinType';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objCheckinType = CheckinType::LoadById($strName);
	
      
        if(!is_null($objCheckinType)){
        	return new MLCApiCheckinTypeObject($objCheckinType);
        }else{
            throw new MLCApiException("No CheckinType found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>