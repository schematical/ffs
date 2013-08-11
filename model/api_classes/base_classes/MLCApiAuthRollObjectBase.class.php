<?php
class MLCApiAuthRollObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'AuthRoll';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}