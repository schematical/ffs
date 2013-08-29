<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - ConnectTable()
* - txtSearch_change()
* - GetExtQuery()
* - GetValue()
* - txtSearch_search()
* - SearchParentMessages()
* - SearchOrg()
* Classes list:
* - ParentMessageSelectPanelBase extends MJaxPanel
*/
class ParentMessageSelectPanelBase extends MJaxPanel {
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
    */
    public $txtSearch = null;
    public $tblParentMessages = null;
    public $intIdParentMessage = null;
    public $intIdAthelete = null;
    public $strAtheleteName = null;
    public $strMessage = null;
    public $txtDispDate_StartDate = null;
    public $txtDispDate_EndDate = null;
    public $intIdUser = null;
    public $txtQueDate_StartDate = null;
    public $txtQueDate_EndDate = null;
    public $strInviteData = null;
    public $strInviteType = null;
    public $strInviteToken = null;
    public $txtInviteViewDate_StartDate = null;
    public $txtInviteViewDate_EndDate = null;
    public $intIdCompetition = null;
    public $txtApproveDate_StartDate = null;
    public $txtApproveDate_EndDate = null;
    public $intIdStripeData = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this, 'txtSearch_search');
        $this->txtSearch->Name = 'idParentMessage';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdParentMessage = new MJaxTextBox($this);
        $this->intIdAthelete = new MJaxTextBox($this);
        $this->strAtheleteName = new MJaxTextBox($this);
        $this->strMessage = new MJaxTextBox($this);
        $this->txtDispDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtDispDate_StartDate->DateOnly();
        $this->txtDispDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtDispDate_EndDate->DateOnly();
        $this->intIdUser = new MJaxTextBox($this);
        $this->txtQueDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtQueDate_StartDate->DateOnly();
        $this->txtQueDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtQueDate_EndDate->DateOnly();
        $this->strInviteData = new MJaxTextBox($this);
        $this->strInviteType = new MJaxTextBox($this);
        $this->strInviteToken = new MJaxTextBox($this);
        $this->txtInviteViewDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtInviteViewDate_StartDate->DateOnly();
        $this->txtInviteViewDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtInviteViewDate_EndDate->DateOnly();
        $this->intIdCompetition = new MJaxTextBox($this);
        $this->txtApproveDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtApproveDate_StartDate->DateOnly();
        $this->txtApproveDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtApproveDate_EndDate->DateOnly();
        $this->intIdStripeData = new MJaxTextBox($this);
        $this->txtAdvStartDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvStartDate->DateOnly();
        $this->txtAdvEndDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvEndDate->DateOnly();
    }
    public function ConnectTable($tblParentMessages) {
        $this->tblParentMessages = $tblParentMessages;
        //$this->tblParentMessages = new ParentMessageListPanel($this);
        $this->tblParentMessages->AddColumn('selected', '');
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (class_exists($arrParts[0])) {
            $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
        }
        $arrParentMessages = array();
        switch (get_class($objEntity)) {
            case ('ParentMessage'):
                $arrParentMessages = array(
                    $objEntity
                );
            break;
            case ('Athelete'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idAthelete = %s', $objEntity->IdAthelete);
                $arrParentMessages = ParentMessage::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Competition'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idCompetition = %s', $objEntity->IdCompetition);
                $arrParentMessages = ParentMessage::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        if (!is_null($this->tblParentMessages)) {
            $this->tblParentMessages->RemoveAllChildControls();
            $this->tblParentMessages->SetDataEntites($arrParentMessages);
            foreach ($this->tblParentMessages->Rows as $intIndex => $objRow) {
                $chkSelected = new MJaxCheckBox($this);
                $chkSelected->Checked = true;
                $objRow->AddData($chkSelected, 'selected');
            }
        }
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        $arrAndConditions[] = sprintf('atheleteName LIKE "%s%%"', $this->strAtheleteName->Value);
        $arrAndConditions[] = sprintf('message LIKE "%s%%"', $this->strMessage->Value);
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        if (!is_null($this->txtdispDate_StartDate->Value)) {
            if (is_null($this->txtDispDate_EnddDate->Value)) {
                $this->txtDispDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(dispDate > "%s" AND dispDate < "%s")', $this->txtDispDate_StartDate->Text, $this->txtDispDate_EndDate->Text);
            }
        }
        //Is special field!!!!!
        //Is special field!!!!!
        if (!is_null($this->txtqueDate_StartDate->Value)) {
            if (is_null($this->txtQueDate_EnddDate->Value)) {
                $this->txtQueDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(queDate > "%s" AND queDate < "%s")', $this->txtQueDate_StartDate->Text, $this->txtQueDate_EndDate->Text);
            }
        }
        //Is special field!!!!!
        $arrAndConditions[] = sprintf('inviteType LIKE "%s%%"', $this->strInviteType->Value);
        $arrAndConditions[] = sprintf('inviteToken LIKE "%s%%"', $this->strInviteToken->Value);
        //Is special field!!!!!
        if (!is_null($this->txtinviteViewDate_StartDate->Value)) {
            if (is_null($this->txtInviteViewDate_EnddDate->Value)) {
                $this->txtInviteViewDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(inviteViewDate > "%s" AND inviteViewDate < "%s")', $this->txtInviteViewDate_StartDate->Text, $this->txtInviteViewDate_EndDate->Text);
            }
        }
        //Is special field!!!!!
        if (!is_null($this->txtapproveDate_StartDate->Value)) {
            if (is_null($this->txtApproveDate_EnddDate->Value)) {
                $this->txtApproveDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(approveDate > "%s" AND approveDate < "%s")', $this->txtApproveDate_StartDate->Text, $this->txtApproveDate_EndDate->Text);
            }
        }
        //Is special field!!!!!
        return $arrAndConditions;
    }
    public function GetValue() {
        $arrParentMessages = array();
        foreach ($this->tblParentMessages->Rows as $intIndex => $objRow) {
            $chkSelected = $objRow->GetData('selected');
            if ($chkSelected->Checked) {
                $arrParentMessages[] = $objRow->GetData('_entity');
            }
        }
        return $arrParentMessages;
    }
    public function txtSearch_search($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchParentMessages($strSearch, $arrData);
        die(json_encode($arrData));
    }
    public function SearchParentMessages($strSearch, &$arrData) {
        $arrAndConditions = $this->GetExtQuery();
        if (is_numeric($strSearch)) {
            $arrAndConditions[] = sprintf('(ParentMessage.idParentMessage)', strtolower($strSearch));
        } else {
            $arrAndConditions[] = sprintf('(name LIKE "%s%%" or namespace LIKE "%s%%")', strtolower($strSearch));
        }
        $strQuery = ' WHERE ' . implode(' AND ', $arrAndConditions);
        $arrParentMessages = ParentMessage::Query($strQuery);
        foreach ($arrParentMessages as $strKey => $objParentMessage) {
            //_dv($objParentMessage-> getAllFields());
            $arrData[] = array(
                'value' => 'ParentMessage_' . $objParentMessage->GetId() ,
                'text' => $objParentMessage->__toString()
            );
        }
        return $arrData;
    }
    public function SearchOrg($strSearch, &$arrData) {
        $arrAndConditions = array();
        $strJoin = '';
        if (is_numeric($strSearch)) {
        } else {
            $arrAndConditions[] = sprintf('(name LIKE "%s%%") GROUP BY clubNum', strtolower($strSearch));
        }
        $strQuery = $strJoin . ' WHERE ' . implode(' AND ', $arrAndConditions);
        $arrOrg = Org::Query($strQuery);
        foreach ($arrOrg as $strKey => $objOrg) {
            $arrData[] = array(
                'value' => 'Org_' . $objOrg->GetId() ,
                'text' => 'Gym:' . $objOrg->Name
            );
        }
        return $arrData;
    }
}
