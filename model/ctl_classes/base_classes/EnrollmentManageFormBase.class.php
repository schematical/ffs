<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - Query()
* - InitSelectPanel()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lnkViewAthelete_click()
* - lnkViewCompetition_click()
* - lnkViewSession_click()
* - lstEnrollment_editInit()
* - lstEnrollment_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - EnrollmentManageFormBase extends FFSForm
*/
class EnrollmentManageFormBase extends FFSForm {
    public $lstEnrollments = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdEnrollment = MLCApplication::QS(FFSQS::Enrollment_IdEnrollment);
        if (!is_null($intIdEnrollment)) {
            $arrAndConditions[] = sprintf('idEnrollment = %s', $intIdEnrollment);
        }
        $intIdAthelete = MLCApplication::QS(FFSQS::Enrollment_IdAthelete);
        if (!is_null($intIdAthelete)) {
            $arrAndConditions[] = sprintf('idAthelete = %s', $intIdAthelete);
        }
        $intIdCompetition = MLCApplication::QS(FFSQS::Enrollment_IdCompetition);
        if (!is_null($intIdCompetition)) {
            $arrAndConditions[] = sprintf('idCompetition = %s', $intIdCompetition);
        }
        $intIdSession = MLCApplication::QS(FFSQS::Enrollment_IdSession);
        if (!is_null($intIdSession)) {
            $arrAndConditions[] = sprintf('idSession = %s', $intIdSession);
        }
        $strFlight = MLCApplication::QS(FFSQS::Enrollment_Flight);
        if (!is_null($strFlight)) {
            $arrAndConditions[] = sprintf('flight LIKE "%s%%"', $strFlight);
        }
        $strDivision = MLCApplication::QS(FFSQS::Enrollment_Division);
        if (!is_null($strDivision)) {
            $arrAndConditions[] = sprintf('division LIKE "%s%%"', $strDivision);
        }
        $strAgeGroup = MLCApplication::QS(FFSQS::Enrollment_AgeGroup);
        if (!is_null($strAgeGroup)) {
            $arrAndConditions[] = sprintf('ageGroup LIKE "%s%%"', $strAgeGroup);
        }
        $strMisc1 = MLCApplication::QS(FFSQS::Enrollment_Misc1);
        if (!is_null($strMisc1)) {
            $arrAndConditions[] = sprintf('misc1 LIKE "%s%%"', $strMisc1);
        }
        $strMisc2 = MLCApplication::QS(FFSQS::Enrollment_Misc2);
        if (!is_null($strMisc2)) {
            $arrAndConditions[] = sprintf('misc2 LIKE "%s%%"', $strMisc2);
        }
        $strMisc3 = MLCApplication::QS(FFSQS::Enrollment_Misc3);
        if (!is_null($strMisc3)) {
            $arrAndConditions[] = sprintf('misc3 LIKE "%s%%"', $strMisc3);
        }
        $strMisc4 = MLCApplication::QS(FFSQS::Enrollment_Misc4);
        if (!is_null($strMisc4)) {
            $arrAndConditions[] = sprintf('misc4 LIKE "%s%%"', $strMisc4);
        }
        $strMisc5 = MLCApplication::QS(FFSQS::Enrollment_Misc5);
        if (!is_null($strMisc5)) {
            $arrAndConditions[] = sprintf('misc5 LIKE "%s%%"', $strMisc5);
        }
        $strLevel = MLCApplication::QS(FFSQS::Enrollment_Level);
        if (!is_null($strLevel)) {
            $arrAndConditions[] = sprintf('level LIKE "%s%%"', $strLevel);
        }
        if (count($arrAndConditions) >= 1) {
            $arrEnrollments = Enrollment::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrEnrollments = array();
        }
        return $arrEnrollments;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new EnrollmentSelectPanel($this);
        /*$this->pnlEdit->AddAction(
                new MJaxDataEntitySaveEvent(),
                new MJaxServerControlAction($this, 'pnlEdit_save')
            );*/
        $wgtEnrollment = $this->AddWidget('Select Enrollment', 'icon-select', $this->pnlSelect);
        $wgtEnrollment->AddCssClass('span6');
        return $wgtEnrollment;
    }
    public function InitEditPanel($objEnrollment = null) {
        $this->pnlEdit = new EnrollmentEditPanel($this, $objEnrollment);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtEnrollment = $this->AddWidget(((is_null($objEnrollment)) ? 'Create Enrollment' : 'Edit Enrollment') , 'icon-edit', $this->pnlEdit);
        $wgtEnrollment->AddCssClass('span6');
        return $wgtEnrollment;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objEnrollment) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objEnrollment) {
    }
    public function InitList($arrEnrollments) {
        $this->lstEnrollments = new EnrollmentListPanel($this, $arrEnrollments);
        $this->lstEnrollments->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstEnrollment_editInit'));
        $this->lstEnrollments->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstEnrollment_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstEnrollments->InitRemoveButtons();
            $this->lstEnrollments->InitEditControls();
            $this->lstEnrollments->AddEmptyRow();
        } else {
            $this->lstEnrollments->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $this->lstEnrollments->InitRowControl('idAthelete', 'View Athelete', $this, 'lnkViewAthelete_click');
        $this->lstEnrollments->InitRowControl('idCompetition', 'View Competition', $this, 'lnkViewCompetition_click');
        $this->lstEnrollments->InitRowControl('idSession', 'View Session', $this, 'lnkViewSession_click');
        $wgtEnrollment = $this->AddWidget('Enrollments', 'icon-ul', $this->lstEnrollments);
        if (!is_null($this->pnlSelect)) {
            $this->pnlSelect->ConnectTable($this->lstEnrollments);
        }
        return $wgtEnrollment;
    }
    public function lnkViewAthelete_click($strFormId, $strControlId, $strActionParameter) {
        $intIdAthelete = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdAthelete;
        $this->Redirect('/data/editAthelete', array(
            FFSQS::Athelete_IdAthelete => $intIdAthelete
        ));
    }
    public function lnkViewCompetition_click($strFormId, $strControlId, $strActionParameter) {
        $intIdCompetition = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdCompetition;
        $this->Redirect('/data/editCompetition', array(
            FFSQS::Competition_IdCompetition => $intIdCompetition
        ));
    }
    public function lnkViewSession_click($strFormId, $strControlId, $strActionParameter) {
        $intIdSession = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdSession;
        $this->Redirect('/data/editSession', array(
            FFSQS::Session_IdSession => $intIdSession
        ));
    }
    public function lstEnrollment_editInit() {
        //_dv($this->lstEnrollments->SelectedRow);
        
    }
    public function lstEnrollment_editSave() {
        $objEnrollment = Enrollment::LoadById($this->lstEnrollments->SelectedRow->ActionParameter);
        if (is_null($objEnrollment)) {
            $objEnrollment = new Enrollment();
        }
        $objEnrollment->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstEnrollments->SelectedRow->UpdateEntity($objEnrollment);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetEnrollment(Enrollment::LoadById($strActionParameter));
        $this->lstEnrollments->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objEnrollment) {
        //_dv($objEnrollment);
        if (!is_null($this->lstEnrollments->SelectedRow)) {
            //This already exists
            $this->lstEnrollments->SelectedRow->UpdateEntity($objEnrollment);
            $this->ScrollTo($this->lstEnrollments->SelectedRow);
            $this->lstEnrollments->SelectedRow = null;
        } else {
            $objRow = $this->lstEnrollments->AddRow($objEnrollment);
        }
    }
}
