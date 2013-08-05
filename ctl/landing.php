<?php

class landing extends FFSForm {
    public $pnlHeader = null;
    public $pnlCompetition = null;
    public $pnlSignup = null;
    public function Form_Create(){
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
       } */
        //$this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/landing.tpl.php';

        $this->pnlHeader = new FFSGymLandingHeaderPanel($this);
        $this->AddWidget('','', $this->pnlHeader);
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
    public function pnlSignup_signup(){
        $this->pnlCompetition->btnSave_click();
        $this->Alert("Success");
    }
}
landing::Run('landing');
?>