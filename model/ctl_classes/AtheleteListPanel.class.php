<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/AtheleteListPanelBase.class.php");
class AtheleteListPanel extends AtheleteListPanelBase {

    public function __construct($objParentControl, $arrAtheletes = array()){

		parent::__construct($objParentControl, $arrAtheletes = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idAthelete','idAthelete');
            
            
        
            
            
            $this->AddColumn('idOrg','idOrg');
            
        
            
            
            $this->AddColumn('firstName','firstName');
            
        
            
            
            $this->AddColumn('lastName','lastName');
            
        
            
            
            $this->AddColumn('birthDate','birthDate');
            
        
    }
    */


}


?>