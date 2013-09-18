<?php
class FFSParentMessageFeedDisplayPanel extends FFSFeedDisplayPanel{


    public function __construct($objParentControl, $objEntity){
        parent::__construct($objParentControl, $objEntity);
        $this->AddCssClass('ffs-parent-message-feed');
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';

    }
    public function GetShareUrl(){
        return sprintf(
            'https://%s/%s/parent/index?%s=%s',
            $_SERVER['SERVER_NAME'],
            FFSForm::Competition()->Namespace,
            FFSQS::IdParentMessage,
            $this->objEntity->IdParentMessage
        );
    }
    
}