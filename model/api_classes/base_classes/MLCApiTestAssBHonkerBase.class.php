<?php
class MLCApiTestAssBHonkerBase extends MLCApiClassBase{
	protected $strClassName = 'TestAssBHonker';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objTestAssBHonker = TestAssBHonker::LoadById($strName);
	
      
        if(!is_null($objTestAssBHonker)){
        	return new MLCApiTestAssBHonkerObject($objTestAssBHonker);
        }else{
            throw new MLCApiException("No TestAssBHonker found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>