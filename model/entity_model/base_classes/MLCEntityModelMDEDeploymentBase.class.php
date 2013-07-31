<?php
class MLCEntityModelMDEDeploymentBase extends MLCEntityModelClassBase{
	protected $strClassName = 'MDEDeployment';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objMDEDeployment = new MDEDeployment();
		}else{
        	$objMDEDeployment = MDEDeployment::LoadById($strName);
		}
      
        if(!is_null($objMDEDeployment)){
        	return new MLCEntityModelMDEDeploymentObject($objMDEDeployment);
        }else{
            throw new MLCEntityModelException("No MDEDeployment found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(MDEDeployment::LoadAll()->GetCollection());
         $objResponse->BodyType = 'MDEDeployment';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>