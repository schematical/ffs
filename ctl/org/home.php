<?php
class home extends FFSForm {

    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        //$this->Alert("WRitethis");

    }

}
home::Run('home');