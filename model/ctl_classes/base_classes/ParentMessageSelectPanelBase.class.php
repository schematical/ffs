<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - ConnectTable()
* - txtSearch_change()
* - GetExtQuery()
* - GetValue()
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
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this->objForm->objJsonSearchDriver, '_searchParentMessage');
        $this->txtSearch->Name = 'idParentMessage';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdParentMessage = new MJaxTextBox($this);
        $this->intIdParentMessage->Attr('placeholder', "idParentMessage");
        $this->intIdAthelete = new MJaxTextBox($this);
        $this->intIdAthelete->Attr('placeholder', "idAthelete");
        $this->strAtheleteName = new MJaxTextBox($this);
        $this->strAtheleteName->Attr('placeholder', "atheleteName");
        $this->strMessage = new MJaxTextBox($this);
        $this->strMessage->Attr('placeholder', "message");
        $this->txtDispDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtDispDate_StartDate->DateOnly();
        $this->txtDispDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtDispDate_EndDate->DateOnly();
        $this->intIdUser = new MJaxTextBox($this);
        $this->intIdUser->Attr('placeholder', "idUser");
        $this->txtQueDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtQueDate_StartDate->DateOnly();
        $this->txtQueDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtQueDate_EndDate->DateOnly();
        $this->strInviteData = new MJaxTextBox($this);
        $this->strInviteData->Attr('placeholder', "inviteData");
        $this->strInviteType = new MJaxTextBox($this);
        $this->strInviteType->Attr('placeholder', "inviteType");
        $this->strInviteToken = new MJaxTextBox($this);
        $this->strInviteToken->Attr('placeholder', "inviteToken");
        $this->txtInviteViewDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtInviteViewDate_StartDate->DateOnly();
        $this->txtInviteViewDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtInviteViewDate_EndDate->DateOnly();
        $this->intIdCompetition = new MJaxTextBox($this);
        $this->intIdCompetition->Attr('placeholder', "idCompetition");
        $this->txtApproveDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtApproveDate_StartDate->DateOnly();
        $this->txtApproveDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtApproveDate_EndDate->DateOnly();
        $this->intIdStripeData = new MJaxTextBox($this);
        $this->intIdStripeData->Attr('placeholder', "idStripeData");
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
        if (!is_null($this->strAtheleteName->GetValue())) {
            $arrAndConditions[] = sprintf('atheleteName LIKE "%s%%"', $this->strAtheleteName->GetValue());
        }
        if (!is_null($this->strMessage->GetValue())) {
            $arrAndConditions[] = sprintf('message LIKE "%s%%"', $this->strMessage->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        if (!is_null($this->txtDispDate_StartDate->GetValue())) {
            if (is_null($this->txtDispDate_EndDate->GetValue())) {
                $this->txtDispDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(dispDate > "%s" AND dispDate < "%s")', $this->txtDispDate_StartDate->GetValue() , $this->txtDispDate_EndDate->GetValue());
            }
        }
        //Is special field!!!!!
        //Is special field!!!!!
        if (!is_null($this->txtQueDate_StartDate->GetValue())) {
            if (is_null($this->txtQueDate_EndDate->GetValue())) {
                $this->txtQueDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(queDate > "%s" AND queDate < "%s")', $this->txtQueDate_StartDate->GetValue() , $this->txtQueDate_EndDate->GetValue());
            }
        }
        //Is special field!!!!!
        if (!is_null($this->strInviteType->GetValue())) {
            $arrAndConditions[] = sprintf('inviteType LIKE "%s%%"', $this->strInviteType->GetValue());
        }
        if (!is_null($this->strInviteToken->GetValue())) {
            $arrAndConditions[] = sprintf('inviteToken LIKE "%s%%"', $this->strInviteToken->GetValue());
        }
        //Is special field!!!!!
        if (!is_null($this->txtInviteViewDate_StartDate->GetValue())) {
            if (is_null($this->txtInviteViewDate_EndDate->GetValue())) {
                $this->txtInviteViewDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(inviteViewDate > "%s" AND inviteViewDate < "%s")', $this->txtInviteViewDate_StartDate->GetValue() , $this->txtInviteViewDate_EndDate->GetValue());
            }
        }
        //Is special field!!!!!
        if (!is_null($this->txtApproveDate_StartDate->GetValue())) {
            if (is_null($this->txtApproveDate_EndDate->GetValue())) {
                $this->txtApproveDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(approveDate > "%s" AND approveDate < "%s")', $this->txtApproveDate_StartDate->GetValue() , $this->txtApproveDate_EndDate->GetValue());
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
    /*
    public function txtSearch_search($objRoute){
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchParentMessages($strSearch, $arrData);
        die(
            json_encode(
                $arrData
            )
        );
    }
    public function SearchParentMessages($strSearch, &$arrData){
        $arrAndConditions = $this->GetExtQuery();
        if(is_numeric($strSearch)){
            $arrAndConditions[] =  sprintf(
                '(ParentMessage.idParentMessage)',
                strtolower($strSearch)
            );
        }else{
            $arrAndConditions[] = sprintf(
                '(name LIKE "%s%%" or namespace LIKE "%s%%")',
                strtolower($strSearch),
                strtolower($strSearch)
            );
        }
        $strQuery = ' WHERE ' . implode( ' AND ', $arrAndConditions);
        $arrParentMessages = ParentMessage::Query(
            $strQuery
        );
        foreach($arrParentMessages as $strKey => $objParentMessage){
            //_dv($objParentMessage-> getAllFields());
            $arrData[] = array(
                'value'=>'ParentMessage_' . $objParentMessage->GetId(),
                'text'=>$objParentMessage->__toString()
            );
        }
        return $arrData;
    }
    public function SearchOrg($strSearch, &$arrData){
        $arrAndConditions = array();
        $strJoin = '';
        if(is_numeric($strSearch)){
        }else{
            $arrAndConditions[] = sprintf(
                '(name LIKE "%s%%") GROUP BY clubNum',
                strtolower($strSearch)
            );
        }
        $strQuery = $strJoin . ' WHERE ' . implode( ' AND ', $arrAndConditions);
        $arrOrg = Org::Query(
            $strQuery
        );
        foreach($arrOrg as $strKey => $objOrg){
            $arrData[] = array(
                'value'=>'Org_' . $objOrg->GetId(),
                'text'=>'Gym:' . $objOrg->Name
            );
        }
        return $arrData;
    }
    */
}
