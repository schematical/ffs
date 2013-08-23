<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - SetSession()
* - btnSave_click()
* - InitidCompetitionAutocomplete()
* - InitnameAutocomplete()
* - InitequipmentSetAutocomplete()
* - _searchCompetition()
* - _searchName()
* - _searchEquipmentSet()
* Classes list:
* - SessionEditPanel extends SessionEditPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/SessionEditPanelBase.class.php");
class SessionEditPanel extends SessionEditPanelBase {
    public function __construct($objParentControl, $objSession = null) {
        parent::__construct($objParentControl, $objSession);
        $this->InitidCompetitionAutocomplete();
        $this->InitNameAutocomplete();
        $this->InitEquipmentSetAutocomplete();
    }
    public function SetSession($objSession) {
        parent::SetSession($objSession);
        if ((!is_null($this->intIdCompetition)) && (!is_null($this->objSession->idCompetition))) {
            $objCompetition = Competition::LoadById($this->objSession->idCompetition);
            $this->intIdCompetition->Text = $objCompetition->Name;
            $this->intIdCompetition->Value = $objCompetition->idCompetition;
        }
        if ((!is_null($this->strName)) && (!is_null($this->objSession->name))) {
            $this->strName->Value = $this->strName->Text;
        }
        if ((!is_null($this->strEquipmentSet)) && (!is_null($this->objSession->equipmentSet))) {
            $this->strEquipmentSet->Value = $this->strEquipmentSet->Text;
        }
    }
    public function btnSave_click() {
        if (is_null($this->objSession)) {
            //Create a new one
            $this->objSession = new Session();
        }
        if ((!is_null($this->intIdCompetition))) {
            $this->objSession->idCompetition = $this->intIdCompetition->Value;
        }
        if ((!is_null($this->strName))) {
            $this->strName->Text = $this->strName->Value;
        }
        if ((!is_null($this->strEquipmentSet))) {
            $this->strEquipmentSet->Text = $this->strEquipmentSet->Value;
        }
        parent::btnSave_click();
    }
    public function InitidCompetitionAutocomplete() {
        $this->intIdCompetition = new MJaxBSAutocompleteTextBox($this, $this, '_searchCompetition');
        $this->intIdCompetition->Name = 'idCompetition';
        $this->intIdCompetition->AddCssClass('input-large');
    }
    public function InitnameAutocomplete() {
        $this->strName = new MJaxBSAutocompleteTextBox($this, $this, '_searchName');
        $this->strName->Name = 'name';
        $this->strName->AddCssClass('input-large');
    }
    public function InitequipmentSetAutocomplete() {
        $this->strEquipmentSet = new MJaxBSAutocompleteTextBox($this, $this, '_searchEquipmentSet');
        $this->strEquipmentSet->Name = 'equipmentSet';
        $this->strEquipmentSet->AddCssClass('input-large');
    }
    public function _searchCompetition($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrCompetitions = Competition::Query(sprintf('WHERE name LIKE "%s%%" or namespace LIKE "%s%%"', strtolower($strSearch) , strtolower($strSearch)));
        foreach ($arrCompetitions as $strKey => $objCompetition) {
            $arrData[$strKey] = array(
                'value' => $objCompetition->GetId() ,
                'text' => $objCompetition->Name
            );
        }
        die(json_encode($arrData));
    }
    public function _searchName($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrSessions = Session::Query(sprintf('WHERE Name LIKE "%s%%"', strtolower($strSearch)));
        foreach ($arrSessions as $strKey => $objSession) {
            $arrData[$strKey] = array(
                'value' => $objSession->Name,
                'text' => $objSession->Name
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function _searchEquipmentSet($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrSessions = Session::Query(sprintf('WHERE EquipmentSet LIKE "%s%%"', strtolower($strSearch)));
        foreach ($arrSessions as $strKey => $objSession) {
            $arrData[$strKey] = array(
                'value' => $objSession->EquipmentSet,
                'text' => $objSession->EquipmentSet
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
}
?>