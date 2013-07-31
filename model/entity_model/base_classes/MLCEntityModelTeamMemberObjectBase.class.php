<?php
class MLCEntityModelTeamMemberObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'TeamMember';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
	       	case('Team'):
				//Load 
				$objTeam = $this->GetEntity()->IdTeam;
				return new MLCEntityModelTeamObject($objIdTeam);
		    break;
		    
	       	case('User'):
				//Load 
				$objUser = $this->GetEntity()->IdUser;
				return new MLCEntityModelUserObject($objIdUser);
		    break;
		    
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}