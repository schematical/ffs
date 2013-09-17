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
* - lnkViewEnrollments_click()
* - lnkViewOrgCompetitions_click()
* - lnkViewParentMessages_click()
* - lnkViewResults_click()
* - lnkViewSessions_click()
* - render_idOrg()
* Classes list:
* - CompetitionListPanelBase extends MJaxTable
*/
class CompetitionListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrCompetitions = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrCompetitions);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objCompetition = Competition::LoadById($strActionParameter);
        if (!is_null($objCompetition)) {
            $objCompetition->markDeleted();
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
        //$this->AddColumn('idCompetition','idCompetition');
        $this->AddColumn('name', ' Name', null, null, 'MJaxTextBox');
        $this->AddColumn('longDesc', ' Long Desc', null, null, 'MJaxTextArea');
        $this->AddColumn('IdOrgObject', ' Org');
        $this->AddColumn('namespace', ' Namespace', null, null, 'MJaxTextBox');
        $this->AddColumn('clubType', ' Club Type', null, null, 'MJaxTextBox');
        $this->AddColumn('sanctioned', ' Sanctioned', null, null, 'MJaxTextBox');
        $this->InitRowControl('view_Enrollments', 'View Enrollments', $this, 'lnkViewEnrollments_click', 'btn btn-small');
        $this->InitRowControl('view_OrgCompetitions', 'View OrgCompetitions', $this, 'lnkViewOrgCompetitions_click', 'btn btn-small');
        $this->InitRowControl('view_ParentMessages', 'View ParentMessages', $this, 'lnkViewParentMessages_click', 'btn btn-small');
        $this->InitRowControl('view_Results', 'View Results', $this, 'lnkViewResults_click', 'btn btn-small');
        $this->InitRowControl('view_Sessions', 'View Sessions', $this, 'lnkViewSessions_click', 'btn btn-small');
    }
    public function lnkViewEnrollments_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editEnrollment', array(
            FFSQS::Competition_IdCompetition => $strActionParameter
        ));
    }
    public function lnkViewOrgCompetitions_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editOrgCompetition', array(
            FFSQS::Competition_IdCompetition => $strActionParameter
        ));
    }
    public function lnkViewParentMessages_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editParentMessage', array(
            FFSQS::Competition_IdCompetition => $strActionParameter
        ));
    }
    public function lnkViewResults_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editResult', array(
            FFSQS::Competition_IdCompetition => $strActionParameter
        ));
    }
    public function lnkViewSessions_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editSession', array(
            FFSQS::Competition_IdCompetition => $strActionParameter
        ));
    }
    public function render_idOrg($intIdIdOrg, $objRow, $objColumn) {
        if (is_null($intIdIdOrg)) {
            return '';
        }
        $objOrg = Org::LoadById($intIdIdOrg);
        if (is_null($objOrg)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objOrg->__toString();
        $lnkView->Href = '/data/editOrg?' . FFSQS::Org_IdOrg . '=' . $objOrg->IdOrg;
        return $lnkView->Render(false);
    }
}
?>