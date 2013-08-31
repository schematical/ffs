<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/SessionListPanelBase.class.php");
class SessionListPanel extends SessionListPanelBase {

    public function __construct($objParentControl, $arrSessions = array()){

		parent::__construct($objParentControl, $arrSessions);
        $this->AddCssClass('table table-striped table-bordered');

	}

	public function SetupCols(){
        $this->AddColumn('name','Name', null, null, 'MJaxTextBox');
        $this->AddColumn('startDate','Start', $this, 'RenderTime', 'MJaxBSDateTimePicker');
        $this->AddColumn('endDate','End', $this, 'RenderTime', 'MJaxBSDateTimePicker');
        //$this->AddColumn('idCompetition','idCompetition', null, null, 'MJaxTextBox');

        //$this->AddColumn('notes','Notes', null, null, 'MJaxTextArea');
        $this->AddColumn('equipmentSet','Equipment', null, null, 'MJaxTextBox');

    }



}


?>