<?php
class landing extends FFSForm {
    public $pnlHeader = null;
    public $pnlCompetition = null;
    public $pnlSignup = null;
    public $lnkImport = null;
    public function Form_Create(){
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
       } */
        //$this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/landing.tpl.php';

        $this->pnlHeader = new FFSGymLandingHeaderPanel($this);
        $this->AddWidget('','', $this->pnlHeader);
        $this->lnkImport = new MJaxLinkButton($this);
        $this->lnkImport->Text = '<i class="icon-info-sign"></i>To import your meet directly from ProScore click here';
        $this->lnkImport->AddCssClass('alert alert-info span11');
        $this->lnkImport->AddAction($this, 'lnkImport_click');
        $this->arrRows[0][] = $this->lnkImport;
        $this->pnlCompetition = new CompetitionEditPanel($this);
        $this->AddWidget('Setup your meet', '', $this->pnlCompetition);
        $this->pnlSignup = new MLCShortSignUpPanel($this);
        $this->AddWidget('Create Account', '', $this->pnlSignup);

        $this->pnlSignup->AddAction(
            new MJaxAuthSignupEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlSignup_signup'
            )
        );



    }
    public function lnkImport_click(){
        $this->Alert(
            new FFSPTFImportPanel($this)
        );
    }
    public function pnlSignup_signup(){
        $this->pnlCompetition->btnSave_click();
        $this->Alert("Success");
        MLCAuthDriver::AddRoll(
            FFSRoll::ORG_MANAGER,//Roll
            $this->pnlCompetition->objOrg//Entity
        );
        $this->Redirect("/org/index");
    }

}
landing::Run('landing');
?>