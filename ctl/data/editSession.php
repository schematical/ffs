<?php
class SessionManageForm extends SessionManageFormBase{
    protected $blnInlineEdit = false;
    public function Form_Create(){
        parent::Form_Create();

        $arrSessions = $this->Query();
        $this->InitList($arrSessions);

    }
    public function Query(){
        $arrSessions = Session::Query(
            sprintf(
                'WHERE 1'
            )
         );


        return $arrSessions;
    }
    public function InitList($arrSessions){
        parent::InitList($arrSessions);
        if($this->blnInlineEdit){
            $this->lstSessions->InitRemoveButtons();
            $this->lstSessions->InitEditControls();
            $this->lstSessions->AddEmptyRow();
        }else{
            $this->lstSessions->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );
            $this->InitEditPanel();
        }
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlEdit->SetSession(
            Session::LoadById($strActionParameter)
        );
    }
    public function lstSession_editInit(){
        //_dv($this->lstSessions->SelectedRow);
    }
    public function lstSession_editSave(){
        $objSession = Session::LoadById($this->lstSessions->SelectedRow->ActionParameter);
        if(is_null($objSession)){
            $objSession = new Session();
        }
        $objSession->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstSessions->SelectedRow->UpdateEntity(
            $objSession
        );
    }

}
SessionManageForm::Run('SessionManageForm');