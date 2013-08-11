<?php
class MLCApiMLCBatchBase extends MLCApiClassBase{
	protected $strClassName = 'MLCBatch';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objMLCBatch = MLCBatch::LoadById($strName);
        }else{
            $objMLCBatch = null;
        }

      
        if(!is_null($objMLCBatch)){
        	return new MLCApiMLCBatchObject($objMLCBatch);
        }else{
            throw new MLCApiException("No MLCBatch found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>