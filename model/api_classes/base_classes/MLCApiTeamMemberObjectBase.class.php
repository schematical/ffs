<?php
class MLCApiTeamMemberObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'TeamMember';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('Team'):
					//Load 
					$objTeam = $this->GetEntity()->IdTeam;
					return new MLCApiTeamObject($objIdTeam);
			    break;
			    
		       	case('User'):
					//Load 
					$objUser = $this->GetEntity()->IdUser;
					return new MLCApiUserObject($objIdUser);
			    break;
			    
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}