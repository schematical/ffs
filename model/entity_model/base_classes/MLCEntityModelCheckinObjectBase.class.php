<?php
class MLCEntityModelCheckinObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'Checkin';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
	       	case('User'):
				//Load 
				$objUser = $this->GetEntity()->IdUser;
				return new MLCEntityModelUserObject($objIdUser);
		    break;
		    
	       	case('Venue'):
				//Load 
				$objVenue = $this->GetEntity()->IdVenue;
				return new MLCEntityModelVenueObject($objIdVenue);
		    break;
		    
	       	case('CheckinType'):
				//Load 
				$objCheckinType = $this->GetEntity()->IdCheckinType;
				return new MLCEntityModelCheckinTypeObject($objIdCheckinType);
		    break;
		    
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}