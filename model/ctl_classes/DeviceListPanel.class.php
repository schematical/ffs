<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/DeviceListPanelBase.class.php");
class DeviceListPanel extends DeviceListPanelBase {

    public function __construct($objParentControl, $arrDevices = array()){

		parent::__construct($objParentControl, $arrDevices = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idDevice','idDevice');
            
            
        
            
            
            $this->AddColumn('name','name');
            
        
            
            
            $this->AddColumn('token','token');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('inviteEmail','inviteEmail');
            
        
    }
    */


}


?>