<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstSession_editInit()
* - lstSession_editSave()
* Classes list:
* - SessionManageFormBase extends FFSForm
*/
class SessionManageFormBase extends FFSForm {
    public $lstSessions = null;
    public $pnlEdit = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function InitEditPanel($objSession = null) {
        $this->pnlEdit = new SessionEditPanel($this, $objSession);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtSession = $this->AddWidget(((is_null($objSession)) ? 'Create Session' : 'Edit Session') , 'icon-edit', $this->pnlEdit);
        return $wgtSession;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objSession) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objSession) {
    }
    public function InitList($arrSessions) {
        $this->lstSessions = new SessionListPanel($this, $arrSessions);
        $this->lstSessions->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstSession_editInit'));
        $this->lstSessions->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstSession_editSave'));
        $wgtSession = $this->AddWidget('Sessions', 'icon-ul', $this->lstSessions);
        return $wgtSession;
    }
    public function lstSession_editInit() {
        //_dv($this->lstSessions->SelectedRow);
        
    }
    public function lstSession_editSave() {
        $objSession = Session::LoadById($this->lstSessions->SelectedRow->ActionParameter);
        if (is_null($objSession)) {
            $objSession = new Session();
        }
        $objSession->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstSessions->SelectedRow->UpdateEntity($objSession);
    }
}
