<?php

class index extends FFSForm {
    public $pnlResults = null;
    //public $pnlNav = null;
    public function Form_Create(){
        parent::Form_Create();
        $this->SecureCompetition();
        $this->InitResultPanel();

        if(!is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $this->InitWizzard();
        }
    }
    public function InitResultPanel(){
        $this->pnlResults = new FFSResultAdvList($this);
        $arrResults = FFSApplication::GetResultsByCompetition();
        //_dv($arrResults[0]);
        $this->pnlResults->SetDataEntites(
            $arrResults
        );
        $wgtResults = $this->AddWidget(
            FFSForm::Competition()->Name,
            'icon-home',
            $this->pnlResults

        );
        $wgtResults->AddCssClass('span12');

    }
    public function InitWizzard(){

        $this->pnlResults->Intro("Meet Results", "Here is where you can view competition scores and results");


        $strUrl ='/' . FFSForm::Competition()->Namespace . '/org/competition/index';
$strBody = "Is it all starting to make sense? If you think you have it feel free to jump right in. Other wise feel free to check out our <a href='/faq'>F.A.Q</a> or <a href='/contactUs'>Contact us</a> to get a little push in the right direction";
        $pnlWizzard = new FFSWizzardPanel(
            $this,
            'Ready to start running your competition?',
            $strBody,
            $strUrl
        );
        $wgtWizzard =$this->AddWidget(
            'Setup Wizzard',
            'icon-list-ol',
            $pnlWizzard
        );
        $wgtWizzard->AddCssClass('span12');
        $pnlWizzard->Intro("Ready to start running your competition?", $strBody);


    }



}
index::Run('index');
?>