<?php
class MLCApiTestAssBananasObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'TestAssBananas';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('AuthAccount'):
					//Load 
					$objAuthAccount = $this->GetEntity()->IdAccount;
					return new MLCApiAuthAccountObject($objIdAccount);
			    break;
			    
				
		     	case('TestAssTies'):
		       		$arrTestAssTies = TestAssTie::LoadCollByIdTestAssBananas($this->GetEntity()->idTestAssBananas)->GetCollection();
		       		return new MLCApiResponse($arrTestAssTies);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}