<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 * - About extends AboutBase
 */
MLCApplication::InitPackage('MLCStripe');
class message extends FFSForm
{
    public $lnkIndividual = null;
    public $lnkFamily = null;
    public $lnkUseTokens = null;
    public $pnlMaster = null;
    public $pnlSignup = null;
    public $pnlStripe = null;
    public $intMessageCt = null;


    public function Form_Create()
    {
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
        }*/
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/message.tpl.php';

        $arrMessageTokens = FFSApplication::GetAvailableMessageTokens(true);
        if(count($arrMessageTokens) > 0){
            $this->lnkUseTokens  = new MJaxLinkButton($this);
            $this->lnkUseTokens->Text = sprintf('<b>Available Messages:</b> %s - $0', count($arrMessageTokens));
            $this->lnkUseTokens->AddCssClass('btn btn-large span10 offset1');
            $this->lnkUseTokens->AddAction($this, 'lnkUseTokens_click');
        }

        $this->lnkIndividual = new MJaxLinkButton($this);
        $this->lnkIndividual->Text = '<b>Individual: </b>1 message - $2';
        $this->lnkIndividual->AddCssClass('btn btn-large span10 offset1');
        $this->lnkIndividual->AddAction($this, 'lnkIndividual_click');

        $this->lnkFamily = new MJaxLinkButton($this);
        $this->lnkFamily->Text = '<b>Family Pack:</b> 5 messages - $5';
        $this->lnkFamily->AddCssClass('btn btn-large btn-success span10 offset1');
        $this->lnkFamily->AddAction($this, 'lnkFamily_click');

        $this->pnlMaster = new FFSParentMessageManagePanel($this);
        $this->pnlMaster->InitInviteFamilyLink();
        $this->pnlMaster->Attr('data-orig-height', 338);//156);

        $this->pnlSignup = new MLCShortSignUpPanel($this);
        $this->pnlSignup->AddCssClass('row-fluid margin-bottom-25 mjax-bs-animate-hiden');
        $this->pnlSignup->AddAction(
            new MJaxAuthSignupEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlSignup_success'
            )
        );

        $this->pnlStripe = new MJaxStripePaymentPanel($this);
        $this->pnlStripe->Template = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/MJaxStripePaymentPanel.tpl.php';
        $this->pnlStripe->UseAddress = false;
        $this->pnlStripe->AddCssClass('row-fluid margin-bottom-25 mjax-bs-animate-hiden');

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

    public function lnkIndividual_click()
    {
        $this->intMessageCt = 1;
        $this->AnimateOpen(
            $this->pnlMaster
        );

    }
    public function lnkFamily_click()
    {
        $this->intMessageCt = 5;
        $this->pnlMaster->InitInviteFamilyFields();
        $this->AnimateOpen(
            $this->pnlMaster
        );
    }
    public function lnkUseTokens_click(){
        $this->intMessageCt = 0;
        //$this->pnlMaster->InitInviteFamilyFields();
        $this->AnimateOpen(
            $this->pnlMaster
        );
    }
    public function pnlParentMessage_send(){
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
    public function ProcessCharge(){
        $strAtheleteName = $this->pnlMaster->pnlParentMessage->strAtheleteName->Text;
        if(strlen($strAtheleteName) < 2){
            return $this->pnlMaster->pnlParentMessage->strAtheleteName->Alert("Must fill in your athelete's name");
        }
        if($this->intMessageCt > 0){
            switch($this->intMessageCt){
                case(1):
                    $intCost = 2;
                    break;
                case(5):
                    $intCost = 5;
                    break;
            }
            $objStripeData = MLCStripeDriver::ChargeUser(
                $intCost
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
            $this->pnlMaster->pnlParentMessage->strMessage->Text,
            self::$objCompetition,
            $objMessageToken
        );
        $this->blnForceRenderFormState = true;
        $this->blnSkipMainWindowRender = false;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/message_thankYou.tpl.php';
    }

}

message::Run('message');
?>