<?php
class MLCEntityModelConsumerBase extends MLCEntityModelClassBase{
	protected $strClassName = 'Consumer';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objConsumer = new Consumer();
		}else{
        	$objConsumer = Consumer::LoadById($strName);
		}
      
        if(!is_null($objConsumer)){
        	return new MLCEntityModelConsumerObject($objConsumer);
        }else{
            throw new MLCEntityModelException("No Consumer found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(Consumer::LoadAll()->GetCollection());
         $objResponse->BodyType = 'Consumer';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>