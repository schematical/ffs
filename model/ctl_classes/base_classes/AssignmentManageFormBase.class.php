<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstAssignment_editInit()
* - lstAssignment_editSave()
* Classes list:
* - AssignmentManageFormBase extends FFSForm
*/
class AssignmentManageFormBase extends FFSForm {
    public $lstAssignments = null;
    public $pnlEdit = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function InitEditPanel($objAssignment = null) {
        $this->pnlEdit = new AssignmentEditPanel($this, $objAssignment);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtAssignment = $this->AddWidget(((is_null($objAssignment)) ? 'Create Assignment' : 'Edit Assignment') , 'icon-edit', $this->pnlEdit);
        return $wgtAssignment;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objAssignment) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objAssignment) {
    }
    public function InitList($arrAssignments) {
        $this->lstAssignments = new AssignmentListPanel($this, $arrAssignments);
        $this->lstAssignments->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstAssignment_editInit'));
        $this->lstAssignments->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstAssignment_editSave'));
        $wgtAssignment = $this->AddWidget('Assignments', 'icon-ul', $this->lstAssignments);
        return $wgtAssignment;
    }
    public function lstAssignment_editInit() {
        //_dv($this->lstAssignments->SelectedRow);
        
    }
    public function lstAssignment_editSave() {
        $objAssignment = Assignment::LoadById($this->lstAssignments->SelectedRow->ActionParameter);
        if (is_null($objAssignment)) {
            $objAssignment = new Assignment();
        }
        $objAssignment->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstAssignments->SelectedRow->UpdateEntity($objAssignment);
    }
}
