<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetSession()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* Classes list:
* - SessionEditPanelBase extends MJaxPanel
*/
class SessionEditPanelBase extends MJaxPanel {
    protected $objSession = null;
    public $intIdSession = null;
    public $dttStartDate = null;
    public $dttEndDate = null;
    public $intIdCompetition = null;
    public $strName = null;
    public $strNotes = null;
    public $strData = null;
    public $strEquipmentSet = null;
    public $strEventData = null;
    public $lnkViewParentIdCompetition = null;
    public $lnkViewChildAssignment = null;
    public $lnkViewChildEnrollment = null;
    public $lnkViewChildResult = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objSession = null) {
        parent::__construct($objParentControl);
        $this->objSession = $objSession;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/SessionEditPanelBase.tpl.php';
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
        if (is_null($this->objSession)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        //Is special field!!!!!
        $this->dttStartDate = new MJaxBSDateTimePicker($this);
        //Is special field!!!!!
        $this->dttEndDate = new MJaxBSDateTimePicker($this);
        $this->strName = new MJaxTextBox($this);
        $this->strName->Name = 'name';
        $this->strName->AddCssClass('input-large');
        //varchar(64)
        $this->strNotes = new MJaxTextBox($this);
        $this->strNotes->Name = 'notes';
        $this->strNotes->AddCssClass('input-large');
        //longtext
        $this->strNotes->TextMode = MJaxTextMode::MultiLine;
        //Is special field!!!!!
        $this->strEquipmentSet = new MJaxTextBox($this);
        $this->strEquipmentSet->Name = 'equipmentSet';
        $this->strEquipmentSet->AddCssClass('input-large');
        //varchar(45)
        //Is special field!!!!!
        if (!is_null($this->objSession)) {
            $this->SetSession($this->objSession);
        }
    }
    public function SetSession($objSession) {
        $this->objSession = $objSession;
        $this->ActionParameter = $this->objSession;
        $this->blnModified = true;
        if (!is_null($this->objSession)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdSession = $this->objSession->idSession;
            //Is special field!!!!!
            $this->dttStartDate->Value = $this->objSession->startDate;
            //Is special field!!!!!
            $this->dttEndDate->Value = $this->objSession->endDate;
            $this->strName->Text = $this->objSession->name;
            $this->strNotes->Text = $this->objSession->notes;
            //Is special field!!!!!
            $this->strEquipmentSet->Text = $this->objSession->equipmentSet;
            //Is special field!!!!!
            
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objSession)) {
            if (!is_null($this->objSession->idCompetition)) {
                $this->lnkViewParentIdCompetition = new MJaxLinkButton($this);
                $this->lnkViewParentIdCompetition->Text = 'View Competition';
                $this->lnkViewParentIdCompetition->Href = __ENTITY_MODEL_DIR__ . '/Competition/' . $this->objSession->idCompetition;
            }
        }
        $this->lnkViewChildAssignment = new MJaxLinkButton($this);
        $this->lnkViewChildAssignment->Text = 'View Assignments';
        //I should really fix this
        //$this->lnkViewChildAssignment->Href = __ENTITY_MODEL_DIR__ . '/Session/' . $this->objSession->idSession . '/Assignments';
        $this->lnkViewChildEnrollment = new MJaxLinkButton($this);
        $this->lnkViewChildEnrollment->Text = 'View Enrollments';
        //I should really fix this
        //$this->lnkViewChildEnrollment->Href = __ENTITY_MODEL_DIR__ . '/Session/' . $this->objSession->idSession . '/Enrollments';
        $this->lnkViewChildResult = new MJaxLinkButton($this);
        $this->lnkViewChildResult->Text = 'View Results';
        //I should really fix this
        //$this->lnkViewChildResult->Href = __ENTITY_MODEL_DIR__ . '/Session/' . $this->objSession->idSession . '/Results';
        
    }
    public function btnSave_click() {
        if (is_null($this->objSession)) {
            //Create a new one
            $this->objSession = new Session();
        }
        //Is special field!!!!!
        $this->objSession->startDate = $this->dttStartDate->GetValue();
        //Is special field!!!!!
        $this->objSession->endDate = $this->dttEndDate->GetValue();
        $this->objSession->name = $this->strName->Text;
        $this->objSession->notes = $this->strNotes->Text;
        //Is special field!!!!!
        $this->objSession->equipmentSet = $this->strEquipmentSet->Text;
        //Is special field!!!!!
        $this->objSession->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objSession;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objSession->MarkDeleted();
        $this->SetSession(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objSession);
    }
}
?>