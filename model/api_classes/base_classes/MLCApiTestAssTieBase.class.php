<?php
class MLCApiTestAssTieBase extends MLCApiClassBase{
	protected $strClassName = 'TestAssTie';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objTestAssTie = TestAssTie::LoadById($strName);
	
      
        if(!is_null($objTestAssTie)){
        	return new MLCApiTestAssTieObject($objTestAssTie);
        }else{
            throw new MLCApiException("No TestAssTie found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>