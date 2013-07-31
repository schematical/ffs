<?php
class MLCApiTestAssBHonkerObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'TestAssBHonker';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}