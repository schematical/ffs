<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/SessionListPanelBase.class.php");
class SessionListPanel extends SessionListPanelBase {

    public function __construct($objParentControl, $arrSessions = array()){

		parent::__construct($objParentControl, $arrSessions = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idSession','idSession');
            
            
        
            
            
            $this->AddColumn('startDate','startDate');
            
        
            
            
            $this->AddColumn('endDate','endDate');
            
        
            
            
            $this->AddColumn('idCompetition','idCompetition');
            
        
            
            
            $this->AddColumn('name','name');
            
        
            
            
            $this->AddColumn('notes','notes');
            
        
            
            
            $this->AddColumn('data','data');
            
        
    }
    */


}


?>