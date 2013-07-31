<?php
class MLCEntityModelConsumerObjectBase extends MLCEntityModelObjectBase{
   
    protected $strClassName = 'Consumer';
	public function  __call($strName, $arrArguments) {
		switch($strName){
			
	       	case('User'):
				//Load 
				$objUser = $this->GetEntity()->IdConsumer;
				return new MLCEntityModelUserObject($objIdConsumer);
		    break;
		    
			
			default:
				return parent::__call($strName, $arrArguments);
			
		}
	}
	
    
   
   
   	
}