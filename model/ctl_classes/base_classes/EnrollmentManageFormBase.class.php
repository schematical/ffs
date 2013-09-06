<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - Query()
* - InitSelectPanel()
* - pnlSelect_change()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
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
            $arrAndConditions[] = sprintf('Enrollment_rel.idEnrollment = %s', $intIdEnrollment);
        }
        $intIdAthelete = MLCApplication::QS(FFSQS::Enrollment_IdAthelete);
        if (!is_null($intIdAthelete)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.idAthelete = %s', $intIdAthelete);
        }
        $intIdCompetition = MLCApplication::QS(FFSQS::Enrollment_IdCompetition);
        if (!is_null($intIdCompetition)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.idCompetition = %s', $intIdCompetition);
        }
        $intIdSession = MLCApplication::QS(FFSQS::Enrollment_IdSession);
        if (!is_null($intIdSession)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.idSession = %s', $intIdSession);
        }
        $strFlight = MLCApplication::QS(FFSQS::Enrollment_Flight);
        if (!is_null($strFlight)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.flight LIKE "%s%%"', $strFlight);
        }
        $strDivision = MLCApplication::QS(FFSQS::Enrollment_Division);
        if (!is_null($strDivision)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.division LIKE "%s%%"', $strDivision);
        }
        $strAgeGroup = MLCApplication::QS(FFSQS::Enrollment_AgeGroup);
        if (!is_null($strAgeGroup)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.ageGroup LIKE "%s%%"', $strAgeGroup);
        }
        $strMisc1 = MLCApplication::QS(FFSQS::Enrollment_Misc1);
        if (!is_null($strMisc1)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.misc1 LIKE "%s%%"', $strMisc1);
        }
        $strMisc2 = MLCApplication::QS(FFSQS::Enrollment_Misc2);
        if (!is_null($strMisc2)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.misc2 LIKE "%s%%"', $strMisc2);
        }
        $strMisc3 = MLCApplication::QS(FFSQS::Enrollment_Misc3);
        if (!is_null($strMisc3)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.misc3 LIKE "%s%%"', $strMisc3);
        }
        $strMisc4 = MLCApplication::QS(FFSQS::Enrollment_Misc4);
        if (!is_null($strMisc4)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.misc4 LIKE "%s%%"', $strMisc4);
        }
        $strMisc5 = MLCApplication::QS(FFSQS::Enrollment_Misc5);
        if (!is_null($strMisc5)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.misc5 LIKE "%s%%"', $strMisc5);
        }
        $strLevel = MLCApplication::QS(FFSQS::Enrollment_Level);
        if (!is_null($strLevel)) {
            $arrAndConditions[] = sprintf('Enrollment_rel.level LIKE "%s%%"', $strLevel);
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
        $this->pnlSelect->AddAction(new MJaxBSAutocompleteSelectEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtEnrollment = $this->AddWidget('Select Enrollment', 'icon-select', $this->pnlSelect);
        $wgtEnrollment->AddCssClass('span6');
        return $wgtEnrollment;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrEnrollments = $this->pnlSelect->GetValue();
        if (count($arrEnrollments) == 1) {
            $this->pnlEdit->SetEnrollment($arrEnrollments[0]);
            foreach ($this->lstEnrollments as $objRow) {
                if ($objRow->ActionParameter == $arrEnrollments[0]->IdEnrollment) {
                    $this->lstEnrollments->SelectedRow = $objRow;
                }
            }
            //$this->ScrollTo($this->pnlEdit);
            
        } //else{
        $this->ScrollTo($this->lstEnrollments);
        //}
        $this->lstEnrollments->RemoveAllChildControls();
        $this->lstEnrollments->SetDataEntites($arrEnrollments);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objEnrollment = null) {
        $this->pnlEdit = new EnrollmentEditPanel($this, $objEnrollment);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtEnrollment = $this->AddWidget(((is_null($objEnrollment)) ? 'Create Enrollment' : 'Edit Enrollment') , 'icon-edit', $this->pnlEdit);
        $wgtEnrollment->AddCssClass('span6');
        return $wgtEnrollment;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objEnrollment) {
        $this->UpdateTable($objEnrollment);
        if (!is_null($this->lstEnrollments->SelectedRow)) {
            $this->ScrollTo($this->lstEnrollments->SelectedRow);
        } else {
            $this->pnlEdit->Alert('Saved!', 'info');
        }
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objEnrollment) {
        $this->lstEnrollments->SelectedRow->Remove();
        $this->lstEnrollments->SelectedRow = null;
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
        $wgtEnrollment = $this->AddWidget('Enrollments', 'icon-ul', $this->lstEnrollments);
        $wgtEnrollment->AddCssClass('span12');
        return $wgtEnrollment;
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
            $this->lstEnrollments->SelectedRow = null;
        } else {
            $objRow = $this->lstEnrollments->AddRow($objEnrollment);
        }
    }
}
