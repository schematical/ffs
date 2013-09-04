<?php
class home extends FFSForm {

    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        //$this->Alert("WRitethis");
        //_dv(FFSForm::$strSection);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/org/home.tpl.php';

    }

}
home::Run('home');