<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 * - About extends AboutBase
 */
MLCApplication::InitPackage('MLCStripe');
class message extends FFSForm{
    public $lnkIndividual = null;
    public $lnkFamily = null;
    public $lnkUseTokens = null;
    public $pnlParentMessage = null;
    public $pnlParentMessageInvite = null;
    public $pnlSignup = null;
    public $pnlStripe = null;
    public $intMessageCt = null;
    public $intCost = 0;


    public function Form_Create()
    {
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
        }*/
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/message.tpl.php';


        $this->InitParentMessageEditPanel();
        $this->InitParentMessageInvitePanel();
        $this->InitPackageOptions();
        if(is_null(MLCAuthDriver::User())){
            $this->pnlSignup = new MLCShortSignUpPanel($this);
            $this->pnlSignup->AddCssClass('row-fluid margin-bottom-25');// mjax-bs-animate-hiden');
            $this->pnlSignup->AddAction(
                new MJaxAuthSignupEvent(),
                new MJaxServerControlAction(
                    $this,
                    'pnlSignup_success'
                )
            );
        }
        $this->pnlStripe = new MJaxStripePaymentPanel($this);
        $this->pnlStripe->Template = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/MJaxStripePaymentPanel.tpl.php';
        $this->pnlStripe->UseAddress = false;
        $this->pnlStripe->AddCssClass('row-fluid margin-bottom-25');;// mjax-bs-animate-hiden');

        $this->pnlStripe->txtCardNum->AddCssClass('span4 offset1');
        $this->pnlStripe->txtCvc->AddCssClass(' span3');
        $this->pnlStripe->lstExpMonth->AddCssClass('span2');
        $this->pnlStripe->lstExpYear->AddCssClass('span2');
        $this->pnlStripe->lnkSubmit->AddCssClass('span10 offset1');

        $this->pnlStripe->AddAction(
            new MJaxStripePaymentSuccessEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlStripe_success'
            )
        );

    }
    public function InitParentMessageEditPanel(){
        $this->pnlParentMessage = new ParentMessageEditPanel($this);
        $this->pnlParentMessage->strAtheleteName->Attr('placeholder',"Athlete Name");
        $this->pnlParentMessage->strAtheleteName->Typehead($this, '_searchAthelete');
        $this->pnlParentMessage->strAtheleteName->AddCssClass('span10 offset1');


        $this->pnlParentMessage->strAtheleteName->AddCssClass('input-large');
        $this->pnlParentMessage->strMessage->AddCssClass('span10 offset1');
        $this->pnlParentMessage->strMessage->Attr('placeholder','Message');
        //$this->pnlParentMessage->btnSave->AddCssClass('span10 offset1');
        $this->pnlParentMessage->AllowSave = false;
    }
    public function InitParentMessageInvitePanel(){
        $this->pnlParentMessageInvite = new FFSParentMessageInvitePanel($this);
    }

    public function lnkIndividual_click()
    {
        $this->SelectPackage(1);


    }
    public function lnkFamily_click()
    {
        $this->SelectPackage(5);

    }
    public function lnkUseTokens_click(){
        $this->SelectPackage(0);

    }
    public function SelectPackage($intMessageCt){
        $this->intMessageCt = $intMessageCt;
        switch($this->intMessageCt){
            case(1):
                $this->intCost = 2;
                break;
            case(5):
                $this->intCost = 5;
                break;
        }
        $this->pnlStripe->Alert(
            sprintf(
                '<h3>Total:  $%s</h3>',
                $this->intCost
            ),
            'success'
        );
        //_dv(MLCStripeDriver::UserCustomer());
        if(is_null(MLCAuthDriver::User())){
            $this->DispSignup();
        }elseif(is_null(MLCStripeDriver::UserCustomer())){
            $this->DispStripe();
        }else{
            //Run the charge?
            $this->ProcessCharge();
        }

    }
    public function DispSignup(){
        $this->pnlSignup->Alert('Your information', 'alert-info');
        $this->AnimateOpen(
            $this->pnlSignup
        );
    }
    public function pnlSignup_success(){
        $this->DispStripe();
    }
    public function DispStripe(){
        $this->AnimateOpen(
            $this->pnlStripe
        );
    }
    public function pnlStripe_success(){
        $objCustomerData = $this->pnlStripe->CreateStripeCustomer();
        //_dv($objCustomerData);

    }
    public function pnlParentMessage_save(){
        if(!$this->Validate()){
            return;
        }
        $this->ScrollTo('ffs-parent-message-packages');
    }
    public function Validate(){
        $strAtheleteName = $this->pnlParentMessage->strAtheleteName->Text;
        if(strlen($strAtheleteName) < 2){
            $this->ScrollTo($this->pnlParentMessage->strAtheleteName);
            $this->Alert("<div class='alert alert-error'>Must fill in your athlete's name</div>");
            return false;
        }
        $strUsername = $this->pnlParentMessage->txtUsername->Text;
        if(strlen($strUsername) < 2){
            $this->ScrollTo($this->pnlParentMessage->txtUsername);
            $this->Alert("<div class='alert alert-error'>Must fill in from name</div>");
            return false;
        }
        return true;
    }
    public function ProcessCharge(){
        $strAtheleteName = $this->pnlParentMessage->strAtheleteName->Text;
        if(!$this->Validate()){
            return;
        }
        if($this->intMessageCt > 0){

            $objStripeData = MLCStripeDriver::ChargeUser(
                $this->intCost
            );

            //Create ParentMessages with no QueDate
            $arrMessageTokens = FFSApplication::CreateParentMessageTokens($this->intMessageCt, $objStripeData);
            $objMessageToken = $arrMessageTokens[0];
        }else{
            $objMessageToken = FFSApplication::GetAvailableMessageTokens();
            if(is_null($objMessageToken)){
                return $this->Alert("You do not have enough Message Credits for this action");
            }
        }

        FFSApplication::QueMessage(
            $strAtheleteName,
            $this->pnlParentMessage->strMessage->Text,
            self::$objCompetition,
            $objMessageToken
        );
        $this->blnForceRenderFormState = true;
        $this->blnSkipMainWindowRender = false;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/message_thankYou.tpl.php';
    }

    public function InitPackageOptions(){
        $arrMessageTokens = FFSApplication::GetAvailableMessageTokens(true);
        if(count($arrMessageTokens) > 0){
            $this->lnkUseTokens  = new MJaxLinkButton($this);
            $this->lnkUseTokens->Text = sprintf('<b>Available Messages:</b> %s - $0', count($arrMessageTokens));
            $this->lnkUseTokens->AddCssClass('btn btn-large span10 offset1');
            $this->lnkUseTokens->AddAction($this, 'lnkUseTokens_click');
        }

        $this->lnkIndividual = new MJaxLinkButton($this);
        $this->lnkIndividual->Text = 'Purchase Now';
        $this->lnkIndividual->AddCssClass('btn');
        $this->lnkIndividual->AddAction($this, 'lnkIndividual_click');

        $this->lnkFamily = new MJaxLinkButton($this);
        $this->lnkFamily->Text = 'Purchase Now';
        $this->lnkFamily->AddCssClass('btn');
        $this->lnkFamily->AddAction($this, 'lnkFamily_click');
    }


}

message::Run('message');
?>