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
* - SearchAssignments()
* - SearchOrg()
* Classes list:
* - AssignmentSelectPanelBase extends MJaxPanel
*/
class AssignmentSelectPanelBase extends MJaxPanel {
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
    */
    public $txtSearch = null;
    public $tblAssignments = null;
    public $intIdAssignment = null;
    public $intIdDevice = null;
    public $intIdSession = null;
    public $strEvent = null;
    public $strApartatus = null;
    public $intIdUser = null;
    public $txtRevokeDate_StartDate = null;
    public $txtRevokeDate_EndDate = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this, 'txtSearch_search');
        $this->txtSearch->Name = 'idAssignment';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdAssignment = new MJaxTextBox($this);
        $this->intIdDevice = new MJaxTextBox($this);
        $this->intIdSession = new MJaxTextBox($this);
        $this->strEvent = new MJaxTextBox($this);
        $this->strApartatus = new MJaxTextBox($this);
        $this->intIdUser = new MJaxTextBox($this);
        $this->txtRevokeDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtRevokeDate_StartDate->DateOnly();
        $this->txtRevokeDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtRevokeDate_EndDate->DateOnly();
        $this->txtAdvStartDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvStartDate->DateOnly();
        $this->txtAdvEndDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvEndDate->DateOnly();
    }
    public function ConnectTable($tblAssignments) {
        $this->tblAssignments = $tblAssignments;
        //$this->tblAssignments = new AssignmentListPanel($this);
        $this->tblAssignments->AddColumn('selected', '');
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (class_exists($arrParts[0])) {
            $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
        }
        $arrAssignments = array();
        switch (get_class($objEntity)) {
            case ('Assignment'):
                $arrAssignments = array(
                    $objEntity
                );
            break;
            case ('Device'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idDevice = %s', $objEntity->IdDevice);
                $arrAssignments = Assignment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Session'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idSession = %s', $objEntity->IdSession);
                $arrAssignments = Assignment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        if (!is_null($this->tblAssignments)) {
            $this->tblAssignments->RemoveAllChildControls();
            $this->tblAssignments->SetDataEntites($arrAssignments);
            foreach ($this->tblAssignments->Rows as $intIndex => $objRow) {
                $chkSelected = new MJaxCheckBox($this);
                $chkSelected->Checked = true;
                $objRow->AddData($chkSelected, 'selected');
            }
        }
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        $arrAndConditions[] = sprintf('event LIKE "%s%%"', $this->strEvent->Value);
        $arrAndConditions[] = sprintf('apartatus LIKE "%s%%"', $this->strApartatus->Value);
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        //Is special field!!!!!
        if (!is_null($this->txtrevokeDate_StartDate->Value)) {
            if (is_null($this->txtRevokeDate_EnddDate->Value)) {
                $this->txtRevokeDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(revokeDate > "%s" AND revokeDate < "%s")', $this->txtRevokeDate_StartDate->Text, $this->txtRevokeDate_EndDate->Text);
            }
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        $arrAssignments = array();
        foreach ($this->tblAssignments->Rows as $intIndex => $objRow) {
            $chkSelected = $objRow->GetData('selected');
            if ($chkSelected->Checked) {
                $arrAssignments[] = $objRow->GetData('_entity');
            }
        }
        return $arrAssignments;
    }
    public function txtSearch_search($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchAssignments($strSearch, $arrData);
        die(json_encode($arrData));
    }
    public function SearchAssignments($strSearch, &$arrData) {
        $arrAndConditions = $this->GetExtQuery();
        if (is_numeric($strSearch)) {
            $arrAndConditions[] = sprintf('(Assignment.idAssignment)', strtolower($strSearch));
        } else {
            $arrAndConditions[] = sprintf('(name LIKE "%s%%" or namespace LIKE "%s%%")', strtolower($strSearch));
        }
        $strQuery = ' WHERE ' . implode(' AND ', $arrAndConditions);
        $arrAssignments = Assignment::Query($strQuery);
        foreach ($arrAssignments as $strKey => $objAssignment) {
            //_dv($objAssignment-> getAllFields());
            $arrData[] = array(
                'value' => 'Assignment_' . $objAssignment->GetId() ,
                'text' => $objAssignment->__toString()
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
