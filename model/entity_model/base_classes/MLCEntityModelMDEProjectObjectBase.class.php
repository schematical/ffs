<?php
class MLCEntityModelMDEProjectObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'MDEProject';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
			
	     	case('MDEEnviroments'):
	       		$arrMDEEnviroments = MDEEnviroment::LoadCollByIdProject($this->GetEntity()->idProject)->GetCollection();
	       		$objResponse = new MLCEntityModelResponse($arrMDEEnviroments);
	       		$objResponse->BodyType = 'MDEEnviroment';
	       		return $objResponse;
	    	break;
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}