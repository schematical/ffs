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
* - render_idAthelete()
* - render_idCompetition()
* - render_idSession()
* Classes list:
* - EnrollmentListPanelBase extends MJaxTable
*/
class EnrollmentListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrEnrollments = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrEnrollments);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objEnrollment = Enrollment::LoadById($strActionParameter);
        if (!is_null($objEnrollment)) {
            $objEnrollment->markDeleted();
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
        //$this->AddColumn('idEnrollment','idEnrollment');
        $this->AddColumn('idAthelete', ' Athelete', $this, 'render_idAthelete', 'MJaxTextBox');
        $this->AddColumn('idCompetition', ' Competition', $this, 'render_idCompetition', 'MJaxTextBox');
        $this->AddColumn('idSession', ' Session', $this, 'render_idSession', 'MJaxTextBox');
        $this->AddColumn('flight', ' Flight', null, null, 'MJaxTextBox');
        $this->AddColumn('division', ' Division', null, null, 'MJaxTextBox');
        $this->AddColumn('ageGroup', ' Age Group', null, null, 'MJaxTextBox');
        $this->AddColumn('misc1', ' Misc 1', null, null, 'MJaxTextBox');
        $this->AddColumn('misc2', ' Misc 2', null, null, 'MJaxTextBox');
        $this->AddColumn('misc3', ' Misc 3', null, null, 'MJaxTextBox');
        $this->AddColumn('misc4', ' Misc 4', null, null, 'MJaxTextBox');
        $this->AddColumn('misc5', ' Misc 5', null, null, 'MJaxTextBox');
        $this->AddColumn('level', ' Level', null, null, 'MJaxTextBox');
    }
    public function render_idAthelete($intIdIdAthelete, $objRow, $objColumn) {
        if (is_null($intIdIdAthelete)) {
            return '';
        }
        $objAthelete = Athelete::LoadById($intIdIdAthelete);
        if (is_null($objAthelete)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objAthelete->__toString();
        $lnkView->Href = '/data/editAthelete?' . FFSQS::Athelete_IdAthelete . '=' . $objAthelete->IdAthelete;
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
    public function render_idSession($intIdIdSession, $objRow, $objColumn) {
        if (is_null($intIdIdSession)) {
            return '';
        }
        $objSession = Session::LoadById($intIdIdSession);
        if (is_null($objSession)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objSession->__toString();
        $lnkView->Href = '/data/editSession?' . FFSQS::Session_IdSession . '=' . $objSession->IdSession;
        return $lnkView->Render(false);
    }
}
?>