<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthSessionManageForm extends AuthSessionManageFormBase
*/
class AuthSessionManageForm extends AuthSessionManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthSessions = $this->Query();
        $objAuthSession = null;
        if (count($arrAuthSessions) == 1) {
            $objAuthSession = $arrAuthSessions[0];
        }
        $this->InitEditPanel($objAuthSession);
        $this->InitList($arrAuthSessions);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthSessions');
    }
}
AuthSessionManageForm::Run('AuthSessionManageForm');
