<?php
class FFSResultFeedDisplayPanel extends FFSFeedDisplayPanel{
    public $strAtheleteName = null;

    public function __construct($objParentControl, $objResult){
        parent::__construct($objParentControl, $objResult);

        ;

        $objAthelete = $this->objEntity->IdAtheleteObject;
        $this->strAtheleteName = $objAthelete->FirstName . ' ' . $objAthelete->LastName;



    }
    public function GetShareUrl(){
        return sprintf(
            '%s/%s/parent/index?%s=%s',
            $_SERVER['SERVER_NAME'],
            FFSForm::Competition()->Namespace,
            FFSQS::IdResult,
            $this->objEntity->IdResult
        );
    }
    
}