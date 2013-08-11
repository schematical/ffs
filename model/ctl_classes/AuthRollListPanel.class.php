<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/AuthRollListPanelBase.class.php");
class AuthRollListPanel extends AuthRollListPanelBase {

    public function __construct($objParentControl, $arrAuthRolls = array()){

		parent::__construct($objParentControl, $arrAuthRolls = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idAuthRoll','idAuthRoll');
            
            
        
            
            
            $this->AddColumn('idAuthUser','idAuthUser');
            
        
            
            
            $this->AddColumn('idEntity','idEntity');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('entityType','entityType');
            
        
            
            
            $this->AddColumn('rollType','rollType');
            
        
            
            
            $this->AddColumn('data','data');
            
        
    }
    */


}


?>