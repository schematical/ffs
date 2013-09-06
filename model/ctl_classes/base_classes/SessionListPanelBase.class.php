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
* - lnkViewAssignments_click()
* - lnkViewEnrollments_click()
* - lnkViewResults_click()
* - render_idCompetition()
* Classes list:
* - SessionListPanelBase extends MJaxTable
*/
class SessionListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrSessions = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrSessions);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objSession = Session::LoadById($strActionParameter);
        if (!is_null($objSession)) {
            $objSession->markDeleted();
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
        //$this->AddColumn('idSession','idSession');
        $this->AddColumn('IdCompetitionObject', ' Competition');
        $this->AddColumn('name', ' Name', null, null, 'MJaxTextBox');
        $this->AddColumn('notes', ' Notes', null, null, 'MJaxTextArea');
        $this->AddColumn('equipmentSet', ' Equipment Set', null, null, 'MJaxTextBox');
        $this->InitRowControl('view_Assignments', 'View Assignments', $this, 'lnkViewAssignments_click', 'btn btn-small');
        $this->InitRowControl('view_Enrollments', 'View Enrollments', $this, 'lnkViewEnrollments_click', 'btn btn-small');
        $this->InitRowControl('view_Results', 'View Results', $this, 'lnkViewResults_click', 'btn btn-small');
    }
    public function lnkViewAssignments_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editAssignment', array(
            FFSQS::Session_IdSession => $strActionParameter
        ));
    }
    public function lnkViewEnrollments_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editEnrollment', array(
            FFSQS::Session_IdSession => $strActionParameter
        ));
    }
    public function lnkViewResults_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editResult', array(
            FFSQS::Session_IdSession => $strActionParameter
        ));
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