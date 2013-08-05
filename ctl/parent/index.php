<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 * - About extends AboutBase
 */
MLCApplication::InitPackage('MLCStripe');
class index extends FFSForm
{
    public $lnkIndividual = null;
    public $lnkFamily = null;
    public $pnlMaster = null;
    public $pnlStripe = null;
    public $intMessageCt = null;


    public function Form_Create()
    {
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
        }*/
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/index.tpl.php';

        $this->lnkIndividual = new MJaxLinkButton($this);
        $this->lnkIndividual->Text = '<b>Individual: </b>1 message - $2';
        $this->lnkIndividual->AddCssClass('btn btn-large span10 offset1');
        $this->lnkIndividual->AddAction($this, 'lnkIndividual_click');

        $this->lnkFamily = new MJaxLinkButton($this);
        $this->lnkFamily->Text = '<b>Family Pack:</b> 5 message - $5';
        $this->lnkFamily->AddCssClass('btn btn-large btn-success span10 offset1');
        $this->lnkFamily->AddAction($this, 'lnkFamily_click');

        $this->pnlMaster = new FFSParentMessageManagePanel($this);

        $this->pnlStripe = new MJaxStripePaymentPanel($this);
        $this->pnlStripe->Template = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/MJaxStripePaymentPanel.tpl.php';
        $this->pnlStripe->UseAddress = false;
        $this->pnlStripe->AddCssClass('row margin-bottom-25 mjax-bs-animate-hiden');

        $this->pnlStripe->txtCardNum->AddCssClass('input-mlarge span4 offset1');
        $this->pnlStripe->txtCvc->AddCssClass('input-mlarge span3');
        $this->pnlStripe->lstExpMonth->AddCssClass('input-mlarge span2');
        $this->pnlStripe->lstExpYear->AddCssClass('input-mlarge span2');
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
        $this->pnlMaster->InitInviteFamilyLink();
    }
    public function lnkFamily_click()
    {
        $this->intMessageCt = 5;
        $this->pnlMaster->InitInviteFamilyFields();
        $this->AnimateOpen(
            $this->pnlMaster
        );
    }
    public function DispStripe(){
        $this->AnimateOpen(
            $this->pnlStripe
        );
    }
    public function pnlStripe_success(){
        $arrCustomerData = $this->pnlStripe->CreateStripeCustomer();
        //MLCStripeDriver::
        //Create ParentMessages with no QueDate
        FFSApplication::CreateParentMessageTokens($this->intMessageCt);
        $this->blnForceRenderFormState = true;
        $this->blnSkipMainWindowRender = false;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/index_thankYou.tpl.php';
    }

}

index::Run('index');
?>