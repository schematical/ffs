<?php

class index extends FFSForm {
    public $pnlMessages = null;
    public $pnlHome = null;
    //public $pnlNav = null;
    public function Form_Create(){
        parent::Form_Create();
        $this->SecureCompetition();
        $this->pnlHome = new FFSOrgCompActivePanel($this, FFSForm::Competition());

        $this->InitWizzard();


        $this->AddWidget(
            FFSForm::Competition()->Name,
            'icon-home',
            $this->pnlHome
        )->AddCssClass('span12');

    }
    public function InitWizzard(){
        if(!is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $pnlWizzard = new FFSWizzardPanel(
                $this,
                'welcome to TumbleScore!',
                'Congratulations on your decision to host your first meet on TumbleScore. When you are ready to start promoting your competition on TumbleScore lets continue the tour.',
                '/' . FFSForm::Competition()->Namespace . '/org/competition/manageGyms'
            );
            $wgtWizzard =$this->AddWidget(
                'Setup Wizzard',
                'icon-list-ol',
                $pnlWizzard
            );
            $wgtWizzard->AddCssClass('span12');



            $pnlWizzard->Intro("Ready to get started?", "When you are ready to start promoting your competition on TumbleScore click here");
            $this->pnlHome->Intro("Competition Navigation", "This is the main dashboard you will use to manage your competition", null,"bottom");



        }
    }

}
index::Run('index');
?>