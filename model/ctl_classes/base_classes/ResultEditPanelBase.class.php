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
* - btnDelete_confirm()
* - IsNew()
* - InitIdSessionAutocomplete()
* - InitIdAtheleteAutocomplete()
* - InitScoreAutocomplete()
* - InitJudgeAutocomplete()
* - InitEventAutocomplete()
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
            $this->strScore->Text = '';
            $this->strJudge->Text = '';
            $this->intFlag->Text = '';
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strEvent->Text = '';
            //Is special field!!!!!
            $this->dttDispDate->Value = MLCDateTime::Now();
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objResult)) {
            if (!is_null($this->objResult->idSession)) {
                $this->lnkViewParentIdSession = new MJaxLinkButton($this);
                $this->lnkViewParentIdSession->Text = 'View Session';
                $this->lnkViewParentIdSession->Href = '/data/editResult?' . FFSQS::Result_IdSession . $this->objResult->idSession;
            }
            if (!is_null($this->objResult->idAthelete)) {
                $this->lnkViewParentIdAthelete = new MJaxLinkButton($this);
                $this->lnkViewParentIdAthelete->Text = 'View Athelete';
                $this->lnkViewParentIdAthelete->Href = '/data/editResult?' . FFSQS::Result_IdAthelete . $this->objResult->idAthelete;
            }
        }
    }
    public function btnSave_click() {
        if (is_null($this->objResult)) {
            //Create a new one
            $this->objResult = new Result();
        }
        if (get_class($this->strScore) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strScore->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('score');
            }
            $this->objResult->score = $mixEntity;
        } else {
            $this->objResult->score = $this->strScore->Text;
        }
        if (get_class($this->strJudge) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strJudge->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('judge');
            }
            $this->objResult->judge = $mixEntity;
        } else {
            $this->objResult->judge = $this->strJudge->Text;
        }
        if (get_class($this->intFlag) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intFlag->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('flag');
            }
            $this->objResult->flag = $mixEntity;
        } else {
            $this->objResult->flag = $this->intFlag->Text;
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (get_class($this->strEvent) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strEvent->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('event');
            }
            $this->objResult->event = $mixEntity;
        } else {
            $this->objResult->event = $this->strEvent->Text;
        }
        //Is special field!!!!!
        $this->objResult->dispDate = $this->dttDispDate->GetValue();
        $this->objResult->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objResult;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objResult->MarkDeleted();
        $this->SetResult(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objResult);
    }
    public function InitIdSessionAutocomplete() {
        $this->intIdSession = new MJaxBSAutocompleteTextBox($this);
        $this->intIdSession->SetSearchEntity('session');
        $this->intIdSession->Name = 'idSession';
        $this->intIdSession->AddCssClass('input-large');
    }
    public function InitIdAtheleteAutocomplete() {
        $this->intIdAthelete = new MJaxBSAutocompleteTextBox($this);
        $this->intIdAthelete->SetSearchEntity('athelete');
        $this->intIdAthelete->Name = 'idAthelete';
        $this->intIdAthelete->AddCssClass('input-large');
    }
    public function InitScoreAutocomplete() {
        $this->strScore = new MJaxBSAutocompleteTextBox($this);
        $this->strScore->SetSearchEntity('result', 'score');
        $this->strScore->Name = 'score';
        $this->strScore->AddCssClass('input-large');
    }
    public function InitJudgeAutocomplete() {
        $this->strJudge = new MJaxBSAutocompleteTextBox($this);
        $this->strJudge->SetSearchEntity('result', 'judge');
        $this->strJudge->Name = 'judge';
        $this->strJudge->AddCssClass('input-large');
    }
    public function InitEventAutocomplete() {
        $this->strEvent = new MJaxBSAutocompleteTextBox($this);
        $this->strEvent->SetSearchEntity('result', 'event');
        $this->strEvent->Name = 'event';
        $this->strEvent->AddCssClass('input-large');
    }
}
?>