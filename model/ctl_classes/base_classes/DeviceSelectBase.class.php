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
* - SearchDevices()
* - SearchOrg()
* Classes list:
* - DeviceSelectPanelBase extends MJaxPanel
*/
class DeviceSelectPanelBase extends MJaxPanel {
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
    */
    public $txtSearch = null;
    public $tblDevices = null;
    public $intIdDevice = null;
    public $strName = null;
    public $strToken = null;
    public $strInviteEmail = null;
    public $intIdOrg = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this, 'txtSearch_search');
        $this->txtSearch->Name = 'idDevice';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdDevice = new MJaxTextBox($this);
        $this->strName = new MJaxTextBox($this);
        $this->strToken = new MJaxTextBox($this);
        $this->strInviteEmail = new MJaxTextBox($this);
        $this->intIdOrg = new MJaxTextBox($this);
        $this->txtAdvStartDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvStartDate->DateOnly();
        $this->txtAdvEndDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvEndDate->DateOnly();
    }
    public function ConnectTable($tblDevices) {
        $this->tblDevices = $tblDevices;
        //$this->tblDevices = new DeviceListPanel($this);
        $this->tblDevices->AddColumn('selected', '');
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (class_exists($arrParts[0])) {
            $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
        }
        $arrDevices = array();
        switch (get_class($objEntity)) {
            case ('Device'):
                $arrDevices = array(
                    $objEntity
                );
            break;
            case ('Org'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idOrg = %s', $objEntity->IdOrg);
                $arrDevices = Device::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        if (!is_null($this->tblDevices)) {
            $this->tblDevices->RemoveAllChildControls();
            $this->tblDevices->SetDataEntites($arrDevices);
            foreach ($this->tblDevices->Rows as $intIndex => $objRow) {
                $chkSelected = new MJaxCheckBox($this);
                $chkSelected->Checked = true;
                $objRow->AddData($chkSelected, 'selected');
            }
        }
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        $arrAndConditions[] = sprintf('name LIKE "%s%%"', $this->strName->Value);
        $arrAndConditions[] = sprintf('token LIKE "%s%%"', $this->strToken->Value);
        //Is special field!!!!!
        //Do nothing this is a creDate
        $arrAndConditions[] = sprintf('inviteEmail LIKE "%s%%"', $this->strInviteEmail->Value);
        return $arrAndConditions;
    }
    public function GetValue() {
        $arrDevices = array();
        foreach ($this->tblDevices->Rows as $intIndex => $objRow) {
            $chkSelected = $objRow->GetData('selected');
            if ($chkSelected->Checked) {
                $arrDevices[] = $objRow->GetData('_entity');
            }
        }
        return $arrDevices;
    }
    public function txtSearch_search($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchDevices($strSearch, $arrData);
        die(json_encode($arrData));
    }
    public function SearchDevices($strSearch, &$arrData) {
        $arrAndConditions = $this->GetExtQuery();
        if (is_numeric($strSearch)) {
            $arrAndConditions[] = sprintf('(Device.idDevice)', strtolower($strSearch));
        } else {
            $arrAndConditions[] = sprintf('(name LIKE "%s%%" or namespace LIKE "%s%%")', strtolower($strSearch));
        }
        $strQuery = ' WHERE ' . implode(' AND ', $arrAndConditions);
        $arrDevices = Device::Query($strQuery);
        foreach ($arrDevices as $strKey => $objDevice) {
            //_dv($objDevice-> getAllFields());
            $arrData[] = array(
                'value' => 'Device_' . $objDevice->GetId() ,
                'text' => $objDevice->__toString()
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
