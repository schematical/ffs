<?php
class EnrollmentManageFormBase extends FFSForm{
    public $lstEnrollments = null;
    public $pnlEdit = null;
    public function Form_Create(){
        parent::Form_Create();

        $arrEnrollments = $this->Query();
        $this->InitList($arrEnrollments);
    }
    public function InitEditPanel($objEnrollment = null){
        $this->pnlEdit = new EnrollmentEditPanel($this, $objEnrollment);
        $this->AddWidget(
            ((is_null($objEnrollment))?'Create Enrollment':'Edit Enrollment'),
            'icon-edit',
            $this->pnlEdit
        );
    }
    public function InitList($arrEnrollments){
        $this->lstEnrollments = new EnrollmentListPanel($this, $arrEnrollments);

        $this->lstEnrollments->AddAction(
            new MJaxTableEditInitEvent(),
            new MJaxServerControlAction($this, 'lstEnrollment_editInit')
        );
        $this->lstEnrollments->AddAction(
            new MJaxTableEditSaveEvent(),
            new MJaxServerControlAction($this, 'lstEnrollment_editSave')
        );
        $this->AddWidget(
            'Enrollments',
            'icon-ul',
            $this->lstEnrollments
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
