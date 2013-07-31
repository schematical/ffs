<?php
class MLCApiResultObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Result';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}