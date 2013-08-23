<?php
class EnrollmentManageForm extends EnrollmentManageFormBase{
    protected $blnInlineEdit = false;
    public function Form_Create(){
        parent::Form_Create();

        $arrEnrollments = $this->Query();
        $this->InitList($arrEnrollments);

    }
    public function Query(){
        $arrEnrollments = Enrollment::Query(
            sprintf(
                'WHERE 1'
            )
         );


        return $arrEnrollments;
    }
    public function InitList($arrEnrollments){
        parent::InitList($arrEnrollments);
        if($this->blnInlineEdit){
            $this->lstEnrollments->InitRemoveButtons();
            $this->lstEnrollments->InitEditControls();
            $this->lstEnrollments->AddEmptyRow();
        }else{
            $this->lstEnrollments->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );
            $this->InitEditPanel();
        }
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlEdit->SetEnrollment(
            Enrollment::LoadById($strActionParameter)
        );
    }
    public function lstEnrollment_editInit(){
        //_dv($this->lstEnrollments->SelectedRow);
    }
    public function lstEnrollment_editSave(){
        $objEnrollment = Enrollment::LoadById($this->lstEnrollments->SelectedRow->ActionParameter);
        if(is_null($objEnrollment)){
            $objEnrollment = new Enrollment();
        }
        $objEnrollment->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstEnrollments->SelectedRow->UpdateEntity(
            $objEnrollment
        );
    }

}
EnrollmentManageForm::Run('EnrollmentManageForm');