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
* - render_idUser()
* Classes list:
* - MLCNotificationListPanelBase extends MJaxTable
*/
class MLCNotificationListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrMLCNotifications = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrMLCNotifications);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objMLCNotification = MLCNotification::LoadById($strActionParameter);
        if (!is_null($objMLCNotification)) {
            $objMLCNotification->markDeleted();
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
        //$this->AddColumn('idNotification','idNotification');
        $this->AddColumn('idUser', ' User', $this, 'render_idUser', 'MJaxTextBox');
        $this->AddColumn('className', ' Class Name', null, null, 'MJaxTextBox');
        $this->AddColumn('viewed', ' Viewed', null, null, 'MJaxTextBox');
    }
    public function render_idUser($intIdIdUser, $objRow, $objColumn) {
        if (is_null($intIdIdUser)) {
            return '';
        }
        $objAuthUser = AuthUser::LoadById($intIdIdUser);
        if (is_null($objAuthUser)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objAuthUser->__toString();
        $lnkView->Href = '/data/editAuthUser?' . FFSQS::AuthUser_IdUser . '=' . $objAuthUser->IdUser;
        return $lnkView->Render(false);
    }
}
?>