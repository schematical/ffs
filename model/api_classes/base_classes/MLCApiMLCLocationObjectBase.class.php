<?php
class MLCApiMLCLocationObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'MLCLocation';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('MLCLocation'):
					//Load 
					$objAuthAccount = $this->GetEntity()->IdAccount;
					return new MLCApiAuthAccountObject($objIdAccount);
			    break;
			    
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}