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
        $this->pnlStripe->MakeTwoCol();
        $this->pnlStripe->AddCssClass('mjax-bs-animate-hiden');
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
        $this->AnimateOpen(
            $this->pnlMaster
        );
    }
    public function lnkFamily_click()
    {
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
        $this->blnForceRenderFormState = true;
        $this->blnSkipMainWindowRender = false;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/index_thankYou.tpl.php';
    }

}

index::Run('index');
?>