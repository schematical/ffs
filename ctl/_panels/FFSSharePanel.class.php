<?php
//Book Recomendation: The happiness advantage
class FFSSharePanel extends MJaxPanel{
    protected $strUrl = null;
    protected $strEmailTemplate = null;
    protected $arrEmailData = array();

    public $lnkFacebook = null;
    public $lnkTwitter = null;
    public $lnkEmail = null;
    public $txtEmail = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->strEmailTemplate = __ASSETS_ACTIVE_APP_DIR__ . '/email/Share.email.php';



        $this->txtEmail = new MJaxTextBox($this);
        $this->txtEmail->Attr('placeholder', 'Email');
        $this->txtEmail->AddCssClass('input-large');

        $this->lnkTwitter = new MJaxTwitterShareLink($this);
        $this->lnkTwitter->AddCssClass('btn');
        $this->lnkTwitter->Url = $this->strUrl;
        $this->lnkTwitter->Text = '<i class="icon-twitter icon-2x"></i>';

        $this->lnkEmail = new MJaxLinkButton($this);
        $this->lnkEmail->AddCssClass('btn');
        $this->lnkEmail->Text = "Email";
        $this->lnkEmail->AddAction($this, 'lnkEmail_click');
    }

    public function lnkEmail_click()
    {
        $strEmail = $this->txtEmail->Text;
        if(
            (!filter_var($strEmail, FILTER_VALIDATE_EMAIL))
        ){
            return $this->objForm->CtlAlert(
                $this->txtEmail,//->ControlId . '_holder',
                "Email is not valid"
            );
        }
        MLCApplication::InitPackage('MLCPostmark');
        $objEmail = MLCPostmarkDriver::ComposeFromTemplate(
            $this->strEmailTemplate,
            $this->arrEmailData
        );
        $objEmail->addTo(
            $this->txtEmail->Text
        );
        $objEmail->Subject('Check out');
        $objEmail->Send();

        $this->objForm->HideAlerts();
    }

    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName)
    {
        switch ($strName) {
            case "Url":
                return $this->strUrl;
            case "EmailTemplate":
                return $this->strEmailTemplate;
            case "EmailData":
                return $this->arrEmailData;

            default:
                return parent::__get($strName);
        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue)
    {
        switch ($strName) {
            case "Url":
                return $this->strUrl = $mixValue;
            case "EmailTemplate":
                return $this->strEmailTemplate = $mixValue;
            case "EmailData":
                return $this->arrEmailData = $mixValue;
            default:
                return parent::__set($strName, $mixValue);
        }
    }
}