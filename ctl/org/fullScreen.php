<?php

class fullScreen extends FFSForm {
    protected $intCt = 100;
    public $pnlScore = null;
    public $lstEvent = null;

    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/org/fullScreen.tpl.php';

        $this->lstEvent = new MJaxListBox($this);
        $this->lstEvent->AddItem('Beam', 'beam');
        $this->pnlScore = new MJaxPanel($this);
        $this->pnlScore->Text = $this->intCt;
        $this->pnlScore->AddAction(
            new MJaxTimeoutEvent(5000),
            new MJaxServerControlAction($this, 'pnlScore_timeout')
        );
    }
    public function pnlScore_timeout(){
        $this->intCt += 5;
        $this->pnlScore->Text = $this->intCt;
    }

}
fullScreen::Run('fullScreen');
?>