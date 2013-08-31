<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthAccountManageForm extends AuthAccountManageFormBase
*/
class AuthAccountManageForm extends AuthAccountManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthAccounts = $this->Query();
        $objAuthAccount = null;
        if (count($arrAuthAccounts) == 1) {
            $objAuthAccount = $arrAuthAccounts[0];
        }
        $this->InitEditPanel($objAuthAccount);
        $this->InitList($arrAuthAccounts);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthAccounts');
    }
}
AuthAccountManageForm::Run('AuthAccountManageForm');
