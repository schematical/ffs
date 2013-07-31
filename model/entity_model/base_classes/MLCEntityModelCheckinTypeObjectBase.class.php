<?php
class MLCEntityModelCheckinTypeObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'CheckinType';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
			
	     	case('Checkins'):
	       		$arrCheckins = Checkin::LoadCollByIdCheckinType($this->GetEntity()->idCheckinType)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrCheckins);
	       		$objResponse->BodyType = 'Checkin';
	       		return $objResponse;
	    	break;
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}