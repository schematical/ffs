<?php
class MLCApiDeviceObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Device';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}