<?php
class FFSParentMessageFeedDisplayPanel extends FFSFeedDisplayPanel{


    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->AddCssClass('ffs-parent-message-feed');
       
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