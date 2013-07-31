<?php
class MLCApiUserObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'User';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
		     	case('checkins'):
		       		$arrCheckins = Checkin::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
		       		return new MLCApiResponse($arrCheckins);
		    	break;
				
		     	case('consumers'):
		       		$arrConsumers = Consumer::LoadCollByIdConsumer($this->GetEntity()->idConsumer)->GetCollection();
		       		return new MLCApiResponse($arrConsumers);
		    	break;
				
		     	case('teams'):
		       		$arrTeams = Team::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
		       		return new MLCApiResponse($arrTeams);
		    	break;
				
		     	case('teammembers'):
		       		$arrTeamMembers = TeamMember::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
		       		return new MLCApiResponse($arrTeamMembers);
		    	break;
				
		     	case('venues'):
		       		$arrVenues = Venue::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
		       		return new MLCApiResponse($arrVenues);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}