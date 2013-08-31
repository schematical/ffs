<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - ResultListPanel extends ResultListPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/ResultListPanelBase.class.php");
class ResultListPanel extends ResultListPanelBase {
    public function __construct($objParentControl, $arrResults = array()) {
        parent::__construct($objParentControl, $arrResults);
        $this->AddCssClass('table table-striped table-bordered table-condensed');
    }
    /*
    public function SetupCols(){
        
            
            $this->AddColumn('idResult','idResult');
            
            
        
            
            
            $this->AddColumn('idSession','idSession');
            
        
            
            
            $this->AddColumn('idAthelete','idAthelete');
            
        
            
            
            $this->AddColumn('score','score');
            
        
            
            
            $this->AddColumn('judge','judge');
            
        
            
            
            $this->AddColumn('flag','flag');
            
        
            
            
            $this->AddColumn('creDate','creDate');
            
        
            
            
            $this->AddColumn('event','event');
            
        
            
            
            $this->AddColumn('dispDate','dispDate');
            
        
    }
    */
}
?>