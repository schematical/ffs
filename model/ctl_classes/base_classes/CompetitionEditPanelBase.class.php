<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetCompetition()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - IsNew()
* Classes list:
* - CompetitionEditPanelBase extends MJaxPanel
*/
class CompetitionEditPanelBase extends MJaxPanel {
    protected $objCompetition = null;
    public $intIdCompetition = null;
    public $strName = null;
    public $strLongDesc = null;
    public $dttCreDate = null;
    public $dttStartDate = null;
    public $dttEndDate = null;
    public $intIdOrg = null;
    public $strNamespace = null;
    public $lnkViewParentIdOrg = null;
    public $lnkViewChildSession = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objCompetition = null) {
        parent::__construct($objParentControl);
        $this->objCompetition = $objCompetition;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/CompetitionEditPanelBase.tpl.php';
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
        if (is_null($this->objCompetition)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strName = new MJaxTextBox($this);
        $this->strName->Name = 'name';
        $this->strName->AddCssClass('input-large');
        //varchar(128)
        $this->strLongDesc = new MJaxTextBox($this);
        $this->strLongDesc->Name = 'longDesc';
        $this->strLongDesc->AddCssClass('input-large');
        //longtext
        $this->strLongDesc->TextMode = MJaxTextMode::MultiLine;
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $this->dttStartDate = new MJaxBSDateTimePicker($this);
        //Is special field!!!!!
        $this->dttEndDate = new MJaxBSDateTimePicker($this);
        $this->strNamespace = new MJaxTextBox($this);
        $this->strNamespace->Name = 'namespace';
        $this->strNamespace->AddCssClass('input-large');
        //varchar(45)
        if (!is_null($this->objCompetition)) {
            $this->SetCompetition($this->objCompetition);
        }
    }
    public function SetCompetition($objCompetition) {
        $this->objCompetition = $objCompetition;
        $this->ActionParameter = $this->objCompetition;
        $this->blnModified = true;
        if (!is_null($this->objCompetition)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdCompetition = $this->objCompetition->idCompetition;
            $this->strName->Text = $this->objCompetition->name;
            $this->strLongDesc->Text = $this->objCompetition->longDesc;
            //Is special field!!!!!
            //Do nothing this is a creDate
            //Is special field!!!!!
            $this->dttStartDate->Value = $this->objCompetition->startDate;
            //Is special field!!!!!
            $this->dttEndDate->Value = $this->objCompetition->endDate;
            $this->strNamespace->Text = $this->objCompetition->namespace;
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objCompetition)) {
            if (!is_null($this->objCompetition->idOrg)) {
                $this->lnkViewParentIdOrg = new MJaxLinkButton($this);
                $this->lnkViewParentIdOrg->Text = 'View Org';
                $this->lnkViewParentIdOrg->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objCompetition->idOrg;
            }
        }
        $this->lnkViewChildSession = new MJaxLinkButton($this);
        $this->lnkViewChildSession->Text = 'View Sessions';
        //I should really fix this
        //$this->lnkViewChildSession->Href = __ENTITY_MODEL_DIR__ . '/Competition/' . $this->objCompetition->idCompetition . '/Sessions';
        
    }
    public function btnSave_click() {
        if (is_null($this->objCompetition)) {
            //Create a new one
            $this->objCompetition = new Competition();
        }
        $this->objCompetition->name = $this->strName->Text;
        $this->objCompetition->longDesc = $this->strLongDesc->Text;
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $this->objCompetition->startDate = $this->dttStartDate->GetValue();
        //Is special field!!!!!
        $this->objCompetition->endDate = $this->dttEndDate->GetValue();
        $this->objCompetition->namespace = $this->strNamespace->Text;
        $this->objCompetition->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objCompetition;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->objCompetition->MarkDeleted();
        $this->SetCompetition(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objCompetition);
    }
}
?>