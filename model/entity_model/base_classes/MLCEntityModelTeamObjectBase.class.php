<?php
class MLCEntityModelTeamObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'Team';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
	       	case('User'):
				//Load 
				$objUser = $this->GetEntity()->IdUser;
				return new MLCEntityModelUserObject($objIdUser);
		    break;
		    
			
	     	case('TeamMembers'):
	       		$arrTeamMembers = TeamMember::LoadCollByIdTeam($this->GetEntity()->idTeam)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrTeamMembers);
	       		$objResponse->BodyType = 'TeamMember';
	       		return $objResponse;
	    	break;
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}