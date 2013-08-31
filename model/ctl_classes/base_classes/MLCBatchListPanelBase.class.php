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
* Classes list:
* - MLCBatchListPanelBase extends MJaxTable
*/
class MLCBatchListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrMLCBatchs = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrMLCBatchs);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objMLCBatch = MLCBatch::LoadById($strActionParameter);
        if (!is_null($objMLCBatch)) {
            $objMLCBatch->markDeleted();
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
        //$this->AddColumn('idBatch','idBatch');
        $this->AddColumn('jobName', ' Job Name', null, null, 'MJaxTextBox');
        $this->AddColumn('report', ' Report', null, null, 'MJaxTextArea');
        $this->AddColumn('idBatchStatus', ' Batch Status', null, null, 'MJaxTextBox');
    }
}
?>