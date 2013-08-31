<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - SessionListPanel extends SessionListPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/SessionListPanelBase.class.php");
class SessionListPanel extends SessionListPanelBase {
    public function __construct($objParentControl, $arrSessions = array()) {
        parent::__construct($objParentControl, $arrSessions);
        $this->AddCssClass('table table-striped table-bordered table-condensed');
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
            
        
            
            
            $this->AddColumn('equipmentSet','equipmentSet');
            
        
            
            
            $this->AddColumn('eventData','eventData');
            
        
    }
    */
}
?>