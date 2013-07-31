<?php
class MLCApiMDEChangeObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'MDEChange';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('MDEEnviroment'):
					//Load 
					$objMDEEnviroment = $this->GetEntity()->IdEnviroment;
					return new MLCApiMDEEnviromentObject($objIdEnviroment);
			    break;
			    
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}