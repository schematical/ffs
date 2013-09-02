<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - OrgCompetitionManageForm extends OrgCompetitionManageFormBase
*/
class OrgCompetitionManageForm extends OrgCompetitionManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrOrgCompetitions = $this->Query();
        $objOrgCompetition = null;
        if (count($arrOrgCompetitions) == 1) {
            $objOrgCompetition = $arrOrgCompetitions[0];
        }
        $this->InitEditPanel($objOrgCompetition);
        $this->InitList($arrOrgCompetitions);
        $this->pnlBreadcrumb->AddCrumb('Manage OrgCompetitions');
    }
}
OrgCompetitionManageForm::Run('OrgCompetitionManageForm');
