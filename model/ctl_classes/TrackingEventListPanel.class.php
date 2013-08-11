<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/TrackingEventListPanelBase.class.php");
class TrackingEventListPanel extends TrackingEventListPanelBase {

    public function __construct($objParentControl, $arrTrackingEvents = array()){

		parent::__construct($objParentControl, $arrTrackingEvents = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idTrackingEvent','idTrackingEvent');
            
            
        
            
            
            $this->AddColumn('name','name');
            
        
            
            
            $this->AddColumn('value','value');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('idUser','idUser');
            
        
            
            
            $this->AddColumn('idSession','idSession');
            
        
            
            
            $this->AddColumn('idApplication','idApplication');
            
        
            
            
            $this->AddColumn('app','app');
            
        
    }
    */


}


?>