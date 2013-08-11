<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - About extends AboutBase
*/

class Signin extends FFSForm {
    public $pnlLogin = null;
    public function Form_Create(){
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
       } */
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/signin.tpl.php';
        $this->pnlLogin = new MLCLoginPanel($this);
        $this->pnlLogin->Template = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/pnlLogin.tpl.php';
        $this->pnlLogin->txtEmail->Attr('placeholder','Email');
        $this->pnlLogin->txtPass->Attr('placeholder','Password');
        $this->pnlLogin->btnSubmit->AddCssClass('btn btn-inverse pull-right');
        $this->pnlLogin->AddAction(new MJaxAuthLoginEvent(),  new MJaxServerControlAction($this, 'pnlLogin_login'));
    }
    public function pnlLogin_login(){
        $this->Redirect('/');
    }
}
Signin::Run('Signin');
?>