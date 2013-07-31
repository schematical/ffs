<?php
class MLCApiCheckinTypeObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'CheckinType';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
		     	case('checkins'):
		       		$arrCheckins = Checkin::LoadCollByIdCheckinType($this->GetEntity()->idCheckinType)->GetCollection();
		       		return new MLCApiResponse($arrCheckins);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}