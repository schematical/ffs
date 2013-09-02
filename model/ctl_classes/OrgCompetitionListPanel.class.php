<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - OrgCompetitionListPanel extends OrgCompetitionListPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/OrgCompetitionListPanelBase.class.php");
class OrgCompetitionListPanel extends OrgCompetitionListPanelBase {
    public function __construct($objParentControl, $arrOrgCompetitions = array()) {
        parent::__construct($objParentControl, $arrOrgCompetitions);
        $this->AddCssClass('table table-striped table-bordered table-condensed');
    }
    /*
    public function SetupCols(){
        
            
            $this->AddColumn('idOrgCompetition','idOrgCompetition');
            
            
        
            
            
            $this->AddColumn('idOrg','idOrg');
            
        
            
            
            $this->AddColumn('idCompetition','idCompetition');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('idAuthUser','idAuthUser');
            
        
    }
    */
}
?>