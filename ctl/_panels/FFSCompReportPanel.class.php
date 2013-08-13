<?php
class FFSCompReportPanel extends MJaxPanel{

    public $intMessagesSent = 0;
    public $fltDollarsRaised = 0;
    public function __construct($objParentControl, $objCompetition = null){
        parent::__construct($objParentControl);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->intMessagesSent = count(ParentMessage::LoadCollByIdCompetition($objCompetition->IdCompetition)->getCollection());
        //$this->fltDollarsRaised = ParentMessage::LoadCollByIdCompetition($objCompetition->IdCompetition);
       
    }
    
}