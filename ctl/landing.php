<?php
class landing extends FFSForm {
    public $pnlHeader = null;
    public $pnlCompetition = null;
    public $pnlSignup = null;
    public $lnkImport = null;

    public $pnlImport = null;
    public function Form_Create(){
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
       } */
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/landing.tpl.php';

        //$this->pnlHeader = new FFSGymLandingHeaderPanel($this);
        //$this->AddWidget('','', $this->pnlHeader);
        $this->lnkImport = new MJaxLinkButton($this);
        $this->lnkImport->Text = '<i class="icon-info-sign"></i>&nbsp;&nbsp;To import your meet directly from ProScore click here';
        $this->lnkImport->AddCssClass('alert alert-info span10 offset1');
        $this->lnkImport->AddAction($this, 'lnkImport_click');
        $this->arrRows[0][] = $this->lnkImport;
        $this->pnlCompetition = new CompetitionEditPanel($this);
        $this->pnlCompetition->AddCssClass("well");
        $this->pnlCompetition->SetUpHomePage();
        /*$this->pnlCompetition->AddAction(
            new MJaxDataEntitySaveEvent(),
            new MJaxServerControlAction(
                $this, 'pnlCompetition_click'
            )
        );*/

        //$this->AddWidget('Setup your meet', '', $this->pnlCompetition);
        $this->pnlSignup = new MLCShortSignUpPanel($this);
        $this->pnlSignup->AddCssClass("well");
        //$this->AddWidget('Create Account', '', $this->pnlSignup);

        $this->pnlSignup->AddAction(
            new MJaxAuthSignupEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlSignup_signup'
            )
        );

        $this->pnlImport =  new FFSPTFImportPanel($this);
        $this->pnlImport->AddAction(
            new FFSPTFImportEvent(),
            new MJaxServerControlAction($this, 'pnlImport_import')
        );
        //$this->pnlCompetition->SetCompetition(Competition::LoadAll()->getCollection()[0]);

    }

    public function lnkImport_click(){
        $this->Alert(
           $this->pnlImport
        );


    }
    public function pnlImport_import(){

        $this->pnlCompetition->SetCompetition(FFSForm::Competition());
        $this->pnlCompetition->objOrg = FFSForm::Org();
        $this->HideAlert();
        $this->ScrollTo($this->pnlCompetition);
        $this->pnlCompetition->Alert('Import Successfull', 'success');
    }
    public function pnlSignup_signup(){
        $this->pnlCompetition->btnSave_click();
        $this->Alert("Success");

        MLCAuthDriver::AddRoll(
            FFSRoll::ORG_MANAGER,//Roll
            $this->pnlCompetition->objOrg//Entity
        );
        $this->Redirect("/" . $this->pnlCompetition->GetCompetition()->Namespace . '/org/competition/index');
    }

}
landing::Run('landing');
?>