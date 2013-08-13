<?php
class faq extends FFSForm {

    public function Form_Create(){
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
       } */
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/faq.tpl.php';

    }
}
faq::Run('faq');
?>