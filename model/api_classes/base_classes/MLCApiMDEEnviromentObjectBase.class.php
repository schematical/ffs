<?php
class MLCApiMDEEnviromentObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'MDEEnviroment';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('MDEProject'):
					//Load 
					$objMDEProject = $this->GetEntity()->IdProject;
					return new MLCApiMDEProjectObject($objIdProject);
			    break;
			    
				
		     	case('MDEChanges'):
		       		$arrMDEChanges = MDEChange::LoadCollByIdEnviroment($this->GetEntity()->idEnviroment)->GetCollection();
		       		return new MLCApiResponse($arrMDEChanges);
		    	break;
				
		     	case('MDEDeployments'):
		       		$arrMDEDeployments = MDEDeployment::LoadCollByIdEnviroment($this->GetEntity()->idEnviroment)->GetCollection();
		       		return new MLCApiResponse($arrMDEDeployments);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}