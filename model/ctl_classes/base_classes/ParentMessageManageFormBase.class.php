<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstParentMessage_editInit()
* - lstParentMessage_editSave()
* Classes list:
* - ParentMessageManageFormBase extends FFSForm
*/
class ParentMessageManageFormBase extends FFSForm {
    public $lstParentMessages = null;
    public $pnlEdit = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function InitEditPanel($objParentMessage = null) {
        $this->pnlEdit = new ParentMessageEditPanel($this, $objParentMessage);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtParentMessage = $this->AddWidget(((is_null($objParentMessage)) ? 'Create ParentMessage' : 'Edit ParentMessage') , 'icon-edit', $this->pnlEdit);
        return $wgtParentMessage;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objParentMessage) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objParentMessage) {
    }
    public function InitList($arrParentMessages) {
        $this->lstParentMessages = new ParentMessageListPanel($this, $arrParentMessages);
        $this->lstParentMessages->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstParentMessage_editInit'));
        $this->lstParentMessages->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstParentMessage_editSave'));
        $wgtParentMessage = $this->AddWidget('ParentMessages', 'icon-ul', $this->lstParentMessages);
        return $wgtParentMessage;
    }
    public function lstParentMessage_editInit() {
        //_dv($this->lstParentMessages->SelectedRow);
        
    }
    public function lstParentMessage_editSave() {
        $objParentMessage = ParentMessage::LoadById($this->lstParentMessages->SelectedRow->ActionParameter);
        if (is_null($objParentMessage)) {
            $objParentMessage = new ParentMessage();
        }
        $objParentMessage->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstParentMessages->SelectedRow->UpdateEntity($objParentMessage);
    }
}
