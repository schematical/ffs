<?php
class FFSScoreDisplayPanel extends MJaxPanel{
    public $arrIndResults = array();
    public $strAtheleteName = null;
    public $fltScore = null;
    public $strEvent = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
       
    }
    public function Update($arrIndResults){
        $this->arrIndResults = $arrIndResults;
        $arrKeys = array_keys($this->arrIndResults);
        if(is_null($this->arrIndResults[$arrKeys[0]]->DispDate)){
            foreach($this->arrIndResults as $intIndex => $objResult){
                $objResult->DispDate = MLCDateTime::Now();
                $objResult->Save();
            }
        }
        $this->strEvent = $this->arrIndResults[$arrKeys[0]]->Event;
        $objAthelete = $this->arrIndResults[$arrKeys[0]]->IdAtheleteObject;
        //_dv($objMessage);
        $this->strAtheleteName = $objAthelete->FirstName . ' ' . $objAthelete->LastName;
        $this->fltScore = FFSApplication::AvgResults($this->arrIndResults);
        $this->blnModified = true;
    }
    
}