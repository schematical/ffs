<?php
class MLCApiSessionObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Session';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}