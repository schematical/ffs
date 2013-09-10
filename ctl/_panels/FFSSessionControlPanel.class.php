<?php
class FFSSessionControlPanel extends MJaxPanel{
    public $objSession = null;
    public $lnkToggleState = null;
    public function __construct($objParentControl, $objSession){
        parent::__construct($objParentControl);
        $this->objSession = $objSession;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->lnkToggleState = new MJaxLinkButton($this);
        $this->lnkToggleState->AddCssClass('btn');
        //_dv($this->objSession->State());
        if($this->objSession->State() == FFSSessionState::CLOSED){
            $this->lnkToggleState->Text = 'Mark Open';
        }else{
            $this->lnkToggleState->Text = 'Mark Closed';
        }
        $this->lnkToggleState->AddAction($this, 'lnkToggleState_click');
    }
    public function lnkToggleState_click(){
        if($this->objSession->State() == FFSSessionState::CLOSED){
            $this->objSession->EndDate = MLCDateTime::Now('+ 1 day');
            $this->lnkToggleState->Text = 'Mark Closed';
        }else{
            $this->objSession->EndDate = MLCDateTime::Now();
            $this->lnkToggleState->Text = 'Mark Open';
        }
        $this->objSession->Save();
    }
    
}