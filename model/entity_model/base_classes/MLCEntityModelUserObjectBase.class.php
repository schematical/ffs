<?php
class MLCEntityModelUserObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'User';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
			
	     	case('Checkins'):
	       		$arrCheckins = Checkin::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrCheckins);
	       		$objResponse->BodyType = 'Checkin';
	       		return $objResponse;
	    	break;
			
	     	case('Consumers'):
	       		$arrConsumers = Consumer::LoadCollByIdConsumer($this->GetEntity()->idConsumer)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrConsumers);
	       		$objResponse->BodyType = 'Consumer';
	       		return $objResponse;
	    	break;
			
	     	case('Teams'):
	       		$arrTeams = Team::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrTeams);
	       		$objResponse->BodyType = 'Team';
	       		return $objResponse;
	    	break;
			
	     	case('TeamMembers'):
	       		$arrTeamMembers = TeamMember::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrTeamMembers);
	       		$objResponse->BodyType = 'TeamMember';
	       		return $objResponse;
	    	break;
			
	     	case('Venues'):
	       		$arrVenues = Venue::LoadCollByIdUser($this->GetEntity()->idUser)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrVenues);
	       		$objResponse->BodyType = 'Venue';
	       		return $objResponse;
	    	break;
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}