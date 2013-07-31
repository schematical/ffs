<?php
class MLCApiMDEProjectObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'MDEProject';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
		     	case('MDEEnviroments'):
		       		$arrMDEEnviroments = MDEEnviroment::LoadCollByIdProject($this->GetEntity()->idProject)->GetCollection();
		       		return new MLCApiResponse($arrMDEEnviroments);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}