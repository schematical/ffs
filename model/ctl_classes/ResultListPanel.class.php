<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/ResultListPanelBase.class.php");
class ResultListPanel extends ResultListPanelBase {

    public function __construct($objParentControl, $arrResults = array()){

		parent::__construct($objParentControl, $arrResults = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idResult','idResult');
            
            
        
            
            
            $this->AddColumn('idSession','idSession');
            
        
            
            
            $this->AddColumn('idAthelete','idAthelete');
            
        
            
            
            $this->AddColumn('score','score');
            
        
            
            
            $this->AddColumn('judge','judge');
            
        
            
            
            $this->AddColumn('flag','flag');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
    }
    */


}


?>