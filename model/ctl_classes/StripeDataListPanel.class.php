<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/StripeDataListPanelBase.class.php");
class StripeDataListPanel extends StripeDataListPanelBase {

    public function __construct($objParentControl, $arrStripeDatas = array()){

		parent::__construct($objParentControl, $arrStripeDatas = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idStripeData','idStripeData');
            
            
        
            
            
            $this->AddColumn('data','data');
            
        
            
            
            $this->AddColumn('object','object');
            
        
            
            
            $this->AddColumn('idAuthUser','idAuthUser');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('idParentStripeData','idParentStripeData');
            
        
            
            
            $this->AddColumn('mode','mode');
            
        
            
            
            $this->AddColumn('instance_url','instance_url');
            
        
            
            
            $this->AddColumn('stripeId','stripeId');
            
        
    }
    */


}


?>