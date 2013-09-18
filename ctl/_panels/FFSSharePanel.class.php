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
    public $txtEmbed = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->strEmailTemplate = __ASSETS_ACTIVE_APP_DIR__ . '/email/Share.email.php';



        $this->txtEmail = new MJaxTextBox($this);
        $this->txtEmail->Attr('placeholder', 'Email');
        $this->txtEmail->AddCssClass('input-large');

        $this->lnkFacebook = new MJaxFBShareLink($this);
        $this->lnkFacebook->AddCssClass('btn btn-large');
        $this->lnkFacebook->Text = '<i class="icon-twitter icon-2x"></i> Facebook';

        $this->lnkTwitter = new MJaxTwitterShareLink($this);
        $this->lnkTwitter->AddCssClass('btn btn-large');

        $this->lnkTwitter->Text = '<i class="icon-twitter icon-2x"></i> Twitter';

        $this->lnkEmail = new MJaxLinkButton($this);
        $this->lnkEmail->AddCssClass('btn btn-large');
        $this->lnkEmail->Text = "Email";
        $this->lnkEmail->AddAction($this, 'lnkEmail_click');

        $this->txtEmbed = new MJaxTextBox($this);
        $this->txtEmbed->TextMode = MJaxTextMode::MultiLine;
        $this->txtEmbed->CrossScripting = MJaxTextBox::Allow;
        $this->txtEmbed->ReadOnly = true;
        $this->txtEmbed->AddCssClass("span8");

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
    public function UpdateUrl($mixValue){
        $this->strUrl = $mixValue;
        $this->lnkTwitter->Url = $this->strUrl;
        $this->lnkFacebook->Link = $this->strUrl;
        $this->txtEmbed->Text =
            sprintf(
                "<iframe src='%s&embed=1' height='550Px' width='500Px' frameborder='0'></iframe>",
                $this->strUrl
            )
        ;
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

                $this->UpdateUrl($mixValue);
                return;
            case "EmailTemplate":
                return $this->strEmailTemplate = $mixValue;
            case "EmailData":
                return $this->arrEmailData = $mixValue;
            default:
                return parent::__set($strName, $mixValue);
        }
    }
}