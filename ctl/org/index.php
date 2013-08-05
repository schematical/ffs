<?php

class index extends FFSForm {
    public $pnlNav = null;
    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        //$this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/index.tpl.php';

        $this->pnlNav = new FFSOrgHomeNavPanel($this);
        $this->AddWidget('Welcome','icon-home', $this->pnlNav);

    }

}
index::Run('index');
?>