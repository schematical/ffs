<?php

class index extends FFSForm {
    public $pnlResults = null;
    //public $pnlNav = null;
    public function Form_Create(){
        parent::Form_Create();
        $this->SecureCompetition();
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



}
index::Run('index');
?>