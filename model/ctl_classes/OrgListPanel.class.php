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

    public function SetupCols() {
        //$this->AddColumn('idOrg','idOrg');
        //$this->AddColumn('namespace', ' Namespace', null, null, 'MJaxTextBox');
        $this->AddColumn('name', ' Name', null, null, 'MJaxTextBox');
        //$this->AddColumn('idImportAuthUser', ' Import Auth User', null, null, 'MJaxTextBox');
        $this->AddColumn('clubNum', ' Club Num', null, null, 'MJaxTextBox');
        $this->AddColumn('clubType', ' Club Type', null, null, 'MJaxTextBox');
        //$this->InitRowControl('view_Atheletes', 'View Atheletes', $this, 'lnkViewAtheletes_click', 'btn btn-small');
        //$this->InitRowControl('view_Competitions', 'View Competitions', $this, 'lnkViewCompetitions_click', 'btn btn-small');
        //$this->InitRowControl('view_Devices', 'View Devices', $this, 'lnkViewDevices_click', 'btn btn-small');
        //$this->InitRowControl('view_OrgCompetitions', 'View OrgCompetitions', $this, 'lnkViewOrgCompetitions_click', 'btn btn-small');
    }
    public function lnkViewAtheletes_click($strFormId, $strControlId, $strActionParameter) {
        if(is_null(FFSForm::Competition())){
            $strUrl = '/org/competition/manageAthletes';
        }else{
            $strUrl = '/' . FFSForm::Competition()->Namespace .'/org/competition/manageAthletes';
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