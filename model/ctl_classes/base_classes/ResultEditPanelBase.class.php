<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetResult()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - IsNew()
* Classes list:
* - ResultEditPanelBase extends MJaxPanel
*/
class ResultEditPanelBase extends MJaxPanel {
    protected $objResult = null;
    public $intIdResult = null;
    public $intIdSession = null;
    public $intIdAthelete = null;
    public $strScore = null;
    public $strJudge = null;
    public $intFlag = null;
    public $dttCreDate = null;
    public $strEvent = null;
    public $dttDispDate = null;
    public $lnkViewParentIdSession = null;
    public $lnkViewParentIdAthelete = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objResult = null) {
        parent::__construct($objParentControl);
        $this->objResult = $objResult;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/ResultEditPanelBase.tpl.php';
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
        if (is_null($this->objResult)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strScore = new MJaxTextBox($this);
        $this->strScore->Name = 'score';
        $this->strScore->AddCssClass('input-large');
        //varchar(64)
        $this->strJudge = new MJaxTextBox($this);
        $this->strJudge->Name = 'judge';
        $this->strJudge->AddCssClass('input-large');
        //varchar(64)
        $this->intFlag = new MJaxTextBox($this);
        $this->intFlag->Name = 'flag';
        $this->intFlag->AddCssClass('input-large');
        //tinyint(1)
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->strEvent = new MJaxTextBox($this);
        $this->strEvent->Name = 'event';
        $this->strEvent->AddCssClass('input-large');
        //varchar(64)
        //Is special field!!!!!
        $this->dttDispDate = new MJaxBSDateTimePicker($this);
        if (!is_null($this->objResult)) {
            $this->SetResult($this->objResult);
        }
    }
    public function SetResult($objResult) {
        $this->objResult = $objResult;
        $this->ActionParameter = $this->objResult;
        $this->blnModified = true;
        if (!is_null($this->objResult)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdResult = $this->objResult->idResult;
            $this->strScore->Text = $this->objResult->score;
            $this->strJudge->Text = $this->objResult->judge;
            $this->intFlag->Text = $this->objResult->flag;
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strEvent->Text = $this->objResult->event;
            //Is special field!!!!!
            $this->dttDispDate->Value = $this->objResult->dispDate;
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objResult)) {
            if (!is_null($this->objResult->idSession)) {
                $this->lnkViewParentIdSession = new MJaxLinkButton($this);
                $this->lnkViewParentIdSession->Text = 'View Session';
                $this->lnkViewParentIdSession->Href = __ENTITY_MODEL_DIR__ . '/Session/' . $this->objResult->idSession;
            }
            if (!is_null($this->objResult->idAthelete)) {
                $this->lnkViewParentIdAthelete = new MJaxLinkButton($this);
                $this->lnkViewParentIdAthelete->Text = 'View Athelete';
                $this->lnkViewParentIdAthelete->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objResult->idAthelete;
            }
        }
    }
    public function btnSave_click() {
        if (is_null($this->objResult)) {
            //Create a new one
            $this->objResult = new Result();
        }
        $this->objResult->score = $this->strScore->Text;
        $this->objResult->judge = $this->strJudge->Text;
        $this->objResult->flag = $this->intFlag->Text;
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->objResult->event = $this->strEvent->Text;
        //Is special field!!!!!
        $this->objResult->dispDate = $this->dttDispDate->GetValue();
        $this->objResult->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objResult;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->objResult->MarkDeleted();
        $this->SetResult(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objResult);
    }
}
?>