<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - Query()
* - InitList()
* - lnkEdit_click()
* - pnlEdit_save()
* - lstEnrollment_editInit()
* - lstEnrollment_editSave()
* - UpdateTable()
* Classes list:
* - EnrollmentManageForm extends EnrollmentManageFormBase
*/
class EnrollmentManageForm extends EnrollmentManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $arrEnrollments = $this->Query();
        $this->InitList($arrEnrollments);
    }
    public function Query() {
        $arrEnrollments = FFSApplication::GetEnrollmentsBySession(
            FFSForm::$objSession
        );
        return $arrEnrollments;
    }
    public function InitList($arrEnrollments) {
        $wgtEnrollment = parent::InitList($arrEnrollments);
        if ($this->blnInlineEdit) {
            $this->lstEnrollments->InitRemoveButtons();
            $this->lstEnrollments->InitEditControls();
            $this->lstEnrollments->AddEmptyRow();
        } else {
            $this->lstEnrollments->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
            $this->InitEditPanel();
        }
        return $wgtEnrollment;
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetEnrollment(Enrollment::LoadById($strActionParameter));
        $this->lstEnrollments->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function pnlEdit_save($strFormId, $strControlId, $objSession) {
        //_dv($objSession);
        $this->UpdateTable($objSession);
    }
    public function lstEnrollment_editInit() {
        //_dv($this->lstEnrollments->SelectedRow);
        
    }
    public function lstEnrollment_editSave() {
        $this->UpdateTable($objEnrollment);
    }
    public function UpdateTable($objEnrollment) {
        //_dv($objEnrollment);
        if (!is_null($this->lstEnrollments->SelectedRow)) {
            //This already exists

            $this->lstEnrollments->SelectedRow->UpdateRow($objEnrollment);
            $this->ScrollTo($this->lstEnrollments->SelectedRow);
            $this->lstEnrollments->SelectedRow = null;
        } else {
            $objRow = $this->lstEnrollments->AddRow($objEnrollment);
        }
    }
}
EnrollmentManageForm::Run('EnrollmentManageForm');
