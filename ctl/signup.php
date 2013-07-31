<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - Signup extends SignupBase
*/

require_once ('_config.inc.php');
MLCApplication::InitPackage('MLCStripe');
class Signup extends MLCForm {

  	protected $pnlSignUp = null;

    public function Form_Create(){
	    parent::Form_Create();
        if(!is_null(MLCAuthDriver::User())){
            $this->Redirect('/');
        }
        if(
            (
                (SERVER_ENV == 'prod') &&
                ($_SERVER['HTTP_X_FORWARDED_PROTO'] != 'https')
            )
        ){
            $this->Redirect('https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
        }
        $this->CreateControls();
    }
    public function CreateControls(){
        $this->pnlSignUp = new MLCSignUpPanel($this, 'pnlSignUp');
		$this->pnlSignUp->AddAction(
			new MJaxAuthSignupEvent(),
			new MJaxServerControlAction($this, 'pnlSignUp_auth_signup')
		);
        $this->pnlSignUp->Template = __VIEW_ACTIVE_APP_DIR__.  '/www/_panels/pnlSignup.tpl.php';

    }

	public function pnlSignUp_auth_signup($strFormId, $strControlId, $mixActionParam) {
        $this->Redirect('/build/index.php');
    }

    
    
}
Signup::Run('Signup');
?>