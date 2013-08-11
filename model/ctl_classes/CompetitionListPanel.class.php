<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/CompetitionListPanelBase.class.php");
class CompetitionListPanel extends CompetitionListPanelBase {

    public function __construct($objParentControl, $arrCompetitions = array()){

		parent::__construct($objParentControl, $arrCompetitions = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idCompetition','idCompetition');
            
            
        
            
            
            $this->AddColumn('name','name');
            
        
            
            
            $this->AddColumn('longDesc','longDesc');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('startDate','startDate');
            
        
            
            
            $this->AddColumn('endDate','endDate');
            
        
            
            
            $this->AddColumn('idOrg','idOrg');
            
        
            
            
            $this->AddColumn('namespace','namespace');
            
        
    }
    */


}


?>