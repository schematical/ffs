<?php
class MLCApiHomeBase extends MLCApiClassBase{
	public function __construct(){
		MLCApiAuthDriver::Authenticate(true);
	}
	
    public function MDEProject(){
        return new MLCApiMDEProject();
    }
    
}

MLCApplicationBase::$arrClasses['MLCApiMDEProject'] = DATALAYER_DIR . '/MLCApiMDEProject.class.php';


?>