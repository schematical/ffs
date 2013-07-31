<?php
class MLCApiVenueObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Venue';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('User'):
					//Load 
					$objUser = $this->GetEntity()->IdUser;
					return new MLCApiUserObject($objIdUser);
			    break;
			    
				
		     	case('checkins'):
		       		$arrCheckins = Checkin::LoadCollByIdVenue($this->GetEntity()->idVenue)->GetCollection();
		       		return new MLCApiResponse($arrCheckins);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}