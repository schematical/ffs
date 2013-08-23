<?php
class AtheleteManageForm extends AtheleteManageFormBase{
    protected $blnInlineEdit = false;
    public function Form_Create(){
        parent::Form_Create();

        $arrAtheletes = $this->Query();
        $this->InitList($arrAtheletes);

    }
    public function Query(){
        $arrAtheletes = Athelete::Query(
            sprintf(
                'WHERE 1'
            )
         );


        return $arrAtheletes;
    }
    public function InitList($arrAtheletes){
        parent::InitList($arrAtheletes);
        if($this->blnInlineEdit){
            $this->lstAtheletes->InitRemoveButtons();
            $this->lstAtheletes->InitEditControls();
            $this->lstAtheletes->AddEmptyRow();
        }else{
            $this->lstAtheletes->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );
            $this->InitEditPanel();
        }
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlEdit->SetAthelete(
            Athelete::LoadById($strActionParameter)
        );
    }
    public function lstAthelete_editInit(){
        //_dv($this->lstAtheletes->SelectedRow);
    }
    public function lstAthelete_editSave(){
        $objAthelete = Athelete::LoadById($this->lstAtheletes->SelectedRow->ActionParameter);
        if(is_null($objAthelete)){
            $objAthelete = new Athelete();
        }
        $objAthelete->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstAtheletes->SelectedRow->UpdateEntity(
            $objAthelete
        );
    }

}
AtheleteManageForm::Run('AtheleteManageForm');