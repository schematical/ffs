<?php
class MLCApiTestAssBananasBase extends MLCApiClassBase{
	protected $strClassName = 'TestAssBananas';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objTestAssBananas = TestAssBananas::LoadById($strName);
	
      
        if(!is_null($objTestAssBananas)){
        	return new MLCApiTestAssBananasObject($objTestAssBananas);
        }else{
            throw new MLCApiException("No TestAssBananas found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>