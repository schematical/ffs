<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - GetMLCBatch()
* - SetMLCBatch()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* - InitJobNameAutocomplete()
* Classes list:
* - MLCBatchEditPanelBase extends MJaxPanel
*/
class MLCBatchEditPanelBase extends MJaxPanel {
    protected $objMLCBatch = null;
    public $intIdBatch = null;
    public $dttCreDate = null;
    public $strJobName = null;
    public $strReport = null;
    public $intIdBatchStatus = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objMLCBatch = null) {
        parent::__construct($objParentControl);
        $this->objMLCBatch = $objMLCBatch;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/MLCBatchEditPanelBase.tpl.php';
        $this->CreateFieldControls();
        $this->CreateContentControls();
        $this->CreateReferenceControls();
    }
    public function CreateContentControls() {
        $this->btnSave = new MJaxButton($this);
        $this->btnSave->Text = 'Save';
        $this->btnSave->AddAction(new MJaxClickEvent() , new MJaxServerControlAction($this, 'btnSave_click'));
        $this->btnSave->AddCssClass('btn btn-large');
        $this->btnDelete = new MJaxButton($this);
        $this->btnDelete->Text = 'Delete';
        $this->btnDelete->AddAction(new MJaxClickEvent() , new MJaxServerControlAction($this, 'btnDelete_click'));
        $this->btnDelete->AddCssClass('btn btn-large');
        if (is_null($this->objMLCBatch)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->strJobName = new MJaxTextBox($this);
        $this->strJobName->Name = 'jobName';
        $this->strJobName->AddCssClass('input-large');
        //varchar(64)
        $this->strReport = new MJaxTextBox($this);
        $this->strReport->Name = 'report';
        $this->strReport->AddCssClass('input-large');
        //longtext
        $this->strReport->TextMode = MJaxTextMode::MultiLine;
        $this->intIdBatchStatus = new MJaxTextBox($this);
        $this->intIdBatchStatus->Name = 'idBatchStatus';
        $this->intIdBatchStatus->AddCssClass('input-large');
        //int(11)
        if (!is_null($this->objMLCBatch)) {
            $this->SetMLCBatch($this->objMLCBatch);
        }
    }
    public function GetMLCBatch() {
        if (is_null($this->objMLCBatch)) {
            //Create a new one
            $this->objMLCBatch = new MLCBatch();
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (get_class($this->strJobName) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strJobName->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('jobName');
            }
            $this->objMLCBatch->jobName = $mixEntity;
        } else {
            $this->objMLCBatch->jobName = $this->strJobName->Text;
        }
        if (get_class($this->strReport) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strReport->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('report');
            }
            $this->objMLCBatch->report = $mixEntity;
        } else {
            $this->objMLCBatch->report = $this->strReport->Text;
        }
        if (get_class($this->intIdBatchStatus) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intIdBatchStatus->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('idBatchStatus');
            }
            $this->objMLCBatch->idBatchStatus = $mixEntity;
        } else {
            $this->objMLCBatch->idBatchStatus = $this->intIdBatchStatus->Text;
        }
        return $this->objMLCBatch;
    }
    public function SetMLCBatch($objMLCBatch) {
        $this->objMLCBatch = $objMLCBatch;
        $this->ActionParameter = $this->objMLCBatch;
        $this->blnModified = true;
        if (!is_null($this->objMLCBatch)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdBatch = $this->objMLCBatch->idBatch;
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strJobName->Text = $this->objMLCBatch->jobName;
            $this->strReport->Text = $this->objMLCBatch->report;
            $this->intIdBatchStatus->Text = $this->objMLCBatch->idBatchStatus;
        } else {
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strJobName->Text = '';
            $this->strReport->Text = '';
            $this->intIdBatchStatus->Text = '';
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objMLCBatch)) {
        }
    }
    public function btnSave_click() {
        $this->GetMLCBatch()->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objMLCBatch;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objMLCBatch->MarkDeleted();
        $this->SetMLCBatch(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objMLCBatch);
    }
    public function InitJobNameAutocomplete() {
        $this->strJobName = new MJaxBSAutocompleteTextBox($this);
        $this->strJobName->SetSearchEntity('mlcbatch', 'jobName');
        $this->strJobName->Name = 'jobName';
        $this->strJobName->AddCssClass('input-large');
    }
}
?>