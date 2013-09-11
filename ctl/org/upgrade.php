<?php
class upgrade extends FFSForm {

    public function Form_Create(){
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
       } */
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/org/upgrade.tpl.php';

    }


}
upgrade::Run('upgrade');
?>