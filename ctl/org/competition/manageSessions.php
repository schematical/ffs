<?php
class manageSessions extends FFSForm{
    public $lstSessions = null;
    public function Form_Create(){
        parent::Form_Create();
        if(is_null(FFSForm::$objCompetition)){
            die("No competition defined");
            $this->Redirect("/index");

        }

        $arrSessions = FFSForm::$objCompetition->GetSessionArr();

        $this->lstSessions = new SessionListPanel($this, $arrSessions);
        $this->lstSessions->InitRemoveButtons();
        $this->lstSessions->RemoveColumn('idCompetition');
        $this->lstSessions->InitEditControls();
        $this->lstSessions->AddEmptyRow();
        $this->lstSessions->AddAction(
            new MJaxTableEditInitEvent(),
            new MJaxServerControlAction($this, 'lstSession_editInit')
        );
        $this->lstSessions->AddAction(
            new MJaxTableEditSaveEvent(),
            new MJaxServerControlAction($this, 'lstSession_editSave')
        );
        $this->AddWidget(
            FFSForm::$objCompetition->Name . ' sessions',
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
manageSessions::Run('manageSessions');