<?php
class MLCApiTestNewTableBase extends MLCApiClassBase{
	protected $strClassName = 'TestNewTable';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objTestNewTable = TestNewTable::LoadById($strName);
	
      
        if(!is_null($objTestNewTable)){
        	return new MLCApiTestNewTableObject($objTestNewTable);
        }else{
            throw new MLCApiException("No TestNewTable found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>