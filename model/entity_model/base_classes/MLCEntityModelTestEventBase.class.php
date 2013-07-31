<?php
class MLCEntityModelTestEventBase extends MLCEntityModelClassBase{
	protected $strClassName = 'TestEvent';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objTestEvent = new TestEvent();
		}else{
        	$objTestEvent = TestEvent::LoadById($strName);
		}
      
        if(!is_null($objTestEvent)){
        	return new MLCEntityModelTestEventObject($objTestEvent);
        }else{
            throw new MLCEntityModelException("No TestEvent found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(TestEvent::LoadAll()->GetCollection());
         $objResponse->BodyType = 'TestEvent';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>