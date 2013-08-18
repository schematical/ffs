<?php
class FFSParentMessageFeedDisplayPanel extends FFSFeedDisplayPanel{


    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->AddCssClass('ffs-parent-message-feed');
       
    }
    public function GetShareUrl(){
        return sprintf(
            '/%s/parent/index?%s=%s',
            FFSForm::$objCompetition->Namespace,
            FFSQS::IdParentMessage,
            $this->objEntity->IdParentMessage
        );
    }
    
}