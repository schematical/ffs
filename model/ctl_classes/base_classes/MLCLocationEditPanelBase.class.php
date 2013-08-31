<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetMLCLocation()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* Classes list:
* - MLCLocationEditPanelBase extends MJaxPanel
*/
class MLCLocationEditPanelBase extends MJaxPanel {
    protected $objMLCLocation = null;
    public $intIdLocation = null;
    public $strShortDesc = null;
    public $strAddress1 = null;
    public $strAddress2 = null;
    public $strCity = null;
    public $strState = null;
    public $strZip = null;
    public $strCountry = null;
    public $fltLat = null;
    public $fltLng = null;
    public $intIdAccount = null;
    public $lnkViewParentIdAccount = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objMLCLocation = null) {
        parent::__construct($objParentControl);
        $this->objMLCLocation = $objMLCLocation;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/MLCLocationEditPanelBase.tpl.php';
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
        if (is_null($this->objMLCLocation)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strShortDesc = new MJaxTextBox($this);
        $this->strShortDesc->Name = 'shortDesc';
        $this->strShortDesc->AddCssClass('input-large');
        //varchar(128)
        $this->strAddress1 = new MJaxTextBox($this);
        $this->strAddress1->Name = 'address1';
        $this->strAddress1->AddCssClass('input-large');
        //varchar(128)
        $this->strAddress2 = new MJaxTextBox($this);
        $this->strAddress2->Name = 'address2';
        $this->strAddress2->AddCssClass('input-large');
        //varchar(128)
        $this->strCity = new MJaxTextBox($this);
        $this->strCity->Name = 'city';
        $this->strCity->AddCssClass('input-large');
        //varchar(64)
        $this->strState = new MJaxTextBox($this);
        $this->strState->Name = 'state';
        $this->strState->AddCssClass('input-large');
        //varchar(64)
        $this->strZip = new MJaxTextBox($this);
        $this->strZip->Name = 'zip';
        $this->strZip->AddCssClass('input-large');
        //varchar(16)
        $this->strCountry = new MJaxTextBox($this);
        $this->strCountry->Name = 'country';
        $this->strCountry->AddCssClass('input-large');
        //varchar(128)
        $this->fltLat = new MJaxTextBox($this);
        $this->fltLat->Name = 'lat';
        $this->fltLat->AddCssClass('input-large');
        //float
        $this->fltLng = new MJaxTextBox($this);
        $this->fltLng->Name = 'lng';
        $this->fltLng->AddCssClass('input-large');
        //float
        if (!is_null($this->objMLCLocation)) {
            $this->SetMLCLocation($this->objMLCLocation);
        }
    }
    public function SetMLCLocation($objMLCLocation) {
        $this->objMLCLocation = $objMLCLocation;
        $this->ActionParameter = $this->objMLCLocation;
        $this->blnModified = true;
        if (!is_null($this->objMLCLocation)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdLocation = $this->objMLCLocation->idLocation;
            $this->strShortDesc->Text = $this->objMLCLocation->shortDesc;
            $this->strAddress1->Text = $this->objMLCLocation->address1;
            $this->strAddress2->Text = $this->objMLCLocation->address2;
            $this->strCity->Text = $this->objMLCLocation->city;
            $this->strState->Text = $this->objMLCLocation->state;
            $this->strZip->Text = $this->objMLCLocation->zip;
            $this->strCountry->Text = $this->objMLCLocation->country;
            $this->fltLat->Text = $this->objMLCLocation->lat;
            $this->fltLng->Text = $this->objMLCLocation->lng;
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objMLCLocation)) {
            if (!is_null($this->objMLCLocation->idAccount)) {
                $this->lnkViewParentIdAccount = new MJaxLinkButton($this);
                $this->lnkViewParentIdAccount->Text = 'View AuthAccount';
                $this->lnkViewParentIdAccount->Href = __ENTITY_MODEL_DIR__ . '/AuthAccount/' . $this->objMLCLocation->idAccount;
            }
        }
    }
    public function btnSave_click() {
        if (is_null($this->objMLCLocation)) {
            //Create a new one
            $this->objMLCLocation = new MLCLocation();
        }
        $this->objMLCLocation->shortDesc = $this->strShortDesc->Text;
        $this->objMLCLocation->address1 = $this->strAddress1->Text;
        $this->objMLCLocation->address2 = $this->strAddress2->Text;
        $this->objMLCLocation->city = $this->strCity->Text;
        $this->objMLCLocation->state = $this->strState->Text;
        $this->objMLCLocation->zip = $this->strZip->Text;
        $this->objMLCLocation->country = $this->strCountry->Text;
        $this->objMLCLocation->lat = $this->fltLat->Text;
        $this->objMLCLocation->lng = $this->fltLng->Text;
        $this->objMLCLocation->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objMLCLocation;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objMLCLocation->MarkDeleted();
        $this->SetMLCLocation(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objMLCLocation);
    }
}
?>