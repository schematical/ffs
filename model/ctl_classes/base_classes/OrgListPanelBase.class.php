<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - InitRemoveButtons()
* - lnkRemove_click()
* - RenderDate()
* - RenderTime()
* - SetupCols()
* - lnkViewAtheletes_click()
* - lnkViewCompetitions_click()
* - lnkViewDevices_click()
* - lnkViewOrgCompetitions_click()
* Classes list:
* - OrgListPanelBase extends MJaxTable
*/
class OrgListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrOrgs = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrOrgs);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objOrg = Org::LoadById($strActionParameter);
        if (!is_null($objOrg)) {
            $objOrg->markDeleted();
        }
        foreach ($this->Rows as $intIndex => $objRow) {
            if ($objRow->ActionParameter == $strActionParameter) {
                $objRow->Remove();
                //unset($this->Rows[$intIndex]);
                $this->blnModified = true;
                return;
            }
        }
    }
    public function RenderDate($strData, $objRow) {
        return date_format(new DateTime($strData) , 'm/d/y');
    }
    public function RenderTime($strData, $objRow) {
        return date_format(new DateTime($strData) , 'h:i');
    }
    public function SetupCols() {
        //$this->AddColumn('idOrg','idOrg');
        $this->AddColumn('namespace', ' Namespace', null, null, 'MJaxTextBox');
        $this->AddColumn('name', ' Name', null, null, 'MJaxTextBox');
        $this->AddColumn('idImportAuthUser', ' Import Auth User', null, null, 'MJaxTextBox');
        $this->AddColumn('clubNum', ' Club Num', null, null, 'MJaxTextBox');
        $this->AddColumn('clubType', ' Club Type', null, null, 'MJaxTextBox');
        $this->InitRowControl('view_Atheletes', 'View Atheletes', $this, 'lnkViewAtheletes_click', 'btn btn-small');
        $this->InitRowControl('view_Competitions', 'View Competitions', $this, 'lnkViewCompetitions_click', 'btn btn-small');
        $this->InitRowControl('view_Devices', 'View Devices', $this, 'lnkViewDevices_click', 'btn btn-small');
        $this->InitRowControl('view_OrgCompetitions', 'View OrgCompetitions', $this, 'lnkViewOrgCompetitions_click', 'btn btn-small');
    }
    public function lnkViewAtheletes_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editAthelete', array(
            FFSQS::Org_IdOrg => $strActionParameter
        ));
    }
    public function lnkViewCompetitions_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editCompetition', array(
            FFSQS::Org_IdOrg => $strActionParameter
        ));
    }
    public function lnkViewDevices_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editDevice', array(
            FFSQS::Org_IdOrg => $strActionParameter
        ));
    }
    public function lnkViewOrgCompetitions_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editOrgCompetition', array(
            FFSQS::Org_IdOrg => $strActionParameter
        ));
    }
}
?>