<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstEnrollment_editInit()
* - lstEnrollment_editSave()
* Classes list:
* - EnrollmentManageFormBase extends FFSForm
*/
class EnrollmentManageFormBase extends FFSForm {
    public $lstEnrollments = null;
    public $pnlEdit = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function InitEditPanel($objEnrollment = null) {
        $this->pnlEdit = new EnrollmentEditPanel($this, $objEnrollment);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtEnrollment = $this->AddWidget(((is_null($objEnrollment)) ? 'Create Enrollment' : 'Edit Enrollment') , 'icon-edit', $this->pnlEdit);
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
        $wgtEnrollment = $this->AddWidget('Enrollments', 'icon-ul', $this->lstEnrollments);
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
}
