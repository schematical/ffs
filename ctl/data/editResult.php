<?php
class ResultManageForm extends ResultManageFormBase{
    protected $blnInlineEdit = false;
    public function Form_Create(){
        parent::Form_Create();

        $arrResults = $this->Query();
        $this->InitList($arrResults);

    }
    public function Query(){
        $arrResults = Result::Query(
            sprintf(
                'WHERE 1'
            )
         );


        return $arrResults;
    }
    public function InitList($arrResults){
        parent::InitList($arrResults);
        if($this->blnInlineEdit){
            $this->lstResults->InitRemoveButtons();
            $this->lstResults->InitEditControls();
            $this->lstResults->AddEmptyRow();
        }else{
            $this->lstResults->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );
            $this->InitEditPanel();
        }
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlEdit->SetResult(
            Result::LoadById($strActionParameter)
        );
    }
    public function lstResult_editInit(){
        //_dv($this->lstResults->SelectedRow);
    }
    public function lstResult_editSave(){
        $objResult = Result::LoadById($this->lstResults->SelectedRow->ActionParameter);
        if(is_null($objResult)){
            $objResult = new Result();
        }
        $objResult->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstResults->SelectedRow->UpdateEntity(
            $objResult
        );
    }

}
ResultManageForm::Run('ResultManageForm');