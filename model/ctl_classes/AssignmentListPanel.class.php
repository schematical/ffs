<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/AssignmentListPanelBase.class.php");
class AssignmentListPanel extends AssignmentListPanelBase {

    public function __construct($objParentControl, $arrAssignments = array()){

		parent::__construct($objParentControl, $arrAssignments = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idAssignment','idAssignment');
            
            
        
            
            
            $this->AddColumn('idDevice','idDevice');
            
        
            
            
            $this->AddColumn('idSession','idSession');
            
        
            
            
            $this->AddColumn('event','event');
            
        
            
            
            $this->AddColumn('apartatus','apartatus');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('idUser','idUser');
            
        
            
            
            $this->AddColumn('revokeDate','revokeDate');
            
        
    }
    */


}


?>