<?php
class MLCApiParentMessageBase extends MLCApiClassBase{
	protected $strClassName = 'ParentMessage';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objParentMessage = ParentMessage::LoadById($strName);
        }else{
            $objParentMessage = null;
        }

      
        if(!is_null($objParentMessage)){
        	return new MLCApiParentMessageObject($objParentMessage);
        }else{
            throw new MLCApiException("No ParentMessage found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>