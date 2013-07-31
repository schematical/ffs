<?php
class MLCEntityModelMDEProjectBase extends MLCEntityModelClassBase{
	protected $strClassName = 'MDEProject';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objMDEProject = new MDEProject();
		}else{
        	$objMDEProject = MDEProject::LoadById($strName);
		}
      
        if(!is_null($objMDEProject)){
        	return new MLCEntityModelMDEProjectObject($objMDEProject);
        }else{
            throw new MLCEntityModelException("No MDEProject found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(MDEProject::LoadAll()->GetCollection());
         $objResponse->BodyType = 'MDEProject';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>