<?php

class index extends FFSForm {
    public $pnlMessages = null;
    //public $pnlNav = null;
    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        if(is_null(FFSForm::$objCompetition)){
            $this->Redirect('/org');
        }else{
            $this->AddWidget(
                FFSForm::$objCompetition->Name,
                'icon-home',
                new FFSOrgCompActivePanel($this, FFSForm::$objCompetition)
            );
        }

    }

}
index::Run('index');
?>