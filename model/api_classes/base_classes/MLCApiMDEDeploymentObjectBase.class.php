<?php
class MLCApiMDEDeploymentObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'MDEDeployment';
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