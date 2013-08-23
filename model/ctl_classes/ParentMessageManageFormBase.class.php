<?php
class ParentMessageManageFormBase extends FFSForm{
    public $lstParentMessages = null;
    public $pnlEdit = null;
    public function Form_Create(){
        parent::Form_Create();

        $arrParentMessages = $this->Query();
        $this->InitList($arrParentMessages);
    }
    public function InitEditPanel($objParentMessage = null){
        $this->pnlEdit = new ParentMessageEditPanel($this, $objParentMessage);
        $this->AddWidget(
            ((is_null($objParentMessage))?'Create ParentMessage':'Edit ParentMessage'),
            'icon-edit',
            $this->pnlEdit
        );
    }
    public function InitList($arrParentMessages){
        $this->lstParentMessages = new ParentMessageListPanel($this, $arrParentMessages);

        $this->lstParentMessages->AddAction(
            new MJaxTableEditInitEvent(),
            new MJaxServerControlAction($this, 'lstParentMessage_editInit')
        );
        $this->lstParentMessages->AddAction(
            new MJaxTableEditSaveEvent(),
            new MJaxServerControlAction($this, 'lstParentMessage_editSave')
        );
        $this->AddWidget(
            'ParentMessages',
            'icon-ul',
            $this->lstParentMessages
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
