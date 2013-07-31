<?php
class MLCApiCompetitionBase extends MLCApiClassBase{
	protected $strClassName = 'Competition';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objCompetition = Competition::LoadById($strName);
        }else{
            $objCompetition = null;
        }

      
        if(!is_null($objCompetition)){
        	return new MLCApiCompetitionObject($objCompetition);
        }else{
            throw new MLCApiException("No Competition found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>