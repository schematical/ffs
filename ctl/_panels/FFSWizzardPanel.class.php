<?php
class FFSWizzardPanel extends MJaxPanel{
    public $strHeader = null;
    public $strBody = null;
    public $lnkNext = null;

    public function __construct($objParentControl, $strHeader,$strBody, $strNextUrl){
        parent::__construct($objParentControl);
        $this->strHeader = $strHeader;
        $this->strBody = $strBody;

        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';



        $this->lnkNext = new MJaxLinkButton($this);
        $this->lnkNext->AddCssClass('btn btn-large');
        $this->lnkNext->Text = "Next Step";
        if(strpos('?', $strNextUrl) !== false){
            $strNextUrl .= '&' . FFSQS::UseWizzard;
        }else{
            $strNextUrl .= '?' . FFSQS::UseWizzard;
        }
        $this->lnkNext->Href = $strNextUrl ;
    }


    
}