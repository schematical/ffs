<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/MLCLocationListPanelBase.class.php");
class MLCLocationListPanel extends MLCLocationListPanelBase {

    public function __construct($objParentControl, $arrMLCLocations = array()){

		parent::__construct($objParentControl, $arrMLCLocations = array());
        $this->AddCssClass('table table-striped table-bordered');

	}
	/*
	public function SetupCols(){
        
            
            $this->AddColumn('idLocation','idLocation');
            
            
        
            
            
            $this->AddColumn('shortDesc','shortDesc');
            
        
            
            
            $this->AddColumn('address1','address1');
            
        
            
            
            $this->AddColumn('address2','address2');
            
        
            
            
            $this->AddColumn('city','city');
            
        
            
            
            $this->AddColumn('state','state');
            
        
            
            
            $this->AddColumn('zip','zip');
            
        
            
            
            $this->AddColumn('country','country');
            
        
            
            
            $this->AddColumn('lat','lat');
            
        
            
            
            $this->AddColumn('lng','lng');
            
        
            
            
            $this->AddColumn('idAccount','idAccount');
            
        
    }
    */


}


?>