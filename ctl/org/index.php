<?php

class index extends FFSForm {
    public $pnlMessages = null;
    //public $pnlNav = null;
    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }

        //$this->pnlNav = new FFSOrgHomeNavPanel($this);
        //$this->AddWidget('Welcome','icon-home', $this->pnlNav);


        $arrCompitions = FFSApplication::GetActiveCompetitons();

        foreach($arrCompitions as $intIndex => $objCompetition){

            $this->AddWidget(
                $objCompetition->Name,
                'icon-home',
                new FFSOrgCompActivePanel($this, $objCompetition)
            );
        }
    }

}
index::Run('index');
?>