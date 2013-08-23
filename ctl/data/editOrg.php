<?php
class OrgManageForm extends OrgManageFormBase{
    protected $blnInlineEdit = false;
    public function Form_Create(){
        parent::Form_Create();

        $arrOrgs = $this->Query();
        $this->InitList($arrOrgs);

    }
    public function Query(){
        $arrOrgs = Org::Query(
            sprintf(
                'WHERE 1'
            )
         );


        return $arrOrgs;
    }
    public function InitList($arrOrgs){
        parent::InitList($arrOrgs);
        if($this->blnInlineEdit){
            $this->lstOrgs->InitRemoveButtons();
            $this->lstOrgs->InitEditControls();
            $this->lstOrgs->AddEmptyRow();
        }else{
            $this->lstOrgs->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );
            $this->InitEditPanel();
        }
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlEdit->SetOrg(
            Org::LoadById($strActionParameter)
        );
    }
    public function lstOrg_editInit(){
        //_dv($this->lstOrgs->SelectedRow);
    }
    public function lstOrg_editSave(){
        $objOrg = Org::LoadById($this->lstOrgs->SelectedRow->ActionParameter);
        if(is_null($objOrg)){
            $objOrg = new Org();
        }
        $objOrg->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstOrgs->SelectedRow->UpdateEntity(
            $objOrg
        );
    }

}
OrgManageForm::Run('OrgManageForm');