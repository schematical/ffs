<?php
class MLCApiTeamMemberBase extends MLCApiClassBase{
	protected $strClassName = 'TeamMember';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
        $objTeamMember = TeamMember::LoadById($strName);
	
      
        if(!is_null($objTeamMember)){
        	return new MLCApiTeamMemberObject($objTeamMember);
        }else{
            throw new MLCApiException("No TeamMember found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>