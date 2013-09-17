<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - GetEnrollment()
* - SetEnrollment()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* - InitIdAtheleteAutocomplete()
* - InitIdCompetitionAutocomplete()
* - InitIdSessionAutocomplete()
* - InitFlightAutocomplete()
* - InitDivisionAutocomplete()
* - InitAgeGroupAutocomplete()
* - InitMisc1Autocomplete()
* - InitMisc2Autocomplete()
* - InitMisc3Autocomplete()
* - InitMisc4Autocomplete()
* - InitMisc5Autocomplete()
* - InitLevelAutocomplete()
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
    public function GetEnrollment() {
        return $this->objEnrollment;
    }
    public function SetEnrollment($objEnrollment) {
        $this->objEnrollment = $objEnrollment;
        $this->ActionParameter = $this->objEnrollment;
        $this->blnModified = true;
        if (!is_null($this->objEnrollment)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
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
            $this->strFlight->Text = '';
            $this->strDivision->Text = '';
            $this->strAgeGroup->Text = '';
            $this->strMisc1->Text = '';
            $this->strMisc2->Text = '';
            $this->strMisc3->Text = '';
            $this->strMisc4->Text = '';
            $this->strMisc5->Text = '';
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strLevel->Text = '';
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objEnrollment)) {
            if (!is_null($this->objEnrollment->idAthelete)) {
                $this->lnkViewParentIdAthelete = new MJaxLinkButton($this);
                $this->lnkViewParentIdAthelete->Text = 'View Athelete';
                $this->lnkViewParentIdAthelete->Href = '/data/editEnrollment?' . FFSQS::Enrollment_IdAthelete . $this->objEnrollment->idAthelete;
            }
            if (!is_null($this->objEnrollment->idCompetition)) {
                $this->lnkViewParentIdCompetition = new MJaxLinkButton($this);
                $this->lnkViewParentIdCompetition->Text = 'View Competition';
                $this->lnkViewParentIdCompetition->Href = '/data/editEnrollment?' . FFSQS::Enrollment_IdCompetition . $this->objEnrollment->idCompetition;
            }
            if (!is_null($this->objEnrollment->idSession)) {
                $this->lnkViewParentIdSession = new MJaxLinkButton($this);
                $this->lnkViewParentIdSession->Text = 'View Session';
                $this->lnkViewParentIdSession->Href = '/data/editEnrollment?' . FFSQS::Enrollment_IdSession . $this->objEnrollment->idSession;
            }
        }
    }
    public function btnSave_click() {
        if (is_null($this->objEnrollment)) {
            //Create a new one
            $this->objEnrollment = new Enrollment();
        }
        if (get_class($this->strFlight) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strFlight->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('flight');
            }
            $this->objEnrollment->flight = $mixEntity;
        } else {
            $this->objEnrollment->flight = $this->strFlight->Text;
        }
        if (get_class($this->strDivision) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strDivision->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('division');
            }
            $this->objEnrollment->division = $mixEntity;
        } else {
            $this->objEnrollment->division = $this->strDivision->Text;
        }
        if (get_class($this->strAgeGroup) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strAgeGroup->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('ageGroup');
            }
            $this->objEnrollment->ageGroup = $mixEntity;
        } else {
            $this->objEnrollment->ageGroup = $this->strAgeGroup->Text;
        }
        if (get_class($this->strMisc1) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strMisc1->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('misc1');
            }
            $this->objEnrollment->misc1 = $mixEntity;
        } else {
            $this->objEnrollment->misc1 = $this->strMisc1->Text;
        }
        if (get_class($this->strMisc2) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strMisc2->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('misc2');
            }
            $this->objEnrollment->misc2 = $mixEntity;
        } else {
            $this->objEnrollment->misc2 = $this->strMisc2->Text;
        }
        if (get_class($this->strMisc3) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strMisc3->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('misc3');
            }
            $this->objEnrollment->misc3 = $mixEntity;
        } else {
            $this->objEnrollment->misc3 = $this->strMisc3->Text;
        }
        if (get_class($this->strMisc4) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strMisc4->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('misc4');
            }
            $this->objEnrollment->misc4 = $mixEntity;
        } else {
            $this->objEnrollment->misc4 = $this->strMisc4->Text;
        }
        if (get_class($this->strMisc5) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strMisc5->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('misc5');
            }
            $this->objEnrollment->misc5 = $mixEntity;
        } else {
            $this->objEnrollment->misc5 = $this->strMisc5->Text;
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (get_class($this->strLevel) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strLevel->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('level');
            }
            $this->objEnrollment->level = $mixEntity;
        } else {
            $this->objEnrollment->level = $this->strLevel->Text;
        }
        $this->objEnrollment->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objEnrollment;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objEnrollment->MarkDeleted();
        $this->SetEnrollment(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objEnrollment);
    }
    public function InitIdAtheleteAutocomplete() {
        $this->intIdAthelete = new MJaxBSAutocompleteTextBox($this);
        $this->intIdAthelete->SetSearchEntity('athelete');
        $this->intIdAthelete->Name = 'idAthelete';
        $this->intIdAthelete->AddCssClass('input-large');
    }
    public function InitIdCompetitionAutocomplete() {
        $this->intIdCompetition = new MJaxBSAutocompleteTextBox($this);
        $this->intIdCompetition->SetSearchEntity('competition');
        $this->intIdCompetition->Name = 'idCompetition';
        $this->intIdCompetition->AddCssClass('input-large');
    }
    public function InitIdSessionAutocomplete() {
        $this->intIdSession = new MJaxBSAutocompleteTextBox($this);
        $this->intIdSession->SetSearchEntity('session');
        $this->intIdSession->Name = 'idSession';
        $this->intIdSession->AddCssClass('input-large');
    }
    public function InitFlightAutocomplete() {
        $this->strFlight = new MJaxBSAutocompleteTextBox($this);
        $this->strFlight->SetSearchEntity('enrollment', 'flight');
        $this->strFlight->Name = 'flight';
        $this->strFlight->AddCssClass('input-large');
    }
    public function InitDivisionAutocomplete() {
        $this->strDivision = new MJaxBSAutocompleteTextBox($this);
        $this->strDivision->SetSearchEntity('enrollment', 'division');
        $this->strDivision->Name = 'division';
        $this->strDivision->AddCssClass('input-large');
    }
    public function InitAgeGroupAutocomplete() {
        $this->strAgeGroup = new MJaxBSAutocompleteTextBox($this);
        $this->strAgeGroup->SetSearchEntity('enrollment', 'ageGroup');
        $this->strAgeGroup->Name = 'ageGroup';
        $this->strAgeGroup->AddCssClass('input-large');
    }
    public function InitMisc1Autocomplete() {
        $this->strMisc1 = new MJaxBSAutocompleteTextBox($this);
        $this->strMisc1->SetSearchEntity('enrollment', 'misc1');
        $this->strMisc1->Name = 'misc1';
        $this->strMisc1->AddCssClass('input-large');
    }
    public function InitMisc2Autocomplete() {
        $this->strMisc2 = new MJaxBSAutocompleteTextBox($this);
        $this->strMisc2->SetSearchEntity('enrollment', 'misc2');
        $this->strMisc2->Name = 'misc2';
        $this->strMisc2->AddCssClass('input-large');
    }
    public function InitMisc3Autocomplete() {
        $this->strMisc3 = new MJaxBSAutocompleteTextBox($this);
        $this->strMisc3->SetSearchEntity('enrollment', 'misc3');
        $this->strMisc3->Name = 'misc3';
        $this->strMisc3->AddCssClass('input-large');
    }
    public function InitMisc4Autocomplete() {
        $this->strMisc4 = new MJaxBSAutocompleteTextBox($this);
        $this->strMisc4->SetSearchEntity('enrollment', 'misc4');
        $this->strMisc4->Name = 'misc4';
        $this->strMisc4->AddCssClass('input-large');
    }
    public function InitMisc5Autocomplete() {
        $this->strMisc5 = new MJaxBSAutocompleteTextBox($this);
        $this->strMisc5->SetSearchEntity('enrollment', 'misc5');
        $this->strMisc5->Name = 'misc5';
        $this->strMisc5->AddCssClass('input-large');
    }
    public function InitLevelAutocomplete() {
        $this->strLevel = new MJaxBSAutocompleteTextBox($this);
        $this->strLevel->SetSearchEntity('enrollment', 'level');
        $this->strLevel->Name = 'level';
        $this->strLevel->AddCssClass('input-large');
    }
}
?>