<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - txtSearch_change()
* - GetExtQuery()
* - GetValue()
* - __get()
* - __set()
* Classes list:
* - MLCBatchSelectPanelBase extends MJaxPanel
*/
class MLCBatchSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedMLCBatchs = array();
    public $txtSearch = null;
    //public $tblMLCBatchs = null;
    public $intIdBatch = null;
    public $strJobName = null;
    public $strReport = null;
    public $intIdBatchStatus = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this);
        $this->txtSearch->Url = '/data/search?mjax-route-ext=MLCBatch';
        $this->txtSearch->Name = 'idMLCBatch';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdBatch = new MJaxTextBox($this);
        $this->intIdBatch->Attr('placeholder', " Batch");
        $this->strJobName = new MJaxTextBox($this);
        $this->strJobName->Attr('placeholder', " Job Name");
        $this->strReport = new MJaxTextBox($this);
        $this->strReport->Attr('placeholder', " Report");
        $this->intIdBatchStatus = new MJaxTextBox($this);
        $this->intIdBatchStatus->Attr('placeholder', " Batch Status");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedMLCBatchs = array();
            return;
        }
        try {
            if (class_exists($arrParts[0])) {
                $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
            }
        }
        catch(Exception $e) {
            error_log($e->getMessage());
        }
        $arrMLCBatchs = array();
        if (is_null($objEntity)) {
            return $arrMLCBatchs;
        }
        switch (get_class($objEntity)) {
            case ('MLCBatch'):
                $arrMLCBatchs = array(
                    $objEntity
                );
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedMLCBatchs = $arrMLCBatchs;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (!is_null($this->strJobName->GetValue())) {
            $arrAndConditions[] = sprintf('jobName LIKE "%s%%"', $this->strJobName->GetValue());
        }
        if (!is_null($this->strReport->GetValue())) {
            $arrAndConditions[] = sprintf('report LIKE "%s%%"', $this->strReport->GetValue());
        }
        if (!is_null($this->intIdBatchStatus->GetValue())) {
            $arrAndConditions[] = sprintf('idBatchStatus LIKE "%s%%"', $this->intIdBatchStatus->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedMLCBatchs;
    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "DisplayAdvOptions":
                return $this->blnDisplayAdvOptions;
            default:
                return parent::__get($strName);
                //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
                
        }
    }
    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue) {
        switch ($strName) {
            case "DisplayAdvOptions":
                return $this->blnDisplayAdvOptions = $mixValue;
            default:
                return parent::__set($strName, $mixValue);
                //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
                
        }
    }
}
