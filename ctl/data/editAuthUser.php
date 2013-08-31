<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthUserManageForm extends AuthUserManageFormBase
*/
class AuthUserManageForm extends AuthUserManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthUsers = $this->Query();
        $objAuthUser = null;
        if (count($arrAuthUsers) == 1) {
            $objAuthUser = $arrAuthUsers[0];
        }
        $this->InitEditPanel($objAuthUser);
        $this->InitList($arrAuthUsers);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthUsers');
    }
}
AuthUserManageForm::Run('AuthUserManageForm');
