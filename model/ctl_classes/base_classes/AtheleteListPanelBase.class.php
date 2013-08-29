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
* - AtheleteListPanelBase extends MJaxTable
*/
class AtheleteListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrAtheletes = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrAtheletes);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objAthelete = Athelete::LoadById($strActionParameter);
        if (!is_null($objAthelete)) {
            $objAthelete->markDeleted();
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
        //$this->AddColumn('idAthelete','idAthelete');
        $this->AddColumn('idOrg', ' Id Org', null, null, 'MJaxTextBox');
        $this->AddColumn('firstName', ' First Name', null, null, 'MJaxTextBox');
        $this->AddColumn('lastName', ' Last Name', null, null, 'MJaxTextBox');
        $this->AddColumn('birthDate', ' Birth Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('memType', ' Mem Type', null, null, 'MJaxTextBox');
        $this->AddColumn('memId', ' Mem Id', null, null, 'MJaxTextBox');
        $this->AddColumn('creDate', ' Cre Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('level', ' Level', null, null, 'MJaxTextBox');
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
        $this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Athelete/' . $strActionParameter);
    }
}
?>