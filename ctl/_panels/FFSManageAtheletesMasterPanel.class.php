<?php
class FFSManageAtheletesMasterPanel extends MJaxPanel{

    public  $lnkAddAtheleteEditPanel = null;
    public $lnkAddAtheleteInline = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->lnkAddAtheleteEditPanel = new MJaxLinkButton($this);
        $this->lnkAddAtheleteEditPanel->AddCssClass('btn btn-large');
        $this->lnkAddAtheleteEditPanel->Text = "Add another athlete";
        $this->lnkAddAtheleteEditPanel->AddAction($this->objForm, 'lnkAddAtheleteEditPanel_click');

        $this->lnkAddAtheleteInline = new MJaxLinkButton($this);
        $this->lnkAddAtheleteInline->AddCssClass('btn btn-large');
        $this->lnkAddAtheleteInline->Text = "Add another athlete";
        $this->lnkAddAtheleteInline->AddAction($this->objForm, 'lnkAddAtheleteInline_click');
    }


    
}