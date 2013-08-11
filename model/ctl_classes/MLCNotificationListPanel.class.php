<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/MLCNotificationListPanelBase.class.php");
class MLCNotificationListPanel extends MLCNotificationListPanelBase {

    public function __construct($objParentControl, $arrMLCNotifications = array()){

		parent::__construct($objParentControl, $arrMLCNotifications = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idNotification','idNotification');
            
            
        
            
            
            $this->AddColumn('idUser','idUser');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('className','className');
            
        
            
            
            $this->AddColumn('data','data');
            
        
            
            
            $this->AddColumn('viewed','viewed');
            
        
    }
    */


}


?>