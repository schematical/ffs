<?php class FFSParentMessageManagePanel extends MJaxPanel{
    public $pnlParentMessage = null;
    public $pnlParentMessageInvite = null;
    public $lnkInviteFamily = null;
    public $txtUsername = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);

        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->AddCssClass('mjax-bs-animate-hiden');
        $this->pnlParentMessage = new ParentMessageEditPanel($this);
        $this->pnlParentMessage->strAtheleteName->Attr('placeholder',"Athlete Name");
        $this->pnlParentMessage->strAtheleteName->Typehead($this, '_searchAthelete');


        $this->pnlParentMessage->strAtheleteName->AddCssClass('input-large');
        $this->pnlParentMessage->strMessage->AddCssClass('span4');
        $this->pnlParentMessage->strMessage->Attr('placeholder','Message');
        $this->pnlParentMessage->btnSave->AddCssClass('span4');
        $this->pnlParentMessage->AllowSave = false;


        if(!is_null($this->lnkInviteFamily)){
            $this->lnkInviteFamily->Remove();
            $this->lnkInviteFamily = null;
        }

        $this->pnlParentMessageInvite = new FFSParentMessageInvitePanel($this);
        $this->blnModified = true;

    }
    public function pnlParentMessage_save($objParentMessage){
        //Display payment form
        $this->objForm->pnlParentMessage_send();

    }

}