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
* - InitRowClickEntityRelAction()
* - objRow_click()
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
        $this->AddColumn('idAthelete', ' Id Athelete', null, null, 'MJaxTextBox');
        $this->AddColumn('idCompetition', ' Id Competition', null, null, 'MJaxTextBox');
        $this->AddColumn('idSession', ' Id Session', null, null, 'MJaxTextBox');
        $this->AddColumn('flight', ' Flight', null, null, 'MJaxTextBox');
        $this->AddColumn('division', ' Division', null, null, 'MJaxTextBox');
        $this->AddColumn('ageGroup', ' Age Group', null, null, 'MJaxTextBox');
        $this->AddColumn('misc1', ' Misc 1', null, null, 'MJaxTextBox');
        $this->AddColumn('misc2', ' Misc 2', null, null, 'MJaxTextBox');
        $this->AddColumn('misc3', ' Misc 3', null, null, 'MJaxTextBox');
        $this->AddColumn('misc4', ' Misc 4', null, null, 'MJaxTextBox');
        $this->AddColumn('misc5', ' Misc 5', null, null, 'MJaxTextBox');
        $this->AddColumn('creDate', ' Cre Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('level', ' Level', null, null, 'MJaxTextBox');
    }
    /*
    Old stuff
    */
    public function InitRowClickEntityRelAction() {
        foreach ($this->Rows as $intIndex => $objRow) {
            $objRow->AddAction($this, 'objRow_click');
        }
    }
    public function objRow_click($strFomrId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Enrollment/' . $strActionParameter);
    }
}
?>