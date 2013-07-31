<?php
class MLCEntityModelMDEEnviromentBase extends MLCEntityModelClassBase{
	protected $strClassName = 'MDEEnviroment';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objMDEEnviroment = new MDEEnviroment();
		}else{
        	$objMDEEnviroment = MDEEnviroment::LoadById($strName);
		}
      
        if(!is_null($objMDEEnviroment)){
        	return new MLCEntityModelMDEEnviromentObject($objMDEEnviroment);
        }else{
            throw new MLCEntityModelException("No MDEEnviroment found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(MDEEnviroment::LoadAll()->GetCollection());
         $objResponse->BodyType = 'MDEEnviroment';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>