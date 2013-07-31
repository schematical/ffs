<?php
class MLCEntityModelMDEEnviromentObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'MDEEnviroment';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
	       	case('MDEProject'):
				//Load 
				$objMDEProject = $this->GetEntity()->IdProject;
				return new MLCEntityModelMDEProjectObject($objIdProject);
		    break;
		    
			
	     	case('MDEChanges'):
	       		$arrMDEChanges = MDEChange::LoadCollByIdEnviroment($this->GetEntity()->idEnviroment)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrMDEChanges);
	       		$objResponse->BodyType = 'MDEChange';
	       		return $objResponse;
	    	break;
			
	     	case('MDEDeployments'):
	       		$arrMDEDeployments = MDEDeployment::LoadCollByIdEnviroment($this->GetEntity()->idEnviroment)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrMDEDeployments);
	       		$objResponse->BodyType = 'MDEDeployment';
	       		return $objResponse;
	    	break;
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}