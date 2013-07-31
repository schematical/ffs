<?php
class MLCApiAssignmentObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Assignment';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}