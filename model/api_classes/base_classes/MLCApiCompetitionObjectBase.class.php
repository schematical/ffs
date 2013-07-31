<?php
class MLCApiCompetitionObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Competition';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}