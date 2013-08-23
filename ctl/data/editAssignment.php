<?php
class AssignmentManageForm extends AssignmentManageFormBase{
    protected $blnInlineEdit = false;
    public function Form_Create(){
        parent::Form_Create();

        $arrAssignments = $this->Query();
        $this->InitList($arrAssignments);

    }
    public function Query(){
        $arrAssignments = Assignment::Query(
            sprintf(
                'WHERE 1'
            )
         );


        return $arrAssignments;
    }
    public function InitList($arrAssignments){
        parent::InitList($arrAssignments);
        if($this->blnInlineEdit){
            $this->lstAssignments->InitRemoveButtons();
            $this->lstAssignments->InitEditControls();
            $this->lstAssignments->AddEmptyRow();
        }else{
            $this->lstAssignments->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );
            $this->InitEditPanel();
        }
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlEdit->SetAssignment(
            Assignment::LoadById($strActionParameter)
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
AssignmentManageForm::Run('AssignmentManageForm');