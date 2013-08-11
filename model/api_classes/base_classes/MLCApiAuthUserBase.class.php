<?php
class MLCApiAuthUserBase extends MLCApiClassBase{
	protected $strClassName = 'AuthUser';
	
	public function  __call($strName, $arrArguments) {
       
		$arrReturn = array();
		if(is_numeric($strName){
            $objAuthUser = AuthUser::LoadById($strName);
        }else{
            $objAuthUser = null;
        }

      
        if(!is_null($objAuthUser)){
        	return new MLCApiAuthUserObject($objAuthUser);
        }else{
            throw new MLCApiException("No AuthUser found with the data you submitted");
        }
        
     }

    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
?>