<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - SessionListPanel extends SessionListPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/SessionListPanelBase.class.php");
class SessionListPanel extends SessionListPanelBase {
    public function __construct($objParentControl, $arrSessions = array()) {
        parent::__construct($objParentControl, $arrSessions);
        $this->AddCssClass('table table-striped table-bordered table-condensed');
    }

    public function SetupCols(){


            $this->AddColumn('name','name');

            $colStartDate = $this->AddColumn('startDate','startDate');
            $colStartDate->RenderObject = $this;
            $colStartDate->RenderFunction = 'RenderTimeWithDate';

            $colEndDate = $this->AddColumn('endDate','endDate');
            $colEndDate->RenderObject = $this;
            $colEndDate->RenderFunction = 'RenderTimeWithDate';



            $this->AddColumn('equipmentSet','equipmentSet');
            
        
            

            
        
    }
    public function RenderTimeWithDate($strData, $objRow) {
        return date_format(new DateTime($strData) , 'D h:i');
    }

}
?>