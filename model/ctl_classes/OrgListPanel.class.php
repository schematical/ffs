<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/OrgListPanelBase.class.php");
class OrgListPanel extends OrgListPanelBase {

    public function __construct($objParentControl, $arrOrgs = array()){

		parent::__construct($objParentControl, $arrOrgs = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idOrg','idOrg');
            
            
        
            
            
            $this->AddColumn('namespace','namespace');
            
        
            
            
            $this->AddColumn('name','name');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
    }
    */


}


?>