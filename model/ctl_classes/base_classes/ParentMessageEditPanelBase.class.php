<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetParentMessage()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* - InitIdAtheleteAutocomplete()
* - InitAtheleteNameAutocomplete()
* - InitInviteDataAutocomplete()
* - InitInviteTypeAutocomplete()
* - InitInviteTokenAutocomplete()
* - InitIdCompetitionAutocomplete()
* Classes list:
* - ParentMessageEditPanelBase extends MJaxPanel
*/
class ParentMessageEditPanelBase extends MJaxPanel {
    protected $objParentMessage = null;
    public $intIdParentMessage = null;
    public $intIdAthelete = null;
    public $strAtheleteName = null;
    public $strMessage = null;
    public $dttCreDate = null;
    public $dttDispDate = null;
    public $intIdUser = null;
    public $dttQueDate = null;
    public $strInviteData = null;
    public $strInviteType = null;
    public $strInviteToken = null;
    public $dttInviteViewDate = null;
    public $intIdCompetition = null;
    public $dttApproveDate = null;
    public $intIdStripeData = null;
    public $lnkViewParentIdAthelete = null;
    public $lnkViewParentIdCompetition = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objParentMessage = null) {
        parent::__construct($objParentControl);
        $this->objParentMessage = $objParentMessage;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/ParentMessageEditPanelBase.tpl.php';
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
        if (is_null($this->objParentMessage)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strAtheleteName = new MJaxTextBox($this);
        $this->strAtheleteName->Name = 'atheleteName';
        $this->strAtheleteName->AddCssClass('input-large');
        //varchar(255)
        $this->strMessage = new MJaxTextBox($this);
        $this->strMessage->Name = 'message';
        $this->strMessage->AddCssClass('input-large');
        //longtext
        $this->strMessage->TextMode = MJaxTextMode::MultiLine;
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $this->dttDispDate = new MJaxBSDateTimePicker($this);
        //Is special field!!!!!
        //Is special field!!!!!
        $this->dttQueDate = new MJaxBSDateTimePicker($this);
        //Is special field!!!!!
        $this->strInviteType = new MJaxTextBox($this);
        $this->strInviteType->Name = 'inviteType';
        $this->strInviteType->AddCssClass('input-large');
        //varchar(16)
        $this->strInviteToken = new MJaxTextBox($this);
        $this->strInviteToken->Name = 'inviteToken';
        $this->strInviteToken->AddCssClass('input-large');
        //varchar(256)
        //Is special field!!!!!
        $this->dttInviteViewDate = new MJaxBSDateTimePicker($this);
        //Is special field!!!!!
        $this->dttApproveDate = new MJaxBSDateTimePicker($this);
        //Is special field!!!!!
        if (!is_null($this->objParentMessage)) {
            $this->SetParentMessage($this->objParentMessage);
        }
    }
    public function SetParentMessage($objParentMessage) {
        $this->objParentMessage = $objParentMessage;
        $this->ActionParameter = $this->objParentMessage;
        $this->blnModified = true;
        if (!is_null($this->objParentMessage)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdParentMessage = $this->objParentMessage->idParentMessage;
            $this->strAtheleteName->Text = $this->objParentMessage->atheleteName;
            $this->strMessage->Text = $this->objParentMessage->message;
            //Is special field!!!!!
            //Do nothing this is a creDate
            //Is special field!!!!!
            $this->dttDispDate->Value = $this->objParentMessage->dispDate;
            //Is special field!!!!!
            //Is special field!!!!!
            $this->dttQueDate->Value = $this->objParentMessage->queDate;
            //Is special field!!!!!
            $this->strInviteType->Text = $this->objParentMessage->inviteType;
            $this->strInviteToken->Text = $this->objParentMessage->inviteToken;
            //Is special field!!!!!
            $this->dttInviteViewDate->Value = $this->objParentMessage->inviteViewDate;
            //Is special field!!!!!
            $this->dttApproveDate->Value = $this->objParentMessage->approveDate;
            //Is special field!!!!!
            
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objParentMessage)) {
            if (!is_null($this->objParentMessage->idAthelete)) {
                $this->lnkViewParentIdAthelete = new MJaxLinkButton($this);
                $this->lnkViewParentIdAthelete->Text = 'View Athelete';
                $this->lnkViewParentIdAthelete->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objParentMessage->idAthelete;
            }
            if (!is_null($this->objParentMessage->idCompetition)) {
                $this->lnkViewParentIdCompetition = new MJaxLinkButton($this);
                $this->lnkViewParentIdCompetition->Text = 'View Competition';
                $this->lnkViewParentIdCompetition->Href = __ENTITY_MODEL_DIR__ . '/Competition/' . $this->objParentMessage->idCompetition;
            }
        }
    }
    public function btnSave_click() {
        if (is_null($this->objParentMessage)) {
            //Create a new one
            $this->objParentMessage = new ParentMessage();
        }
        if (get_class($this->strAtheleteName) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strAtheleteName->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('atheleteName');
            }
            $this->objParentMessage->atheleteName = $mixEntity;
        } else {
            $this->objParentMessage->atheleteName = $this->strAtheleteName->Text;
        }
        if (get_class($this->strMessage) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strMessage->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('message');
            }
            $this->objParentMessage->message = $mixEntity;
        } else {
            $this->objParentMessage->message = $this->strMessage->Text;
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $this->objParentMessage->dispDate = $this->dttDispDate->GetValue();
        //Is special field!!!!!
        $this->objParentMessage->idUser = MLCAuthDriver::IdUser();
        //Is special field!!!!!
        $this->objParentMessage->queDate = $this->dttQueDate->GetValue();
        //Is special field!!!!!
        if (get_class($this->strInviteType) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strInviteType->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('inviteType');
            }
            $this->objParentMessage->inviteType = $mixEntity;
        } else {
            $this->objParentMessage->inviteType = $this->strInviteType->Text;
        }
        if (get_class($this->strInviteToken) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strInviteToken->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('inviteToken');
            }
            $this->objParentMessage->inviteToken = $mixEntity;
        } else {
            $this->objParentMessage->inviteToken = $this->strInviteToken->Text;
        }
        //Is special field!!!!!
        $this->objParentMessage->inviteViewDate = $this->dttInviteViewDate->GetValue();
        //Is special field!!!!!
        $this->objParentMessage->approveDate = $this->dttApproveDate->GetValue();
        //Is special field!!!!!
        $this->objParentMessage->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objParentMessage;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objParentMessage->MarkDeleted();
        $this->SetParentMessage(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objParentMessage);
    }
    public function InitIdAtheleteAutocomplete() {
        $this->intIdAthelete = new MJaxBSAutocompleteTextBox($this);
        $this->intIdAthelete->SetSearchEntity('athelete');
        $this->intIdAthelete->Name = 'idAthelete';
        $this->intIdAthelete->AddCssClass('input-large');
    }
    public function InitAtheleteNameAutocomplete() {
        $this->strAtheleteName = new MJaxBSAutocompleteTextBox($this);
        $this->strAtheleteName->SetSearchEntity('parentmessage', 'atheleteName');
        $this->strAtheleteName->Name = 'atheleteName';
        $this->strAtheleteName->AddCssClass('input-large');
    }
    public function InitInviteDataAutocomplete() {
        $this->strInviteData = new MJaxBSAutocompleteTextBox($this);
        $this->strInviteData->SetSearchEntity('parentmessage', 'inviteData');
        $this->strInviteData->Name = 'inviteData';
        $this->strInviteData->AddCssClass('input-large');
    }
    public function InitInviteTypeAutocomplete() {
        $this->strInviteType = new MJaxBSAutocompleteTextBox($this);
        $this->strInviteType->SetSearchEntity('parentmessage', 'inviteType');
        $this->strInviteType->Name = 'inviteType';
        $this->strInviteType->AddCssClass('input-large');
    }
    public function InitInviteTokenAutocomplete() {
        $this->strInviteToken = new MJaxBSAutocompleteTextBox($this);
        $this->strInviteToken->SetSearchEntity('parentmessage', 'inviteToken');
        $this->strInviteToken->Name = 'inviteToken';
        $this->strInviteToken->AddCssClass('input-large');
    }
    public function InitIdCompetitionAutocomplete() {
        $this->intIdCompetition = new MJaxBSAutocompleteTextBox($this);
        $this->intIdCompetition->SetSearchEntity('competition');
        $this->intIdCompetition->Name = 'idCompetition';
        $this->intIdCompetition->AddCssClass('input-large');
    }
}
?>