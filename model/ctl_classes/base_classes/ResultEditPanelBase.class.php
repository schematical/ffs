<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - GetResult()
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
* - InitNSStartValueAutocomplete()
* - InitIdCompetitionAutocomplete()
* - InitNSSpecialNotesAutocomplete()
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
    public $intSanctioned = null;
    public $strNotes = null;
    public $strNSStartValue = null;
    public $strData = null;
    public $intIdCompetition = null;
    public $strNSSpecialNotes = null;
    public $intNSTied = null;
    public $intNSPlace = null;
    public $intIdInputUser = null;
    public $lnkViewParentIdSession = null;
    public $lnkViewParentIdAthelete = null;
    public $lnkViewParentIdCompetition = null;
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
        $this->intSanctioned = new MJaxTextBox($this);
        $this->intSanctioned->Name = 'sanctioned';
        $this->intSanctioned->AddCssClass('input-large');
        //tinyint(4)
        $this->strNotes = new MJaxTextBox($this);
        $this->strNotes->Name = 'notes';
        $this->strNotes->AddCssClass('input-large');
        //longtext
        $this->strNotes->TextMode = MJaxTextMode::MultiLine;
        $this->strNSStartValue = new MJaxTextBox($this);
        $this->strNSStartValue->Name = 'NSStartValue';
        $this->strNSStartValue->AddCssClass('input-large');
        //varchar(64)
        //Is special field!!!!!
        $this->strNSSpecialNotes = new MJaxTextBox($this);
        $this->strNSSpecialNotes->Name = 'NSSpecialNotes';
        $this->strNSSpecialNotes->AddCssClass('input-large');
        //varchar(64)
        $this->intNSTied = new MJaxTextBox($this);
        $this->intNSTied->Name = 'NSTied';
        $this->intNSTied->AddCssClass('input-large');
        //tinyint(4)
        $this->intNSPlace = new MJaxTextBox($this);
        $this->intNSPlace->Name = 'NSPlace';
        $this->intNSPlace->AddCssClass('input-large');
        //int(4)
        $this->intIdInputUser = new MJaxTextBox($this);
        $this->intIdInputUser->Name = 'idInputUser';
        $this->intIdInputUser->AddCssClass('input-large');
        //int(11)
        if (!is_null($this->objResult)) {
            $this->SetResult($this->objResult);
        }
    }
    public function GetResult() {
        return $this->objResult;
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
            $this->intSanctioned->Text = $this->objResult->sanctioned;
            $this->strNotes->Text = $this->objResult->notes;
            $this->strNSStartValue->Text = $this->objResult->NSStartValue;
            //Is special field!!!!!
            $this->strNSSpecialNotes->Text = $this->objResult->NSSpecialNotes;
            $this->intNSTied->Text = $this->objResult->NSTied;
            $this->intNSPlace->Text = $this->objResult->NSPlace;
            $this->intIdInputUser->Text = $this->objResult->idInputUser;
        } else {
            $this->strScore->Text = '';
            $this->strJudge->Text = '';
            $this->intFlag->Text = '';
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strEvent->Text = '';
            //Is special field!!!!!
            $this->dttDispDate->Value = MLCDateTime::Now();
            $this->intSanctioned->Text = '';
            $this->strNotes->Text = '';
            $this->strNSStartValue->Text = '';
            //Is special field!!!!!
            $this->strNSSpecialNotes->Text = '';
            $this->intNSTied->Text = '';
            $this->intNSPlace->Text = '';
            $this->intIdInputUser->Text = '';
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
            if (!is_null($this->objResult->idCompetition)) {
                $this->lnkViewParentIdCompetition = new MJaxLinkButton($this);
                $this->lnkViewParentIdCompetition->Text = 'View Competition';
                $this->lnkViewParentIdCompetition->Href = '/data/editResult?' . FFSQS::Result_IdCompetition . $this->objResult->idCompetition;
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
        if (get_class($this->intSanctioned) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intSanctioned->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('sanctioned');
            }
            $this->objResult->sanctioned = $mixEntity;
        } else {
            $this->objResult->sanctioned = $this->intSanctioned->Text;
        }
        if (get_class($this->strNotes) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strNotes->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('notes');
            }
            $this->objResult->notes = $mixEntity;
        } else {
            $this->objResult->notes = $this->strNotes->Text;
        }
        if (get_class($this->strNSStartValue) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strNSStartValue->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('NSStartValue');
            }
            $this->objResult->NSStartValue = $mixEntity;
        } else {
            $this->objResult->NSStartValue = $this->strNSStartValue->Text;
        }
        //Is special field!!!!!
        if (get_class($this->strNSSpecialNotes) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strNSSpecialNotes->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('NSSpecialNotes');
            }
            $this->objResult->NSSpecialNotes = $mixEntity;
        } else {
            $this->objResult->NSSpecialNotes = $this->strNSSpecialNotes->Text;
        }
        if (get_class($this->intNSTied) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intNSTied->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('NSTied');
            }
            $this->objResult->NSTied = $mixEntity;
        } else {
            $this->objResult->NSTied = $this->intNSTied->Text;
        }
        if (get_class($this->intNSPlace) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intNSPlace->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('NSPlace');
            }
            $this->objResult->NSPlace = $mixEntity;
        } else {
            $this->objResult->NSPlace = $this->intNSPlace->Text;
        }
        if (get_class($this->intIdInputUser) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intIdInputUser->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('idInputUser');
            }
            $this->objResult->idInputUser = $mixEntity;
        } else {
            $this->objResult->idInputUser = $this->intIdInputUser->Text;
        }
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
    public function InitNSStartValueAutocomplete() {
        $this->strNSStartValue = new MJaxBSAutocompleteTextBox($this);
        $this->strNSStartValue->SetSearchEntity('result', 'NSStartValue');
        $this->strNSStartValue->Name = 'NSStartValue';
        $this->strNSStartValue->AddCssClass('input-large');
    }
    public function InitIdCompetitionAutocomplete() {
        $this->intIdCompetition = new MJaxBSAutocompleteTextBox($this);
        $this->intIdCompetition->SetSearchEntity('competition');
        $this->intIdCompetition->Name = 'idCompetition';
        $this->intIdCompetition->AddCssClass('input-large');
    }
    public function InitNSSpecialNotesAutocomplete() {
        $this->strNSSpecialNotes = new MJaxBSAutocompleteTextBox($this);
        $this->strNSSpecialNotes->SetSearchEntity('result', 'NSSpecialNotes');
        $this->strNSSpecialNotes->Name = 'NSSpecialNotes';
        $this->strNSSpecialNotes->AddCssClass('input-large');
    }
}
?>