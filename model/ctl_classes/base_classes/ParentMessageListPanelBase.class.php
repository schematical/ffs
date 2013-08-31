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
* - render_idAthelete()
* - render_idCompetition()
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
        $this->AddColumn('idAthelete', ' Athelete', $this, 'render_idAthelete', 'MJaxTextBox');
        $this->AddColumn('atheleteName', ' Athelete Name', null, null, 'MJaxTextBox');
        $this->AddColumn('message', ' Message', null, null, 'MJaxTextArea');
        $this->AddColumn('inviteType', ' Invite Type', null, null, 'MJaxTextBox');
        $this->AddColumn('inviteToken', ' Invite Token', null, null, 'MJaxTextBox');
        $this->AddColumn('idCompetition', ' Competition', $this, 'render_idCompetition', 'MJaxTextBox');
    }
    public function render_idAthelete($intIdIdAthelete, $objRow, $objColumn) {
        if (is_null($intIdIdAthelete)) {
            return '';
        }
        $objAthelete = Athelete::LoadById($intIdIdAthelete);
        if (is_null($objAthelete)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objAthelete->__toString();
        $lnkView->Href = '/data/editAthelete?' . FFSQS::Athelete_IdAthelete . '=' . $objAthelete->IdAthelete;
        return $lnkView->Render(false);
    }
    public function render_idCompetition($intIdIdCompetition, $objRow, $objColumn) {
        if (is_null($intIdIdCompetition)) {
            return '';
        }
        $objCompetition = Competition::LoadById($intIdIdCompetition);
        if (is_null($objCompetition)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objCompetition->__toString();
        $lnkView->Href = '/data/editCompetition?' . FFSQS::Competition_IdCompetition . '=' . $objCompetition->IdCompetition;
        return $lnkView->Render(false);
    }
}
?>