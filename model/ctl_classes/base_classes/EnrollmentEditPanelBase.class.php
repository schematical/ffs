<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetEnrollment()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - IsNew()
* Classes list:
* - EnrollmentEditPanelBase extends MJaxPanel
*/
class EnrollmentEditPanelBase extends MJaxPanel {
    protected $objEnrollment = null;
    public $intIdEnrollment = null;
    public $intIdAthelete = null;
    public $intIdCompetition = null;
    public $intIdSession = null;
    public $strFlight = null;
    public $strDivision = null;
    public $strAgeGroup = null;
    public $strMisc1 = null;
    public $strMisc2 = null;
    public $strMisc3 = null;
    public $strMisc4 = null;
    public $strMisc5 = null;
    public $dttCreDate = null;
    public $strLevel = null;
    public $lnkViewParentIdAthelete = null;
    public $lnkViewParentIdCompetition = null;
    public $lnkViewParentIdSession = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objEnrollment = null) {
        parent::__construct($objParentControl);
        $this->objEnrollment = $objEnrollment;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/EnrollmentEditPanelBase.tpl.php';
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
        if (is_null($this->objEnrollment)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strFlight = new MJaxTextBox($this);
        $this->strFlight->Name = 'flight';
        $this->strFlight->AddCssClass('input-large');
        //varchar(64)
        $this->strDivision = new MJaxTextBox($this);
        $this->strDivision->Name = 'division';
        $this->strDivision->AddCssClass('input-large');
        //varchar(64)
        $this->strAgeGroup = new MJaxTextBox($this);
        $this->strAgeGroup->Name = 'ageGroup';
        $this->strAgeGroup->AddCssClass('input-large');
        //varchar(64)
        $this->strMisc1 = new MJaxTextBox($this);
        $this->strMisc1->Name = 'misc1';
        $this->strMisc1->AddCssClass('input-large');
        //varchar(64)
        $this->strMisc2 = new MJaxTextBox($this);
        $this->strMisc2->Name = 'misc2';
        $this->strMisc2->AddCssClass('input-large');
        //varchar(64)
        $this->strMisc3 = new MJaxTextBox($this);
        $this->strMisc3->Name = 'misc3';
        $this->strMisc3->AddCssClass('input-large');
        //varchar(64)
        $this->strMisc4 = new MJaxTextBox($this);
        $this->strMisc4->Name = 'misc4';
        $this->strMisc4->AddCssClass('input-large');
        //varchar(64)
        $this->strMisc5 = new MJaxTextBox($this);
        $this->strMisc5->Name = 'misc5';
        $this->strMisc5->AddCssClass('input-large');
        //varchar(64)
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->strLevel = new MJaxTextBox($this);
        $this->strLevel->Name = 'level';
        $this->strLevel->AddCssClass('input-large');
        //varchar(45)
        if (!is_null($this->objEnrollment)) {
            $this->SetEnrollment($this->objEnrollment);
        }
    }
    public function SetEnrollment($objEnrollment) {
        $this->objEnrollment = $objEnrollment;
        $this->blnModified = true;
        if (!is_null($this->objEnrollment)) {
            $this->btnDelete->Style->Display = 'inline';
            //PKey
            $this->intIdEnrollment = $this->objEnrollment->idEnrollment;
            $this->strFlight->Text = $this->objEnrollment->flight;
            $this->strDivision->Text = $this->objEnrollment->division;
            $this->strAgeGroup->Text = $this->objEnrollment->ageGroup;
            $this->strMisc1->Text = $this->objEnrollment->misc1;
            $this->strMisc2->Text = $this->objEnrollment->misc2;
            $this->strMisc3->Text = $this->objEnrollment->misc3;
            $this->strMisc4->Text = $this->objEnrollment->misc4;
            $this->strMisc5->Text = $this->objEnrollment->misc5;
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strLevel->Text = $this->objEnrollment->level;
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objEnrollment)) {
            if (!is_null($this->objEnrollment->idAthelete)) {
                $this->lnkViewParentIdAthelete = new MJaxLinkButton($this);
                $this->lnkViewParentIdAthelete->Text = 'View Athelete';
                $this->lnkViewParentIdAthelete->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objEnrollment->idAthelete;
            }
            if (!is_null($this->objEnrollment->idCompetition)) {
                $this->lnkViewParentIdCompetition = new MJaxLinkButton($this);
                $this->lnkViewParentIdCompetition->Text = 'View Competition';
                $this->lnkViewParentIdCompetition->Href = __ENTITY_MODEL_DIR__ . '/Competition/' . $this->objEnrollment->idCompetition;
            }
            if (!is_null($this->objEnrollment->idSession)) {
                $this->lnkViewParentIdSession = new MJaxLinkButton($this);
                $this->lnkViewParentIdSession->Text = 'View Session';
                $this->lnkViewParentIdSession->Href = __ENTITY_MODEL_DIR__ . '/Session/' . $this->objEnrollment->idSession;
            }
        }
    }
    public function btnSave_click() {
        if (is_null($this->objEnrollment)) {
            //Create a new one
            $this->objEnrollment = new Enrollment();
        }
        $this->objEnrollment->flight = $this->strFlight->Text;
        $this->objEnrollment->division = $this->strDivision->Text;
        $this->objEnrollment->ageGroup = $this->strAgeGroup->Text;
        $this->objEnrollment->misc1 = $this->strMisc1->Text;
        $this->objEnrollment->misc2 = $this->strMisc2->Text;
        $this->objEnrollment->misc3 = $this->strMisc3->Text;
        $this->objEnrollment->misc4 = $this->strMisc4->Text;
        $this->objEnrollment->misc5 = $this->strMisc5->Text;
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->objEnrollment->level = $this->strLevel->Text;
        $this->objEnrollment->Save();
    }
    public function btnDelete_click() {
        $this->objEnrollment->MarkDeleted();
        $this->SetEnrollment(null);
    }
    public function IsNew() {
        return is_null($this->objEnrollment);
    }
}
?>