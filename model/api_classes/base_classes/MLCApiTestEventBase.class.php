<?php
class MLCApiTestEventBase extends MLCApiClassBase{
	protected $strClassName = 'TestEvent';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objTestEvent = TestEvent::LoadById($strName);
	
      
        if(!is_null($objTestEvent)){
        	return new MLCApiTestEventObject($objTestEvent);
        }else{
            throw new MLCApiException("No TestEvent found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>