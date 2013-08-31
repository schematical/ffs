<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - OrgManageForm extends OrgManageFormBase
*/
class OrgManageForm extends OrgManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrOrgs = $this->Query();
        $objOrg = null;
        if (count($arrOrgs) == 1) {
            $objOrg = $arrOrgs[0];
        }

        $this->InitEditPanel($objOrg);
        $this->InitList($arrOrgs);
        $this->pnlEdit->Intro("Edit your gyms info", "Here you can edit your gym's information");
        $this->lstOrgs->Intro("List of gyms", "Here you can see a list of gyms");
        $this->pnlSelect->Intro("Find gyms", "Use the select panel for advances searches");

        $this->pnlBreadcrumb->AddCrumb(
            'Edit Org'
        );

    }
}
OrgManageForm::Run('OrgManageForm');
