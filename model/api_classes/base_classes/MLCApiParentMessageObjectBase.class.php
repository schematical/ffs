<?php
class MLCApiParentMessageObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'ParentMessage';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('ParentMessage'):
					//Load 
					$objAthelete = $this->GetEntity()->IdAthelete;
					return new MLCApiAtheleteObject($objIdAthelete);
			    break;
			    
		       	case('ParentMessage'):
					//Load 
					$objCompetition = $this->GetEntity()->IdCompetition;
					return new MLCApiCompetitionObject($objIdCompetition);
			    break;
			    
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}