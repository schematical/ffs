<?php
class FFSOrgInvitePanel extends MJaxPanel{
    public $pnlSelect = null;
    public $pnlInvite = null;
    public $btnInvite = null;
    public $strUserEmails = null;

    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        //_dv(FFSForm::Org()->Name);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->pnlSelect = new OrgSelectPanel($this);
        $this->pnlSelect->AddCssClass('span4');
        $this->pnlSelect->AddAction(
            new MJaxBSAutocompleteSelectEvent(),
            new MJaxServerControlAction($this, 'pnlSelect_select')
        );

        $this->pnlInvite = new MLCInvitePanel($this);
        $this->pnlInvite->AddCssClass('span4');
        $this->btnInvite = new MJaxLinkButton($this);
        $this->btnInvite->AddCssClass('btn btn-large');
        $this->btnInvite->Text = "Invite";
        $this->btnInvite->AddAction($this, 'btnInvite_click');
    }


    public function pnlSelect_select(){
        $this->blnModified = true;
        $arrOrgs = $this->pnlSelect->GetValue();

        if(count($arrOrgs) == 0){
            $this->Alert("Sorry we were unable to find a gym with that info. Please create one using the form below");
            $this->objForm->ScrollTo($this->objForm->pnlEdit);
            $this->strUserEmails = null;
            return;
        }
        $objOrg = $arrOrgs[0];

        $arrUsers = MLCAuthDriver::GetUsersByEntity($objOrg, FFSRoll::ORG_MANAGER);

        if(count($arrUsers) == 0){
            $this->pnlInvite->SetEntity($objOrg, FFSRoll::ORG_MANAGER);
            $arrPSData = json_decode($objOrg->PsData, true);
            //_dv($arrPSData['Email']);
            if(
                (array_key_exists('Email', $arrPSData))
            ){
                $this->pnlInvite->txtEmail->Text = $arrPSData['Email'];
            }
        }else{
            $arrUserEmails = array();
            //Display a button invite
            foreach($arrUsers as $intIndex => $objUser){
                $arrUserEmails[] = $objUser->Email;
            }
            $this->strUserEmails = implode(', ', $arrUserEmails);

        }

    }
    public function btnInvite_click()
    {
        $arrOrgs = $this->pnlSelect->GetValue();
        $objOrg = $arrOrgs[0];
        $objOrgCompettion = FFSApplication::InviteOrgToCompetition($objOrg, FFSForm::Competition());
        $this->Alert("Success!");
    }
}