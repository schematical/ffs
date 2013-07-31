<?php
class MLCApiConsumerBase extends MLCApiClassBase{
	protected $strClassName = 'Consumer';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objConsumer = Consumer::LoadById($strName);
	
      
        if(!is_null($objConsumer)){
        	return new MLCApiConsumerObject($objConsumer);
        }else{
            throw new MLCApiException("No Consumer found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>