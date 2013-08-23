<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
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
        $this->AddWidget(((is_null($objSession)) ? 'Create Session' : 'Edit Session') , 'icon-edit', $this->pnlEdit);
    }
    public function InitList($arrSessions) {
        $this->lstSessions = new SessionListPanel($this, $arrSessions);
        $this->lstSessions->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstSession_editInit'));
        $this->lstSessions->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstSession_editSave'));
        $this->AddWidget('Sessions', 'icon-ul', $this->lstSessions);
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
