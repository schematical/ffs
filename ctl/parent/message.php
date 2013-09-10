<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 * - About extends AboutBase
 */
MLCApplication::InitPackage('MLCStripe');
MLCStripeDriver::Init();
class message extends FFSForm{
    protected $objStripeCustomer = null;
    public $intAvailMessages = 0;
    public $lnkIndividual = null;
    public $lnkFamily = null;
    public $lnkTeam = null;
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
        $this->intAvailMessages = count(FFSApplication::GetAvailableMessageTokens(true));

        $this->InitParentMessageEditPanel();
        $this->InitParentMessageInvitePanel();
        $this->InitPackageOptions();
        if(is_null(MLCAuthDriver::User())){

            $this->pnlSignup = new MLCShortSignUpPanel($this);
            //$this->pnlSignup->AddCssClass('row-fluid margin-bottom-25');// mjax-bs-animate-hiden');
            $this->pnlSignup->AddAction(
                new MJaxAuthSignupEvent(),
                new MJaxServerControlAction(
                    $this,
                    'pnlSignup_success'
                )
            );
        }else{
            $this->objStripeCustomer = MLCStripeDriver::UserCustomer();
        }

        if(is_null($this->objStripeCustomer)){
            $this->pnlStripe = new MJaxStripePaymentPanel($this);
            $this->pnlStripe->Template = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/MJaxStripePaymentPanel.tpl.php';
            $this->pnlStripe->UseAddress = false;
        }else{
            $this->pnlStripe = new MJaxStripeCardSelectPanel($this, null, $this->objStripeCustomer);
        }
        $this->pnlStripe->AddAction(
            new MJaxStripePaymentSuccessEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlStripe_success'
            )
        );
        $this->pnlStripe->AddAction(
            new MJaxStripePaymentErrorEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlStripe_error'
            )
        );






    }
    public function InitParentMessageEditPanel(){
        $this->pnlParentMessage = new ParentMessageEditPanel($this);

        $this->pnlParentMessage->AllowSave = false;
        $this->pnlParentMessage->btnSave->Text = 'Shout it!';
        $this->pnlParentMessage->AddAction(
            new MJaxSuccessEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlParentMessage_success'
            )
        );
        $intIdAthelete = MLCApplication::QS(FFSQS::IdAthelete);
        if(is_null($intIdAthelete)){
            $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);
        }
        $this->pnlParentMessage->intIdAthelete->SetValue(
            Athelete::LoadById($intIdAthelete)
        );
    }
    public function pnlParentMessage_success(){
        if(!$this->Validate()){
            return;
        }
        if($this->intAvailMessages > 0){
            $this->ProcessCharge();
        }else{
            $this->ScrollTo('ffs-parent-message-packages');
        }
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
    public function lnkTeam_click()
    {
        $this->SelectPackage(25);

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
            case(25):
                $this->intCost = 20;
                break;
        }
        $this->pnlStripe->Alert(
            sprintf(
                'You are about to purchase
                    <b>%s</b> Shout Outs for <b>$%s</b>',
                $this->intMessageCt,
                $this->intCost
            ),
            'success'
        );
        //$this->ProcessCharge();
        $this->Detach('#divPleaseSelectPackage');
        if(!is_null($this->pnlSignup)){
            $this->ScrollTo($this->pnlSignup);
        }else{
            $this->ScrollTo($this->pnlStripe);
        }


    }

    public function pnlStripe_success(){
        if(!is_null(MLCAuthDriver::User())){
            if(is_null($this->objStripeCustomer)){
                    $this->objStripeCustomer = $this->pnlStripe->CreateStripeCustomer();

            }else{
                //$this->objStripeCustomer =
            }
            $this->ProcessCharge();
        }else{
            $this->ScrollTo($this->pnlSignup);
            $this->pnlSignup->Alert("Must sign up before you can pay",'info');
            $this->pnlStripe->Alert("Please sign up before you pay", 'error');
        }

    }
    public function pnlSignup_success(){
        $this->pnlSignup->Alert("Success",'info');
        $this->ScrollTo($this->pnlStripe);
    }
    public function pnlStripe_error(){
        if(!is_null($this->objStripeCustomer)){
            $this->pnlStripe->Alert("Please select a valid card");
        }
    }

    public function Validate(){
        $mixAtheleteName = $this->pnlParentMessage->intIdAthelete->GetValue();

        if(
            !(
                (is_object($mixAtheleteName)) &&
                ($mixAtheleteName instanceof Athelete)
            ) && !(
                (is_string($mixAtheleteName)) &&
                (strlen($mixAtheleteName) < 2)
            )
        ){
            $this->ScrollTo($this->pnlParentMessage->intIdAthelete);
            $this->pnlParentMessage->intIdAthelete->Alert("Must fill in your athlete's name", 'error');
            return false;
        }
        $strFromName = $this->pnlParentMessage->strFromName->Text;
        if(strlen($strFromName) < 2){
            $this->ScrollTo($this->pnlParentMessage->strFromName);
            $this->pnlParentMessage->strFromName->Alert("Must fill in your name", 'error');
            return false;
        }
        $strMessage = $this->pnlParentMessage->strMessage->Text;
        if(strlen($strMessage) < 2){
            $this->ScrollTo($this->pnlParentMessage->strMessage);
            $this->pnlParentMessage->strMessage->Alert("What is your positive message?", 'error');
            return false;
        }
        return true;
    }
    public function ProcessCharge(){

        if(!$this->Validate()){
            return;
        }
        if($this->intMessageCt > 0){

            $objStripeData = MLCStripeDriver::ChargeUser(
                $this->intCost,
                $this->objStripeCustomer
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

        $strAtheleteName = $this->pnlParentMessage->intIdAthelete->GetValue();
        FFSApplication::QueMessage(
            $strAtheleteName,
            $this->pnlParentMessage->strMessage->Text,
            $this->pnlParentMessage->strFromName->Text,
            self::Competition(),
            $objMessageToken
        );
        $this->blnForceRenderFormState = true;
        $this->blnSkipMainWindowRender = false;
        $this->Redirect(
            '/' . $this->Competition()->Namespace .'',
            array(
                FFSQS::ParentMessage_IdParentMessage => $objMessageToken->IdParentMessage
            )
        );
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

        $this->lnkTeam = new MJaxLinkButton($this);
        $this->lnkTeam->Text = 'Purchase Now';
        $this->lnkTeam->AddCssClass('btn');
        $this->lnkTeam->AddAction($this, 'lnkTeam_click');
    }


}

message::Run('message');
?>