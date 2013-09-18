<?php
class FFSResultFeedDisplayPanel extends FFSFeedDisplayPanel{
    public $strAtheleteName = null;

    public function __construct($objParentControl, $objResult){
        if($objResult instanceof FFSResultCollection){
            $this->mixExtraData = $objResult;
            $objResult = $this->mixExtraData->GetMaxDate();

        }
        parent::__construct($objParentControl, $objResult);

        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';




    }
    public function GetShareUrl(){
        $strUrl = $this->objForm->GetShareUrl();
        return sprintf(
            '%s?%s=%s',
            $strUrl,
            FFSQS::IdResult,
            $this->objEntity->IdResult
        );
    }
    
}