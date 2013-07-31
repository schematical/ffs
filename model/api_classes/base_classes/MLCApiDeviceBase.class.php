<?php
class MLCApiDeviceBase extends MLCApiClassBase{
	protected $strClassName = 'Device';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objDevice = Device::LoadById($strName);
        }else{
            $objDevice = null;
        }

      
        if(!is_null($objDevice)){
        	return new MLCApiDeviceObject($objDevice);
        }else{
            throw new MLCApiException("No Device found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>