<?php
class MLCApiTestObjectBase extends MLCApiClassBase{
	protected $strClassName = 'TestObject';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objTestObject = TestObject::LoadById($strName);
	
      
        if(!is_null($objTestObject)){
        	return new MLCApiTestObjectObject($objTestObject);
        }else{
            throw new MLCApiException("No TestObject found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>