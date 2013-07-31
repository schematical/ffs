<?php
class MLCEntityModelCheckinBase extends MLCEntityModelClassBase{
	protected $strClassName = 'Checkin';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objCheckin = new Checkin();
		}else{
        	$objCheckin = Checkin::LoadById($strName);
		}
      
        if(!is_null($objCheckin)){
        	return new MLCEntityModelCheckinObject($objCheckin);
        }else{
            throw new MLCEntityModelException("No Checkin found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(Checkin::LoadAll()->GetCollection());
         $objResponse->BodyType = 'Checkin';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>