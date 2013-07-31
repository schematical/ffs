<?php
class MLCEntityModelCheckinTypeBase extends MLCEntityModelClassBase{
	protected $strClassName = 'CheckinType';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objCheckinType = new CheckinType();
		}else{
        	$objCheckinType = CheckinType::LoadById($strName);
		}
      
        if(!is_null($objCheckinType)){
        	return new MLCEntityModelCheckinTypeObject($objCheckinType);
        }else{
            throw new MLCEntityModelException("No CheckinType found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(CheckinType::LoadAll()->GetCollection());
         $objResponse->BodyType = 'CheckinType';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>