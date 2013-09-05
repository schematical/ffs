<?php

class index extends FFSForm {
    public $pnlMessages = null;
    //public $pnlNav = null;
    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        if(is_null(FFSForm::Competition())){
            $this->Redirect('/org');
        }else{
            $this->AddWidget(
                FFSForm::Competition()->Name,
                'icon-home',
                new FFSOrgCompActivePanel($this, FFSForm::Competition())
            );
        }

    }

}
index::Run('index');
?>