<?php
class MLCEntityModelMDEChangeBase extends MLCEntityModelClassBase{
	protected $strClassName = 'MDEChange';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objMDEChange = new MDEChange();
		}else{
        	$objMDEChange = MDEChange::LoadById($strName);
		}
      
        if(!is_null($objMDEChange)){
        	return new MLCEntityModelMDEChangeObject($objMDEChange);
        }else{
            throw new MLCEntityModelException("No MDEChange found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(MDEChange::LoadAll()->GetCollection());
         $objResponse->BodyType = 'MDEChange';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>