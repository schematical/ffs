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
* - SearchOrgs()
* - SearchOrg()
* Classes list:
* - OrgSelectPanelBase extends MJaxPanel
*/
class OrgSelectPanelBase extends MJaxPanel {
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
    */
    public $txtSearch = null;
    public $tblOrgs = null;
    public $intIdOrg = null;
    public $strNamespace = null;
    public $strName = null;
    public $strPsData = null;
    public $intIdImportAuthUser = null;
    public $strClubNum = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this, 'txtSearch_search');
        $this->txtSearch->Name = 'idOrg';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdOrg = new MJaxTextBox($this);
        $this->strNamespace = new MJaxTextBox($this);
        $this->strName = new MJaxTextBox($this);
        $this->strPsData = new MJaxTextBox($this);
        $this->intIdImportAuthUser = new MJaxTextBox($this);
        $this->strClubNum = new MJaxTextBox($this);
        $this->txtAdvStartDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvStartDate->DateOnly();
        $this->txtAdvEndDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvEndDate->DateOnly();
    }
    public function ConnectTable($tblOrgs) {
        $this->tblOrgs = $tblOrgs;
        //$this->tblOrgs = new OrgListPanel($this);
        $this->tblOrgs->AddColumn('selected', '');
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (class_exists($arrParts[0])) {
            $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
        }
        $arrOrgs = array();
        switch (get_class($objEntity)) {
            case ('Org'):
                $arrOrgs = array(
                    $objEntity
                );
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        if (!is_null($this->tblOrgs)) {
            $this->tblOrgs->RemoveAllChildControls();
            $this->tblOrgs->SetDataEntites($arrOrgs);
            foreach ($this->tblOrgs->Rows as $intIndex => $objRow) {
                $chkSelected = new MJaxCheckBox($this);
                $chkSelected->Checked = true;
                $objRow->AddData($chkSelected, 'selected');
            }
        }
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        $arrAndConditions[] = sprintf('namespace LIKE "%s%%"', $this->strNamespace->Value);
        $arrAndConditions[] = sprintf('name LIKE "%s%%"', $this->strName->Value);
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $arrAndConditions[] = sprintf('idImportAuthUser LIKE "%s%%"', $this->intIdImportAuthUser->Value);
        $arrAndConditions[] = sprintf('clubNum LIKE "%s%%"', $this->strClubNum->Value);
        return $arrAndConditions;
    }
    public function GetValue() {
        $arrOrgs = array();
        foreach ($this->tblOrgs->Rows as $intIndex => $objRow) {
            $chkSelected = $objRow->GetData('selected');
            if ($chkSelected->Checked) {
                $arrOrgs[] = $objRow->GetData('_entity');
            }
        }
        return $arrOrgs;
    }
    public function txtSearch_search($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchOrgs($strSearch, $arrData);
        die(json_encode($arrData));
    }
    public function SearchOrgs($strSearch, &$arrData) {
        $arrAndConditions = $this->GetExtQuery();
        if (is_numeric($strSearch)) {
            $arrAndConditions[] = sprintf('(Org.idOrg)', strtolower($strSearch));
        } else {
            $arrAndConditions[] = sprintf('(name LIKE "%s%%" or namespace LIKE "%s%%")', strtolower($strSearch));
        }
        $strQuery = ' WHERE ' . implode(' AND ', $arrAndConditions);
        $arrOrgs = Org::Query($strQuery);
        foreach ($arrOrgs as $strKey => $objOrg) {
            //_dv($objOrg-> getAllFields());
            $arrData[] = array(
                'value' => 'Org_' . $objOrg->GetId() ,
                'text' => $objOrg->__toString()
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
