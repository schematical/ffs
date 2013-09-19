<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/AtheleteListPanelBase.class.php");
class AtheleteListPanel extends AtheleteListPanelBase {

    public function __construct($objParentControl, $arrAtheletes = array()){

		parent::__construct($objParentControl, $arrAtheletes);
        $this->AddCssClass('table table-striped table-bordered table-condensed');

	}

	public function SetupCols(){

            //$this->AddColumn('idAthelete','idAthelete');

            $clmOrg = $this->AddColumn('orgName','Gym');
            $clmOrg->RenderObject = $this;
            $clmOrg->RenderFunction = 'render_orgName';




            $colAthelete = $this->AddColumn('name','Name', $this, 'render_name');
            $colAthelete->RenderObject = $this;
            $colAthelete->RenderFunction = 'render_name';

            //$this->AddColumn('lastName','lastName');
            
            $colBirth = $this->AddColumn('birthDate','Birth', $this, 'render_birthDate');
            $colBirth->RenderObject = $this;
            $colBirth->RenderFunction = 'render_name';
            $this->AddColumn('memId','Mem#');
            $this->AddColumn('level','Level');
            
        
    }
    public function render_orgName($strData, $objRow){
        $objAthelete = $objRow->GetData('_entity');
        if(is_null($objAthelete)){
            return '';
        }
        if(is_null($objAthelete->IdOrg)){
            return '';
        }
        $objOrg =  Org::LoadById($objAthelete->IdOrg);
        if(is_null($objOrg)){
           return '';
        }
        return $objOrg->Name;
    }
    public function render_name($strData, $objRow){
        $objAthelete = $objRow->GetData('_entity');
        if(is_null($objAthelete)){
            return '';
        }
        return $objAthelete->__toString();
    }
    public function render_birthDate($strData, $objRow){
        return date('m/d/y', strtotime($strData));
    }


}


?>