<?php
class MLCEntityModelTestVenuesBase extends MLCEntityModelClassBase{
	protected $strClassName = 'TestVenues';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objTestVenues = new TestVenues();
		}else{
        	$objTestVenues = TestVenues::LoadById($strName);
		}
      
        if(!is_null($objTestVenues)){
        	return new MLCEntityModelTestVenuesObject($objTestVenues);
        }else{
            throw new MLCEntityModelException("No TestVenues found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(TestVenues::LoadAll()->GetCollection());
         $objResponse->BodyType = 'TestVenues';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>