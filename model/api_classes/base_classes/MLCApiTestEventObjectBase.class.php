<?php
class MLCApiTestEventObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'TestEvent';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}