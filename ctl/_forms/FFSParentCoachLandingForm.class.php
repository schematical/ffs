<?php
class FFSParentCoachLandingForm extends FFSForm{
    protected $strRoll = null;
    public $lnkAction = null;

    public $pnlSignup = null;

    public $objOrg = null;
    public $pnlOrg = null;
    public $pnlOrgEdit = null;
    public $pnlOrgInvite = null;

    public $pnlAthelete = null;
    public $pnlAtheleteEdit = null;
    public $lnkAddAnotherAthelete = null;
    public $arrAtheletes = array();


    public function Form_Create(){
        parent::Form_Create();

        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/landing.tpl.php';
        $this->pnlSignup = new MLCShortSignUpPanel($this);
        $this->pnlSignup->AddCssClass("well");
        //$this->AddWidget('Create Account', '', $this->pnlSignup);
        $this->pnlOrg = new MJaxBSAutocompleteTextBox($this);
        $this->pnlOrg->SetSearchEntity('Org');
        $this->pnlOrg->AddAction(
            new MJaxBSAutocompleteSelectEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlOrg_select'
            )
        );

        $this->pnlAthelete = new MJaxBSAutocompleteTextBox($this);
        $this->pnlAthelete->SetSearchEntity('Athelete', 'lastName');

        $this->pnlAthelete->AddAction(
            new MJaxBSAutocompleteSelectEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlAthelete_select'
            )
        );


        $this->pnlSignup->AddAction(
            new MJaxAuthSignupEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlSignup_signup'
            )
        );


    }
    public function pnlOrg_select(){
        $objOrg = $this->pnlOrg->GetValue();

        if(is_object($objOrg)){
            $this->objOrg = $objOrg;
            MLCCookieDriver::SetCookie(FFSQS::Org_IdOrg, $this->objOrg->IdOrg);
            //Display Org Confirm screen


            //$this->Append("#ffs-org-select",'<div class="alert alert-info">Invite your coach to manage your team on TumbleScore</div>');
            //Append...
        }else{
            //Ask to invite org
           $this->InitOrgEditPanel($objOrg);
            //Append...
        }
    }
    public function InitOrgEditPanel($strGymName = null){
        if(is_null($this->pnlOrgEdit)){
            $this->pnlOrgEdit = new OrgEditPanel($this);
            $this->pnlOrgEdit->strName->Text = $strGymName;
            $this->pnlOrgEdit->btnSave->Remove();
            $this->pnlOrgEdit->btnSave = null;
            $this->Append("#ffs-org-select", '<div class="alert alert-info">We don\'t have your gym on file yet. If you know it would you mind entering in their info? If not that is okay.</a>');
            $this->Append("#ffs-org-select", $this->pnlOrgEdit);
            MLCCookieDriver::SetCookie(FFSQS::Org_IdOrg, -1);
        }
    }
    public function pnlAthelete_select(){
        $objAthelete = $this->pnlAthelete->GetValue();
        if(is_object($objAthelete)){
            //Display Athelete Confirm screen

            $this->AppendAthelete($objAthelete);
            $this->Append('#ffs-athelete-select', '<div class="alert alert-success">Great! You can not fill out your information.</a>');
        }else{
            //Display new athelete panel
            $arrNameParts = explode(' ', $objAthelete);
            $blnAppendPanel = false;
            if(is_null($this->pnlAtheleteEdit)){
                $this->pnlAtheleteEdit = new AtheleteEditPanel($this);
                $this->pnlAtheleteEdit->intIdOrg->Remove();
                $this->pnlAtheleteEdit->intIdOrg = null;
                $this->pnlAtheleteEdit->btnSave->Remove();
                $this->pnlAtheleteEdit->btnSave = new MJaxLinkButton($this);
                $this->pnlAtheleteEdit->btnSave->AddCssClass('btn btn-primary');
                $this->pnlAtheleteEdit->btnSave->Text = 'Add Another Athlete';
                $this->pnlAtheleteEdit->btnSave->AddAction(
                    $this,
                    'btnAddAthelete_click'
                );
                $blnAppendPanel = true;
            }
            $this->pnlAtheleteEdit->strFirstName->Text = $arrNameParts[0];
            if(count($arrNameParts) > 1){
                $this->pnlAtheleteEdit->strLastName->Text = $arrNameParts[1];
            }
            if(!is_null($this->objOrg)){
                $this->pnlAtheleteEdit->strMemType->Text = $this->objOrg->ClubType;
            }elseif(!is_null($this->pnlOrgEdit)){
                $this->pnlAtheleteEdit->strMemType->Text = $this->pnlOrgEdit->GetOrg()->ClubType;
            }
            if($blnAppendPanel){
                $this->Append('#ffs-athelete-select', $this->pnlAtheleteEdit);
            }

        }

    }
    public function btnAddAthelete_click(){
       $objAthelete = $this->pnlAtheleteEdit->GetAthelete();
       if(is_null($this->objOrg)){
            $this->objOrg = $this->pnlOrgEdit->GetOrg();
       }
       if(strlen($objAthelete->FirstName) > 1){
           $this->AppendAthelete($objAthelete);
           $this->pnlAtheleteEdit->SetAthelete(null);
           $this->ScrollTo($this->pnlAtheleteEdit->strFirstName);
           $this->Focus($this->pnlAtheleteEdit->strFirstName);
           if(!is_null($this->objOrg)){
                $this->pnlAtheleteEdit->strMemType->Text = $this->objOrg->ClubType;
           }
       }

    }
    public function pnlSignup_signup(){
        if(!is_null($this->pnlOrgEdit)){
            $this->pnlOrgEdit->btnSave_click();
            $this->objOrg = $this->pnlOrgEdit->GetOrg();
            $this->objOrg->Save();
        }
        if(!is_null($this->pnlAtheleteEdit)){
            $this->btnAddAthelete_click();
        }

        MLCCookieDriver::RemoveCookie(FFSQS::Org_IdOrg);
        $this->FinishSignup();
    }

    public function AppendAthelete(Athelete $objAthelete){
        $this->arrAtheletes[] = $objAthelete;
        $this->Append('#ffs-athelete-select', '<div class="alert alert-info">' . $objAthelete->__toString() . '</a>');
    }
}
