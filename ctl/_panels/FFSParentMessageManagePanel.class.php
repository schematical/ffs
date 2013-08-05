<?php class FFSParentMessageManagePanel extends MJaxPanel{
    public $pnlParentMessage = null;
    public $lnkInviteFamily = null;
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


    }
    public function InitInviteFamilyLink(){
        $this->lnkInviteFamily = new MJaxLinkButton($this);
        $this->lnkInviteFamily->Text = 'Add More';
        $this->lnkInviteFamily->AddCssClass('btn btn-large span10 offset1');
        $this->lnkInviteFamily->AddAction($this, 'lnkIndividual_click');
    }
    public function InitInviteFamilyFields(){
        if(!is_null($this->lnkInviteFamily)){
            $this->lnkInviteFamily->Remove();
            $this->lnkInviteFamily = null;
        }

    }
    public function pnlParentMessage_save($objParentMessage){
        //Display payment form
        $this->objForm->DispStripe();

    }
    public function _searchAthelete($objRoute){
        $strSearch = $_POST['search'];
        $arrAtheletes = Athelete::Query(
            sprintf(
                'WHERE firstName LIKE "%s%%" OR lastName LIKE "%s%%"',
                $strSearch,
                $strSearch
            )
        );

        $arrAtheleteNames = array();
        foreach($arrAtheletes as $intIndex => $objAthelete){
            $arrAtheleteNames[] = $objAthelete->FirstName . ' ' . $objAthelete->LastName;
        }
        //$arrAtheleteNames = array('test', 'toast', 'boast');
        die(
            json_encode(
                $arrAtheleteNames
            )
        );
    }
}