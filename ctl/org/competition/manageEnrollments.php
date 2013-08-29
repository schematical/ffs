<?php
/**
 * Class and Function List:
 * Function list:
 * - Form_Create()
 * - Query()
 * - InitList()
 * - lnkEdit_click()
 * - lstEnrollment_editInit()
 * - lstEnrollment_editSave()
 * Classes list:
 * - EnrollmentManageForm extends EnrollmentManageFormBase
 */
class EnrollmentManageForm extends EnrollmentManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->IntSelectPanel();

        $arrEnrollments = $this->Query();
        $this->InitList($arrEnrollments);

    }
    public function Query(){
        $arrAndConditions = array();
        if(!is_null(MLCApplication::QS(FFSQS::IdSession))){
            $arrAndConditions[] = sprintf(
                'idSession = %s',
                MLCApplication::QS(FFSQS::IdSession)
            );
        }
        if(count($arrAndConditions) == 0){
            $arrAndConditions[] = 0;
        }
        $arrEnrollments = Enrollment::Query(
            sprintf(
                'WHERE %s',
                implode(' AND ', $arrAndConditions)
            )
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
}
EnrollmentManageForm::Run('EnrollmentManageForm');
