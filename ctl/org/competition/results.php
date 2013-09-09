<?php

class index extends FFSForm {
    public $pnlResults = null;
    //public $pnlNav = null;
    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        if(is_null(FFSForm::Competition())){
            $this->Redirect('/org');
        }else{
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

}
index::Run('index');
?>