<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - MLCNotificationManageForm extends MLCNotificationManageFormBase
*/
class MLCNotificationManageForm extends MLCNotificationManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrMLCNotifications = $this->Query();
        $objMLCNotification = null;
        if (count($arrMLCNotifications) == 1) {
            $objMLCNotification = $arrMLCNotifications[0];
        }
        $this->InitEditPanel($objMLCNotification);
        $this->InitList($arrMLCNotifications);
        $this->pnlBreadcrumb->AddCrumb('Manage MLCNotifications');
    }
}
MLCNotificationManageForm::Run('MLCNotificationManageForm');
