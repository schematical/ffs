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
* - SearchAtheletes()
* - SearchOrg()
* Classes list:
* - AtheleteSelectPanelBase extends MJaxPanel
*/
class AtheleteSelectPanelBase extends MJaxPanel {
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
    */
    public $txtSearch = null;
    public $tblAtheletes = null;
    public $intIdAthelete = null;
    public $intIdOrg = null;
    public $strFirstName = null;
    public $strLastName = null;
    public $txtBirthDate_StartDate = null;
    public $txtBirthDate_EndDate = null;
    public $strMemType = null;
    public $strMemId = null;
    public $strPsData = null;
    public $strLevel = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this, 'txtSearch_search');
        $this->txtSearch->Name = 'idAthelete';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdAthelete = new MJaxTextBox($this);
        $this->intIdOrg = new MJaxTextBox($this);
        $this->strFirstName = new MJaxTextBox($this);
        $this->strLastName = new MJaxTextBox($this);
        $this->txtBirthDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtBirthDate_StartDate->DateOnly();
        $this->txtBirthDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtBirthDate_EndDate->DateOnly();
        $this->strMemType = new MJaxTextBox($this);
        $this->strMemId = new MJaxTextBox($this);
        $this->strPsData = new MJaxTextBox($this);
        $this->strLevel = new MJaxTextBox($this);
        $this->txtAdvStartDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvStartDate->DateOnly();
        $this->txtAdvEndDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvEndDate->DateOnly();
    }
    public function ConnectTable($tblAtheletes) {
        $this->tblAtheletes = $tblAtheletes;
        //$this->tblAtheletes = new AtheleteListPanel($this);
        $this->tblAtheletes->AddColumn('selected', '');
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (class_exists($arrParts[0])) {
            $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
        }
        $arrAtheletes = array();
        switch (get_class($objEntity)) {
            case ('Athelete'):
                $arrAtheletes = array(
                    $objEntity
                );
            break;
            case ('Org'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idOrg = %s', $objEntity->IdOrg);
                $arrAtheletes = Athelete::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        if (!is_null($this->tblAtheletes)) {
            $this->tblAtheletes->RemoveAllChildControls();
            $this->tblAtheletes->SetDataEntites($arrAtheletes);
            foreach ($this->tblAtheletes->Rows as $intIndex => $objRow) {
                $chkSelected = new MJaxCheckBox($this);
                $chkSelected->Checked = true;
                $objRow->AddData($chkSelected, 'selected');
            }
        }
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        $arrAndConditions[] = sprintf('firstName LIKE "%s%%"', $this->strFirstName->Value);
        $arrAndConditions[] = sprintf('lastName LIKE "%s%%"', $this->strLastName->Value);
        //Is special field!!!!!
        if (!is_null($this->txtbirthDate_StartDate->Value)) {
            if (is_null($this->txtBirthDate_EnddDate->Value)) {
                $this->txtBirthDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(birthDate > "%s" AND birthDate < "%s")', $this->txtBirthDate_StartDate->Text, $this->txtBirthDate_EndDate->Text);
            }
        }
        $arrAndConditions[] = sprintf('memType LIKE "%s%%"', $this->strMemType->Value);
        $arrAndConditions[] = sprintf('memId LIKE "%s%%"', $this->strMemId->Value);
        //Is special field!!!!!
        //Is special field!!!!!
        //Do nothing this is a creDate
        $arrAndConditions[] = sprintf('level LIKE "%s%%"', $this->strLevel->Value);
        return $arrAndConditions;
    }
    public function GetValue() {
        $arrAtheletes = array();
        foreach ($this->tblAtheletes->Rows as $intIndex => $objRow) {
            $chkSelected = $objRow->GetData('selected');
            if ($chkSelected->Checked) {
                $arrAtheletes[] = $objRow->GetData('_entity');
            }
        }
        return $arrAtheletes;
    }
    public function txtSearch_search($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchAtheletes($strSearch, $arrData);
        die(json_encode($arrData));
    }
    public function SearchAtheletes($strSearch, &$arrData) {
        $arrAndConditions = $this->GetExtQuery();
        if (is_numeric($strSearch)) {
            $arrAndConditions[] = sprintf('(Athelete.idAthelete)', strtolower($strSearch));
        } else {
            $arrAndConditions[] = sprintf('(name LIKE "%s%%" or namespace LIKE "%s%%")', strtolower($strSearch));
        }
        $strQuery = ' WHERE ' . implode(' AND ', $arrAndConditions);
        $arrAtheletes = Athelete::Query($strQuery);
        foreach ($arrAtheletes as $strKey => $objAthelete) {
            //_dv($objAthelete-> getAllFields());
            $arrData[] = array(
                'value' => 'Athelete_' . $objAthelete->GetId() ,
                'text' => $objAthelete->__toString()
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
