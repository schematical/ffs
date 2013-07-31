<?php
class MLCApiTestAssTieObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'TestAssTie';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('TestAssBananas'):
					//Load 
					$objTestAssBananas = $this->GetEntity()->IdTestAssBananas;
					return new MLCApiTestAssBananasObject($objIdTestAssBananas);
			    break;
			    
				
		     	case('TestAssHats'):
		       		$arrTestAssHats = TestAssHat::LoadCollByIdTestAssTie($this->GetEntity()->idTestAssTie)->GetCollection();
		       		return new MLCApiResponse($arrTestAssHats);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}