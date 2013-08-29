<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - ConnectTable()
* - txtSearch_change()
* - GetExtQuery()
* - GetValue()
* - txtSearch_search()
* - SearchSessions()
* - SearchOrg()
* Classes list:
* - SessionSelectPanelBase extends MJaxPanel
*/
class SessionSelectPanelBase extends MJaxPanel {
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
    */
    public $txtSearch = null;
    public $tblSessions = null;
    public $intIdSession = null;
    public $txtStartDate_StartDate = null;
    public $txtStartDate_EndDate = null;
    public $txtEndDate_StartDate = null;
    public $txtEndDate_EndDate = null;
    public $intIdCompetition = null;
    public $strName = null;
    public $strNotes = null;
    public $strData = null;
    public $strEquipmentSet = null;
    public $strEventData = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this, 'txtSearch_search');
        $this->txtSearch->Name = 'idSession';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdSession = new MJaxTextBox($this);
        $this->txtStartDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtStartDate_StartDate->DateOnly();
        $this->txtStartDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtStartDate_EndDate->DateOnly();
        $this->txtEndDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtEndDate_StartDate->DateOnly();
        $this->txtEndDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtEndDate_EndDate->DateOnly();
        $this->intIdCompetition = new MJaxTextBox($this);
        $this->strName = new MJaxTextBox($this);
        $this->strNotes = new MJaxTextBox($this);
        $this->strData = new MJaxTextBox($this);
        $this->strEquipmentSet = new MJaxTextBox($this);
        $this->strEventData = new MJaxTextBox($this);
        $this->txtAdvStartDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvStartDate->DateOnly();
        $this->txtAdvEndDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvEndDate->DateOnly();
    }
    public function ConnectTable($tblSessions) {
        $this->tblSessions = $tblSessions;
        //$this->tblSessions = new SessionListPanel($this);
        $this->tblSessions->AddColumn('selected', '');
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (class_exists($arrParts[0])) {
            $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
        }
        $arrSessions = array();
        switch (get_class($objEntity)) {
            case ('Session'):
                $arrSessions = array(
                    $objEntity
                );
            break;
            case ('Competition'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idCompetition = %s', $objEntity->IdCompetition);
                $arrSessions = Session::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        if (!is_null($this->tblSessions)) {
            $this->tblSessions->RemoveAllChildControls();
            $this->tblSessions->SetDataEntites($arrSessions);
            foreach ($this->tblSessions->Rows as $intIndex => $objRow) {
                $chkSelected = new MJaxCheckBox($this);
                $chkSelected->Checked = true;
                $objRow->AddData($chkSelected, 'selected');
            }
        }
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        //Is special field!!!!!
        if (!is_null($this->txtstartDate_StartDate->Value)) {
            if (is_null($this->txtStartDate_EnddDate->Value)) {
                $this->txtStartDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(startDate > "%s" AND startDate < "%s")', $this->txtStartDate_StartDate->Text, $this->txtStartDate_EndDate->Text);
            }
        }
        //Is special field!!!!!
        if (!is_null($this->txtendDate_StartDate->Value)) {
            if (is_null($this->txtEndDate_EnddDate->Value)) {
                $this->txtEndDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(endDate > "%s" AND endDate < "%s")', $this->txtEndDate_StartDate->Text, $this->txtEndDate_EndDate->Text);
            }
        }
        $arrAndConditions[] = sprintf('name LIKE "%s%%"', $this->strName->Value);
        $arrAndConditions[] = sprintf('notes LIKE "%s%%"', $this->strNotes->Value);
        //Is special field!!!!!
        $arrAndConditions[] = sprintf('equipmentSet LIKE "%s%%"', $this->strEquipmentSet->Value);
        //Is special field!!!!!
        return $arrAndConditions;
    }
    public function GetValue() {
        $arrSessions = array();
        foreach ($this->tblSessions->Rows as $intIndex => $objRow) {
            $chkSelected = $objRow->GetData('selected');
            if ($chkSelected->Checked) {
                $arrSessions[] = $objRow->GetData('_entity');
            }
        }
        return $arrSessions;
    }
    public function txtSearch_search($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchSessions($strSearch, $arrData);
        die(json_encode($arrData));
    }
    public function SearchSessions($strSearch, &$arrData) {
        $arrAndConditions = $this->GetExtQuery();
        if (is_numeric($strSearch)) {
            $arrAndConditions[] = sprintf('(Session.idSession)', strtolower($strSearch));
        } else {
            $arrAndConditions[] = sprintf('(name LIKE "%s%%" or namespace LIKE "%s%%")', strtolower($strSearch));
        }
        $strQuery = ' WHERE ' . implode(' AND ', $arrAndConditions);
        $arrSessions = Session::Query($strQuery);
        foreach ($arrSessions as $strKey => $objSession) {
            //_dv($objSession-> getAllFields());
            $arrData[] = array(
                'value' => 'Session_' . $objSession->GetId() ,
                'text' => $objSession->__toString()
            );
        }
        return $arrData;
    }
    public function SearchOrg($strSearch, &$arrData) {
        $arrAndConditions = array();
        $strJoin = '';
        if (is_numeric($strSearch)) {
        } else {
            $arrAndConditions[] = sprintf('(name LIKE "%s%%") GROUP BY clubNum', strtolower($strSearch));
        }
        $strQuery = $strJoin . ' WHERE ' . implode(' AND ', $arrAndConditions);
        $arrOrg = Org::Query($strQuery);
        foreach ($arrOrg as $strKey => $objOrg) {
            $arrData[] = array(
                'value' => 'Org_' . $objOrg->GetId() ,
                'text' => 'Gym:' . $objOrg->Name
            );
        }
        return $arrData;
    }
}
