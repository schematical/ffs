<?php
class MLCApiOrgObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Org';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
		     	case('competitions'):
		       		$arrCompetitions = Competition::LoadCollByIdOrg($this->GetEntity()->idOrg)->GetCollection();
		       		return new MLCApiResponse($arrCompetitions);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}