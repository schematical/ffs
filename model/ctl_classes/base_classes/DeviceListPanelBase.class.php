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
* - lnkViewAssignments_click()
* - render_idOrg()
* Classes list:
* - DeviceListPanelBase extends MJaxTable
*/
class DeviceListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrDevices = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrDevices);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objDevice = Device::LoadById($strActionParameter);
        if (!is_null($objDevice)) {
            $objDevice->markDeleted();
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
        //$this->AddColumn('idDevice','idDevice');
        $this->AddColumn('name', ' Name', null, null, 'MJaxTextBox');
        $this->AddColumn('token', ' Token', null, null, 'MJaxTextBox');
        $this->AddColumn('inviteEmail', ' Invite Email', null, null, 'MJaxTextBox');
        $this->AddColumn('IdOrgObject', ' Org');
        $this->InitRowControl('view_Assignments', 'View Assignments', $this, 'lnkViewAssignments_click', 'btn btn-small');
    }
    public function lnkViewAssignments_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editAssignment', array(
            FFSQS::Device_IdDevice => $strActionParameter
        ));
    }
    public function render_idOrg($intIdIdOrg, $objRow, $objColumn) {
        if (is_null($intIdIdOrg)) {
            return '';
        }
        $objOrg = Org::LoadById($intIdIdOrg);
        if (is_null($objOrg)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objOrg->__toString();
        $lnkView->Href = '/data/editOrg?' . FFSQS::Org_IdOrg . '=' . $objOrg->IdOrg;
        return $lnkView->Render(false);
    }
}
?>