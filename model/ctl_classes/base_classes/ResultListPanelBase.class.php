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
* - ResultListPanelBase extends MJaxTable
*/
class ResultListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrResults = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrResults);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objResult = Result::LoadById($strActionParameter);
        if (!is_null($objResult)) {
            $objResult->markDeleted();
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
        //$this->AddColumn('idResult','idResult');
        $this->AddColumn('idSession', ' Id Session', null, null, 'MJaxTextBox');
        $this->AddColumn('idAthelete', ' Id Athelete', null, null, 'MJaxTextBox');
        $this->AddColumn('score', ' Score', null, null, 'MJaxTextBox');
        $this->AddColumn('judge', ' Judge', null, null, 'MJaxTextBox');
        $this->AddColumn('flag', ' Flag', null, null, 'MJaxTextBox');
        $this->AddColumn('creDate', ' Cre Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('event', ' Event', null, null, 'MJaxTextBox');
        $this->AddColumn('dispDate', ' Disp Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
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
        $this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Result/' . $strActionParameter);
    }
}
?>