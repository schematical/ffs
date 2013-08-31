<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - MLCLocationManageForm extends MLCLocationManageFormBase
*/
class MLCLocationManageForm extends MLCLocationManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrMLCLocations = $this->Query();
        $objMLCLocation = null;
        if (count($arrMLCLocations) == 1) {
            $objMLCLocation = $arrMLCLocations[0];
        }
        $this->InitEditPanel($objMLCLocation);
        $this->InitList($arrMLCLocations);
        $this->pnlBreadcrumb->AddCrumb('Manage MLCLocations');
    }
}
MLCLocationManageForm::Run('MLCLocationManageForm');
