<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/AtheleteListPanelBase.class.php");
class AtheleteListPanel extends AtheleteListPanelBase {

    public function __construct($objParentControl, $arrAtheletes = array()){

		parent::__construct($objParentControl, $arrAtheletes = array());
        $this->AddCssClass('table table-striped table-bordered table-condensed');

	}

	public function SetupCols(){

            //$this->AddColumn('idAthelete','idAthelete');

            $this->AddColumn('orgName','Gym', $this, 'render_orgName');


            
            
            $this->AddColumn('name','Name', $this, 'render_name');
            
        
            
            
            //$this->AddColumn('lastName','lastName');
            
        
            
            
            $this->AddColumn('birthDate','Birth', $this, 'render_birthDate');
            $this->AddColumn('memId','Mem#');
            $this->AddColumn('level','Level');
            
        
    }
    public function render_orgName($strData, $objRow){
        return Org::LoadById($objRow->GetData('_entity')->IdOrg)->Name;
    }
    public function render_name($strData, $objRow){
        return $objRow->GetData('_entity')->__toString();
    }
    public function render_birthDate($strData, $objRow){
        return date('m/d/y', strtotime($strData));
    }


}


?>