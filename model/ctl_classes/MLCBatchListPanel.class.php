<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/MLCBatchListPanelBase.class.php");
class MLCBatchListPanel extends MLCBatchListPanelBase {

    public function __construct($objParentControl, $arrMLCBatchs = array()){

		parent::__construct($objParentControl, $arrMLCBatchs = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idBatch','idBatch');
            
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('jobName','jobName');
            
        
            
            
            $this->AddColumn('report','report');
            
        
            
            
            $this->AddColumn('idBatchStatus','idBatchStatus');
            
        
    }
    */


}


?>