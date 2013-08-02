<?php
class MLCApiEnrollmentObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Enrollment';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('Enrollment'):
					//Load 
					$objAthelete = $this->GetEntity()->IdAthelete;
					return new MLCApiAtheleteObject($objIdAthelete);
			    break;
			    
		       	case('Enrollment'):
					//Load 
					$objCompetition = $this->GetEntity()->IdCompetition;
					return new MLCApiCompetitionObject($objIdCompetition);
			    break;
			    
		       	case('Enrollment'):
					//Load 
					$objSession = $this->GetEntity()->IdSession;
					return new MLCApiSessionObject($objIdSession);
			    break;
			    
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}