<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - InitRemoveButtons()
* - lnkRemove_click()
* - RenderDate()
* - RenderTime()
* - SetupCols()
* - InitRowClickEntityRelAction()
* - objRow_click()
* Classes list:
* - ParentMessageListPanelBase extends MJaxTable
*/
class ParentMessageListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrParentMessages = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrParentMessages);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objParentMessage = ParentMessage::LoadById($strActionParameter);
        if (!is_null($objParentMessage)) {
            $objParentMessage->markDeleted();
        }
        foreach ($this->Rows as $intIndex => $objRow) {
            if ($objRow->ActionParameter == $strActionParameter) {
                $objRow->Remove();
                //unset($this->Rows[$intIndex]);
                $this->blnModified = true;
                return;
            }
        }
    }
    public function RenderDate($strData, $objRow) {
        return date_format(new DateTime($strData) , 'm/d/y');
    }
    public function RenderTime($strData, $objRow) {
        return date_format(new DateTime($strData) , 'h:i');
    }
    public function SetupCols() {
        //$this->AddColumn('idParentMessage','idParentMessage');
        $this->AddColumn('idAthelete', ' Id Athelete', null, null, 'MJaxTextBox');
        $this->AddColumn('atheleteName', ' Athelete Name', null, null, 'MJaxTextBox');
        $this->AddColumn('message', ' Message', null, null, 'MJaxTextArea');
        $this->AddColumn('creDate', ' Cre Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('dispDate', ' Disp Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('queDate', ' Que Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('inviteType', ' Invite Type', null, null, 'MJaxTextBox');
        $this->AddColumn('inviteToken', ' Invite Token', null, null, 'MJaxTextBox');
        $this->AddColumn('inviteViewDate', ' Invite View Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
        $this->AddColumn('idCompetition', ' Id Competition', null, null, 'MJaxTextBox');
        $this->AddColumn('approveDate', ' Approve Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
    }
    /*
    Old stuff
    */
    public function InitRowClickEntityRelAction() {
        foreach ($this->Rows as $intIndex => $objRow) {
            $objRow->AddAction($this, 'objRow_click');
        }
    }
    public function objRow_click($strFomrId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/ParentMessage/' . $strActionParameter);
    }
}
?>