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
* - CompetitionListPanelBase extends MJaxTable
*/
class CompetitionListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrCompetitions = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrCompetitions);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objCompetition = Competition::LoadById($strActionParameter);
        if (!is_null($objCompetition)) {
            $objCompetition->markDeleted();
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
        //$this->AddColumn('idCompetition','idCompetition');
        $this->AddColumn('name', ' Name', null, null, 'MJaxTextBox');
        $this->AddColumn('longDesc', ' Long Desc', null, null, 'MJaxTextArea');
        $this->AddColumn('creDate', ' Cre Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('startDate', ' Start Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('endDate', ' End Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('idOrg', ' Id Org', null, null, 'MJaxTextBox');
        $this->AddColumn('namespace', ' Namespace', null, null, 'MJaxTextBox');
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
        $this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Competition/' . $strActionParameter);
    }
}
?>