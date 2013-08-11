<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/EnrollmentListPanelBase.class.php");
class EnrollmentListPanel extends EnrollmentListPanelBase {

    public function __construct($objParentControl, $arrEnrollments = array()){

		parent::__construct($objParentControl, $arrEnrollments = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idEnrollment','idEnrollment');
            
            
        
            
            
            $this->AddColumn('idAthelete','idAthelete');
            
        
            
            
            $this->AddColumn('idCompetition','idCompetition');
            
        
            
            
            $this->AddColumn('idSession','idSession');
            
        
            
            
            $this->AddColumn('flight','flight');
            
        
            
            
            $this->AddColumn('division','division');
            
        
            
            
            $this->AddColumn('ageGroup','ageGroup');
            
        
            
            
            $this->AddColumn('misc1','misc1');
            
        
            
            
            $this->AddColumn('misc2','misc2');
            
        
            
            
            $this->AddColumn('misc3','misc3');
            
        
    }
    */


}


?>