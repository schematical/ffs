<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - MLCBatchManageForm extends MLCBatchManageFormBase
*/
class MLCBatchManageForm extends MLCBatchManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrMLCBatchs = $this->Query();
        $objMLCBatch = null;
        if (count($arrMLCBatchs) == 1) {
            $objMLCBatch = $arrMLCBatchs[0];
        }
        $this->InitEditPanel($objMLCBatch);
        $this->InitList($arrMLCBatchs);
        $this->pnlBreadcrumb->AddCrumb('Manage MLCBatchs');
    }
}
MLCBatchManageForm::Run('MLCBatchManageForm');
