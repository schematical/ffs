<?php
class ParentMessageManageForm extends ParentMessageManageFormBase{
    protected $blnInlineEdit = false;
    public function Form_Create(){
        parent::Form_Create();

        $arrParentMessages = $this->Query();
        $this->InitList($arrParentMessages);

    }
    public function Query(){
        $arrParentMessages = ParentMessage::Query(
            sprintf(
                'WHERE 1'
            )
         );


        return $arrParentMessages;
    }
    public function InitList($arrParentMessages){
        parent::InitList($arrParentMessages);
        if($this->blnInlineEdit){
            $this->lstParentMessages->InitRemoveButtons();
            $this->lstParentMessages->InitEditControls();
            $this->lstParentMessages->AddEmptyRow();
        }else{
            $this->lstParentMessages->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );
            $this->InitEditPanel();
        }
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlEdit->SetParentMessage(
            ParentMessage::LoadById($strActionParameter)
        );
    }
    public function lstParentMessage_editInit(){
        //_dv($this->lstParentMessages->SelectedRow);
    }
    public function lstParentMessage_editSave(){
        $objParentMessage = ParentMessage::LoadById($this->lstParentMessages->SelectedRow->ActionParameter);
        if(is_null($objParentMessage)){
            $objParentMessage = new ParentMessage();
        }
        $objParentMessage->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstParentMessages->SelectedRow->UpdateEntity(
            $objParentMessage
        );
    }

}
ParentMessageManageForm::Run('ParentMessageManageForm');