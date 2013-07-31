<?php
class MLCApiTestNewTableObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'TestNewTable';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}