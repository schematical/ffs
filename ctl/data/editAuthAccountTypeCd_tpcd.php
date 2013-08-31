<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthAccountTypeCd_tpcdManageForm extends AuthAccountTypeCd_tpcdManageFormBase
*/
class AuthAccountTypeCd_tpcdManageForm extends AuthAccountTypeCd_tpcdManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthAccountTypeCd_tpcds = $this->Query();
        $objAuthAccountTypeCd_tpcd = null;
        if (count($arrAuthAccountTypeCd_tpcds) == 1) {
            $objAuthAccountTypeCd_tpcd = $arrAuthAccountTypeCd_tpcds[0];
        }
        $this->InitEditPanel($objAuthAccountTypeCd_tpcd);
        $this->InitList($arrAuthAccountTypeCd_tpcds);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthAccountTypeCd_tpcds');
    }
}
AuthAccountTypeCd_tpcdManageForm::Run('AuthAccountTypeCd_tpcdManageForm');
