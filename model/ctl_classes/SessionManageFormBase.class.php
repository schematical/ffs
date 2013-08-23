<?php
class SessionManageFormBase extends FFSForm{
    public $lstSessions = null;
    public $pnlEdit = null;
    public function Form_Create(){
        parent::Form_Create();

        $arrSessions = $this->Query();
        $this->InitList($arrSessions);
    }
    public function InitEditPanel($objSession = null){
        $this->pnlEdit = new SessionEditPanel($this, $objSession);
        $this->AddWidget(
            ((is_null($objSession))?'Create Session':'Edit Session'),
            'icon-edit',
            $this->pnlEdit
        );
    }
    public function InitList($arrSessions){
        $this->lstSessions = new SessionListPanel($this, $arrSessions);

        $this->lstSessions->AddAction(
            new MJaxTableEditInitEvent(),
            new MJaxServerControlAction($this, 'lstSession_editInit')
        );
        $this->lstSessions->AddAction(
            new MJaxTableEditSaveEvent(),
            new MJaxServerControlAction($this, 'lstSession_editSave')
        );
        $this->AddWidget(
            'Sessions',
            'icon-ul',
            $this->lstSessions
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
