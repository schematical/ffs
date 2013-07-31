<?php
class MLCEntityModelTeamMemberBase extends MLCEntityModelClassBase{
	protected $strClassName = 'TeamMember';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if($strName == 'new'){
			$objTeamMember = new TeamMember();
		}else{
        	$objTeamMember = TeamMember::LoadById($strName);
		}
      
        if(!is_null($objTeamMember)){
        	return new MLCEntityModelTeamMemberObject($objTeamMember);
        }else{
            throw new MLCEntityModelException("No TeamMember found with the data you submitted");
        }
        
     }
     public function FinalAction($arrPostData){
         $objResponse = new MLCEntityModelResponse(TeamMember::LoadAll()->GetCollection());
         $objResponse->BodyType = 'TeamMember';
		 return $objResponse;
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>