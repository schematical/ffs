<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - Query()
* - InitSelectPanel()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lnkViewAthelete_click()
* - lnkViewCompetition_click()
* - lstParentMessage_editInit()
* - lstParentMessage_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - ParentMessageManageFormBase extends FFSForm
*/
class ParentMessageManageFormBase extends FFSForm {
    public $lstParentMessages = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdParentMessage = MLCApplication::QS(FFSQS::ParentMessage_IdParentMessage);
        if (!is_null($intIdParentMessage)) {
            $arrAndConditions[] = sprintf('idParentMessage = %s', $intIdParentMessage);
        }
        $intIdAthelete = MLCApplication::QS(FFSQS::ParentMessage_IdAthelete);
        if (!is_null($intIdAthelete)) {
            $arrAndConditions[] = sprintf('idAthelete = %s', $intIdAthelete);
        }
        $strAtheleteName = MLCApplication::QS(FFSQS::ParentMessage_AtheleteName);
        if (!is_null($strAtheleteName)) {
            $arrAndConditions[] = sprintf('atheleteName LIKE "%s%%"', $strAtheleteName);
        }
        $strInviteData = MLCApplication::QS(FFSQS::ParentMessage_InviteData);
        if (!is_null($strInviteData)) {
            $arrAndConditions[] = sprintf('inviteData LIKE "%s%%"', $strInviteData);
        }
        $strInviteType = MLCApplication::QS(FFSQS::ParentMessage_InviteType);
        if (!is_null($strInviteType)) {
            $arrAndConditions[] = sprintf('inviteType LIKE "%s%%"', $strInviteType);
        }
        $strInviteToken = MLCApplication::QS(FFSQS::ParentMessage_InviteToken);
        if (!is_null($strInviteToken)) {
            $arrAndConditions[] = sprintf('inviteToken LIKE "%s%%"', $strInviteToken);
        }
        $intIdCompetition = MLCApplication::QS(FFSQS::ParentMessage_IdCompetition);
        if (!is_null($intIdCompetition)) {
            $arrAndConditions[] = sprintf('idCompetition = %s', $intIdCompetition);
        }
        if (count($arrAndConditions) >= 1) {
            $arrParentMessages = ParentMessage::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrParentMessages = array();
        }
        return $arrParentMessages;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new ParentMessageSelectPanel($this);
        /*$this->pnlEdit->AddAction(
                new MJaxDataEntitySaveEvent(),
                new MJaxServerControlAction($this, 'pnlEdit_save')
            );*/
        $wgtParentMessage = $this->AddWidget('Select ParentMessage', 'icon-select', $this->pnlSelect);
        $wgtParentMessage->AddCssClass('span6');
        return $wgtParentMessage;
    }
    public function InitEditPanel($objParentMessage = null) {
        $this->pnlEdit = new ParentMessageEditPanel($this, $objParentMessage);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtParentMessage = $this->AddWidget(((is_null($objParentMessage)) ? 'Create ParentMessage' : 'Edit ParentMessage') , 'icon-edit', $this->pnlEdit);
        $wgtParentMessage->AddCssClass('span6');
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
        if ($this->blnInlineEdit) {
            $this->lstParentMessages->InitRemoveButtons();
            $this->lstParentMessages->InitEditControls();
            $this->lstParentMessages->AddEmptyRow();
        } else {
            $this->lstParentMessages->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $this->lstParentMessages->InitRowControl('idAthelete', 'View Athelete', $this, 'lnkViewAthelete_click');
        $this->lstParentMessages->InitRowControl('idCompetition', 'View Competition', $this, 'lnkViewCompetition_click');
        $wgtParentMessage = $this->AddWidget('ParentMessages', 'icon-ul', $this->lstParentMessages);
        if (!is_null($this->pnlSelect)) {
            $this->pnlSelect->ConnectTable($this->lstParentMessages);
        }
        return $wgtParentMessage;
    }
    public function lnkViewAthelete_click($strFormId, $strControlId, $strActionParameter) {
        $intIdAthelete = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdAthelete;
        $this->Redirect('/data/editAthelete', array(
            FFSQS::Athelete_IdAthelete => $intIdAthelete
        ));
    }
    public function lnkViewCompetition_click($strFormId, $strControlId, $strActionParameter) {
        $intIdCompetition = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdCompetition;
        $this->Redirect('/data/editCompetition', array(
            FFSQS::Competition_IdCompetition => $intIdCompetition
        ));
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
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetParentMessage(ParentMessage::LoadById($strActionParameter));
        $this->lstParentMessages->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objParentMessage) {
        //_dv($objParentMessage);
        if (!is_null($this->lstParentMessages->SelectedRow)) {
            //This already exists
            $this->lstParentMessages->SelectedRow->UpdateEntity($objParentMessage);
            $this->ScrollTo($this->lstParentMessages->SelectedRow);
            $this->lstParentMessages->SelectedRow = null;
        } else {
            $objRow = $this->lstParentMessages->AddRow($objParentMessage);
        }
    }
}
