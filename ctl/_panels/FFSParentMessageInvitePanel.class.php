<?php
class FFSParentMessageInvitePanel extends MJaxPanel{
    public $txtContactData = null;
    public $lnkInvite = null;

    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        //$this->AddCssClass('row-fluid');
        $this->txtContactData = new MJaxTextBox($this);
        $this->txtContactData->Attr('placeholder', 'Email or Phone');
        //$this->txtContactData->AddCssClass('span6 offset1');

        $this->lnkInvite = new MJaxLinkButton($this);
        $this->lnkInvite->AddCssClass('btn btn-large');
        $this->lnkInvite->Text = "Invite";
        $this->lnkInvite->AddAction($this, 'lnkInvite_click');
    }

    public function lnkInvite_click()
    {
       //Determin if it is a phone number or an email
        if(!filter_var($this->txtContactData->Text, FILTER_VALIDATE_EMAIL)){
            return $this->txtContactData->Alert("Not Valid");
        }
        $strContractType = FFSInviteType::EMAIL;
        //Do something for phone eventaully
        $objParentMessage = FFSApplication::GetAvailableMessageTokens();
        $strAtheleteName = $this->objParentControl->pnlParentMessage->strAtheleteName->Text;
        if(strlen($strAtheleteName) == 0){
            return $this->objParentControl->pnlParentMessage->strAtheleteName->Alert("Must chose an enter an athlete name to be invited ");
        }
        $objParentMessage->AtheleteName = $strAtheleteName;
        FFSApplication::InviteMessage(
            $this->txtContactData->Text,
            $strContractType,
            null,
            $objParentMessage
        );
       
    }
    
}