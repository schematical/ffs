<?php
class MLCApiCheckinObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Checkin';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('User'):
					//Load 
					$objUser = $this->GetEntity()->IdUser;
					return new MLCApiUserObject($objIdUser);
			    break;
			    
		       	case('Venue'):
					//Load 
					$objVenue = $this->GetEntity()->IdVenue;
					return new MLCApiVenueObject($objIdVenue);
			    break;
			    
		       	case('CheckinType'):
					//Load 
					$objCheckinType = $this->GetEntity()->IdCheckinType;
					return new MLCApiCheckinTypeObject($objIdCheckinType);
			    break;
			    
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}