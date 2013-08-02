<?php
class MLCApiSessionObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Session';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('Session'):
					//Load 
					$objCompetition = $this->GetEntity()->IdCompetition;
					return new MLCApiCompetitionObject($objIdCompetition);
			    break;
			    
				
		     	case('results'):
		       		$arrResults = Result::LoadCollByIdSession($this->GetEntity()->idSession)->GetCollection();
		       		return new MLCApiResponse($arrResults);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}