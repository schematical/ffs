<?php
class CompetitionManageForm extends CompetitionManageFormBase{
    protected $blnInlineEdit = false;
    public function Form_Create(){
        parent::Form_Create();

        $arrCompetitions = $this->Query();
        $this->InitList($arrCompetitions);

    }
    public function Query(){
        $arrCompetitions = Competition::Query(
            sprintf(
                'WHERE 1'
            )
         );


        return $arrCompetitions;
    }
    public function InitList($arrCompetitions){
        parent::InitList($arrCompetitions);
        if($this->blnInlineEdit){
            $this->lstCompetitions->InitRemoveButtons();
            $this->lstCompetitions->InitEditControls();
            $this->lstCompetitions->AddEmptyRow();
        }else{
            $this->lstCompetitions->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );
            $this->InitEditPanel();
        }
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlEdit->SetCompetition(
            Competition::LoadById($strActionParameter)
        );
    }
    public function lstCompetition_editInit(){
        //_dv($this->lstCompetitions->SelectedRow);
    }
    public function lstCompetition_editSave(){
        $objCompetition = Competition::LoadById($this->lstCompetitions->SelectedRow->ActionParameter);
        if(is_null($objCompetition)){
            $objCompetition = new Competition();
        }
        $objCompetition->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstCompetitions->SelectedRow->UpdateEntity(
            $objCompetition
        );
    }

}
CompetitionManageForm::Run('CompetitionManageForm');