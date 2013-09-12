<?php
class FFSSessionControlPanel extends MJaxPanel{
    public $objSession = null;
    public $lnkToggleState = null;
    public function __construct($objParentControl, $objSession){
        parent::__construct($objParentControl);
        $this->objSession = $objSession;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->lnkToggleState = new MJaxLinkButton($this);
        $this->lnkToggleState->AddCssClass('btn btn-large btn-info');
        $this->UpdateToggleStateText();

        $this->lnkToggleState->AddAction($this, 'lnkToggleState_click');
    }
    public function lnkToggleState_click(){
        if($this->objSession->State() == FFSSessionState::CLOSED){
            $this->objSession->EndDate = MLCDateTime::Now('+ 1 day');
        }else{
            $this->objSession->EndDate = MLCDateTime::Now();

        }
        $this->UpdateToggleStateText();
        $this->objSession->Save();
    }
    public function UpdateToggleStateText(){
        if($this->objSession->IsUpcoming()){
            $this->lnkToggleState->Text = 'Start Session Now';
        }elseif($this->objSession->IsClosed()){
            $this->lnkToggleState->Text = 'Re-open Session';
        }elseif($this->objSession->IsActive()){
            $this->lnkToggleState->Text = 'End Session Now';
        }
    }
    
}