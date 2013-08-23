<?php
class AssignmentManageFormBase extends FFSForm{
    public $lstAssignments = null;
    public $pnlEdit = null;
    public function Form_Create(){
        parent::Form_Create();

        $arrAssignments = $this->Query();
        $this->InitList($arrAssignments);
    }
    public function InitEditPanel($objAssignment = null){
        $this->pnlEdit = new AssignmentEditPanel($this, $objAssignment);
        $this->AddWidget(
            ((is_null($objAssignment))?'Create Assignment':'Edit Assignment'),
            'icon-edit',
            $this->pnlEdit
        );
    }
    public function InitList($arrAssignments){
        $this->lstAssignments = new AssignmentListPanel($this, $arrAssignments);

        $this->lstAssignments->AddAction(
            new MJaxTableEditInitEvent(),
            new MJaxServerControlAction($this, 'lstAssignment_editInit')
        );
        $this->lstAssignments->AddAction(
            new MJaxTableEditSaveEvent(),
            new MJaxServerControlAction($this, 'lstAssignment_editSave')
        );
        $this->AddWidget(
            'Assignments',
            'icon-ul',
            $this->lstAssignments
        );

    }
    public function lstAssignment_editInit(){
        //_dv($this->lstAssignments->SelectedRow);
    }
    public function lstAssignment_editSave(){
        $objAssignment = Assignment::LoadById($this->lstAssignments->SelectedRow->ActionParameter);
        if(is_null($objAssignment)){
            $objAssignment = new Assignment();
        }
        $objAssignment->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstAssignments->SelectedRow->UpdateEntity(
            $objAssignment
        );
    }
}
