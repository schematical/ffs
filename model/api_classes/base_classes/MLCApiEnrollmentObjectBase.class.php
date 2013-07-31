<?php
class MLCApiEnrollmentObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Enrollment';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}