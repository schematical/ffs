<?php class FFSOrgHomeNavPanel extends MJaxPanel{
    public $pnlParentMessage = null;
    public $lnkInviteFamily = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);

        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->AddCssClass('shortcuts');

    }
}