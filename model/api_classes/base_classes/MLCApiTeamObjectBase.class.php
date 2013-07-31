<?php
class MLCApiTeamObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Team';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('User'):
					//Load 
					$objUser = $this->GetEntity()->IdUser;
					return new MLCApiUserObject($objIdUser);
			    break;
			    
				
		     	case('teammembers'):
		       		$arrTeamMembers = TeamMember::LoadCollByIdTeam($this->GetEntity()->idTeam)->GetCollection();
		       		return new MLCApiResponse($arrTeamMembers);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}