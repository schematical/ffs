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
* - render_idOrg()
* - render_idCompetition()
* Classes list:
* - OrgCompetitionListPanelBase extends MJaxTable
*/
class OrgCompetitionListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrOrgCompetitions = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrOrgCompetitions);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objOrgCompetition = OrgCompetition::LoadById($strActionParameter);
        if (!is_null($objOrgCompetition)) {
            $objOrgCompetition->markDeleted();
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
        //$this->AddColumn('idOrgCompetition','idOrgCompetition');
        $this->AddColumn('IdOrgObject', ' Org');
        $this->AddColumn('IdCompetitionObject', ' Competition');
        $this->AddColumn('idAuthUser', ' Auth User', null, null, 'MJaxTextBox');
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
    public function render_idCompetition($intIdIdCompetition, $objRow, $objColumn) {
        if (is_null($intIdIdCompetition)) {
            return '';
        }
        $objCompetition = Competition::LoadById($intIdIdCompetition);
        if (is_null($objCompetition)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objCompetition->__toString();
        $lnkView->Href = '/data/editCompetition?' . FFSQS::Competition_IdCompetition . '=' . $objCompetition->IdCompetition;
        return $lnkView->Render(false);
    }
}
?>