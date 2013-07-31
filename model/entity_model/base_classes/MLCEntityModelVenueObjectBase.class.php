<?php
class MLCEntityModelVenueObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'Venue';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
	       	case('User'):
				//Load 
				$objUser = $this->GetEntity()->IdUser;
				return new MLCEntityModelUserObject($objIdUser);
		    break;
		    
			
	     	case('Checkins'):
	       		$arrCheckins = Checkin::LoadCollByIdVenue($this->GetEntity()->idVenue)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrCheckins);
	       		$objResponse->BodyType = 'Checkin';
	       		return $objResponse;
	    	break;
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}