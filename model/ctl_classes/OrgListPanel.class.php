<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - OrgListPanel extends OrgListPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/OrgListPanelBase.class.php");
class OrgListPanel extends OrgListPanelBase {
    public function __construct($objParentControl, $arrOrgs = array()) {
        parent::__construct($objParentControl, $arrOrgs);
        $this->AddCssClass('table table-striped table-bordered table-condensed');
    }
    /*
    public function SetupCols(){
            $this->AddColumn('idOrg','idOrg');
            $this->AddColumn('namespace','namespace');
            $this->AddColumn('name','name');
            $this->AddColumn('creDate','creDate');
            $this->AddColumn('psData','psData');
            $this->AddColumn('idImportAuthUser','idImportAuthUser');
            $this->AddColumn('clubNum','clubNum');
    }
    */
    public function lnkViewAtheletes_click($strFormId, $strControlId, $strActionParameter) {
        if(is_null(FFSForm::$objCompetition)){
            $strUrl = '/org/competition/manageAthletes';
        }else{
            $strUrl = '/' . FFSForm::$objCompetition->Namespace .'/org/competition/manageAthletes';
        }
        $this->objForm->Redirect(
            $strUrl,
            array(
                FFSQS::Org_IdOrg => $strActionParameter
            )
        );
    }
}
?>