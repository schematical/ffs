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
* - SearchCompetitions()
* - SearchOrg()
* Classes list:
* - CompetitionSelectPanelBase extends MJaxPanel
*/
class CompetitionSelectPanelBase extends MJaxPanel {
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
    */
    public $txtSearch = null;
    public $tblCompetitions = null;
    public $intIdCompetition = null;
    public $strName = null;
    public $strLongDesc = null;
    public $txtStartDate_StartDate = null;
    public $txtStartDate_EndDate = null;
    public $txtEndDate_StartDate = null;
    public $txtEndDate_EndDate = null;
    public $intIdOrg = null;
    public $strNamespace = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this, 'txtSearch_search');
        $this->txtSearch->Name = 'idCompetition';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdCompetition = new MJaxTextBox($this);
        $this->strName = new MJaxTextBox($this);
        $this->strLongDesc = new MJaxTextBox($this);
        $this->txtStartDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtStartDate_StartDate->DateOnly();
        $this->txtStartDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtStartDate_EndDate->DateOnly();
        $this->txtEndDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtEndDate_StartDate->DateOnly();
        $this->txtEndDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtEndDate_EndDate->DateOnly();
        $this->intIdOrg = new MJaxTextBox($this);
        $this->strNamespace = new MJaxTextBox($this);
        $this->txtAdvStartDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvStartDate->DateOnly();
        $this->txtAdvEndDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvEndDate->DateOnly();
    }
    public function ConnectTable($tblCompetitions) {
        $this->tblCompetitions = $tblCompetitions;
        //$this->tblCompetitions = new CompetitionListPanel($this);
        $this->tblCompetitions->AddColumn('selected', '');
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (class_exists($arrParts[0])) {
            $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
        }
        $arrCompetitions = array();
        switch (get_class($objEntity)) {
            case ('Competition'):
                $arrCompetitions = array(
                    $objEntity
                );
            break;
            case ('Org'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idOrg = %s', $objEntity->IdOrg);
                $arrCompetitions = Competition::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        if (!is_null($this->tblCompetitions)) {
            $this->tblCompetitions->RemoveAllChildControls();
            $this->tblCompetitions->SetDataEntites($arrCompetitions);
            foreach ($this->tblCompetitions->Rows as $intIndex => $objRow) {
                $chkSelected = new MJaxCheckBox($this);
                $chkSelected->Checked = true;
                $objRow->AddData($chkSelected, 'selected');
            }
        }
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        $arrAndConditions[] = sprintf('name LIKE "%s%%"', $this->strName->Value);
        $arrAndConditions[] = sprintf('longDesc LIKE "%s%%"', $this->strLongDesc->Value);
        //Is special field!!!!!
        //Do nothing this is a creDate
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
        $arrAndConditions[] = sprintf('namespace LIKE "%s%%"', $this->strNamespace->Value);
        return $arrAndConditions;
    }
    public function GetValue() {
        $arrCompetitions = array();
        foreach ($this->tblCompetitions->Rows as $intIndex => $objRow) {
            $chkSelected = $objRow->GetData('selected');
            if ($chkSelected->Checked) {
                $arrCompetitions[] = $objRow->GetData('_entity');
            }
        }
        return $arrCompetitions;
    }
    public function txtSearch_search($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchCompetitions($strSearch, $arrData);
        die(json_encode($arrData));
    }
    public function SearchCompetitions($strSearch, &$arrData) {
        $arrAndConditions = $this->GetExtQuery();
        if (is_numeric($strSearch)) {
            $arrAndConditions[] = sprintf('(Competition.idCompetition)', strtolower($strSearch));
        } else {
            $arrAndConditions[] = sprintf('(name LIKE "%s%%" or namespace LIKE "%s%%")', strtolower($strSearch));
        }
        $strQuery = ' WHERE ' . implode(' AND ', $arrAndConditions);
        $arrCompetitions = Competition::Query($strQuery);
        foreach ($arrCompetitions as $strKey => $objCompetition) {
            //_dv($objCompetition-> getAllFields());
            $arrData[] = array(
                'value' => 'Competition_' . $objCompetition->GetId() ,
                'text' => $objCompetition->__toString()
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
