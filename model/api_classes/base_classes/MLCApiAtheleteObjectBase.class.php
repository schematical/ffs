<?php
class MLCApiAtheleteObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Athelete';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}