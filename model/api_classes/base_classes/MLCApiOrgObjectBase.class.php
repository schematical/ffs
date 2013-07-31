<?php
class MLCApiOrgObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Org';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}