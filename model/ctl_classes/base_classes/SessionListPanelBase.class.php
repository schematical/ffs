<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - InitRemoveButtons()
* - lnkRemove_click()
* - RenderDate()
* - RenderTime()
* - SetupCols()
* - InitRowClickEntityRelAction()
* - objRow_click()
* Classes list:
* - SessionListPanelBase extends MJaxTable
*/
class SessionListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrSessions = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrSessions);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objSession = Session::LoadById($strActionParameter);
        if (!is_null($objSession)) {
            $objSession->markDeleted();
        }
        foreach ($this->Rows as $intIndex => $objRow) {
            if ($objRow->ActionParameter == $strActionParameter) {
                $objRow->Remove();
                //unset($this->Rows[$intIndex]);
                $this->blnModified = true;
                return;
            }
        }
    }
    public function RenderDate($strData, $objRow) {
        return date_format(new DateTime($strData) , 'm/d/y');
    }
    public function RenderTime($strData, $objRow) {
        return date_format(new DateTime($strData) , 'h:i');
    }
    public function SetupCols() {
        //$this->AddColumn('idSession','idSession');
        $this->AddColumn('startDate', ' Start Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('endDate', ' End Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('idCompetition', ' Id Competition', null, null, 'MJaxTextBox');
        $this->AddColumn('name', ' Name', null, null, 'MJaxTextBox');
        $this->AddColumn('notes', ' Notes', null, null, 'MJaxTextArea');
        $this->AddColumn('equipmentSet', ' Equipment Set', null, null, 'MJaxTextBox');
    }
    /*
    Old stuff
    */
    public function InitRowClickEntityRelAction() {
        foreach ($this->Rows as $intIndex => $objRow) {
            $objRow->AddAction($this, 'objRow_click');
        }
    }
    public function objRow_click($strFomrId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Session/' . $strActionParameter);
    }
}
?>