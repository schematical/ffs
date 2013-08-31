<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - Query()
* - InitSelectPanel()
* - pnlSelect_change()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstStripeData_editInit()
* - lstStripeData_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - StripeDataManageFormBase extends FFSForm
*/
class StripeDataManageFormBase extends FFSForm {
    public $lstStripeDatas = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdStripeData = MLCApplication::QS(FFSQS::StripeData_IdStripeData);
        if (!is_null($intIdStripeData)) {
            $arrAndConditions[] = sprintf('idStripeData = %s', $intIdStripeData);
        }
        $strMode = MLCApplication::QS(FFSQS::StripeData_Mode);
        if (!is_null($strMode)) {
            $arrAndConditions[] = sprintf('mode LIKE "%s%%"', $strMode);
        }
        $strInstance_url = MLCApplication::QS(FFSQS::StripeData_Instance_url);
        if (!is_null($strInstance_url)) {
            $arrAndConditions[] = sprintf('instance_url LIKE "%s%%"', $strInstance_url);
        }
        $strStripeId = MLCApplication::QS(FFSQS::StripeData_StripeId);
        if (!is_null($strStripeId)) {
            $arrAndConditions[] = sprintf('stripeId LIKE "%s%%"', $strStripeId);
        }
        if (count($arrAndConditions) >= 1) {
            $arrStripeDatas = StripeData::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrStripeDatas = array();
        }
        return $arrStripeDatas;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new StripeDataSelectPanel($this);
        $this->pnlSelect->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtStripeData = $this->AddWidget('Select StripeData', 'icon-select', $this->pnlSelect);
        $wgtStripeData->AddCssClass('span6');
        return $wgtStripeData;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrStripeDatas = $this->pnlSelect->GetValue();
        if (count($arrStripeDatas) == 1) {
            $this->pnlEdit->SetStripeData($arrStripeDatas[0]);
            foreach ($this->lstStripeDatas as $objRow) {
                if ($objRow->ActionParameter == $arrStripeDatas[0]->IdStripeData) {
                    $this->lstStripeDatas->SelectedRow = $objRow;
                }
            }
            $this->ScrollTo($this->pnlEdit);
        } else {
            $this->ScrollTo($this->lstStripeDatas);
        }
        $this->lstStripeDatas->RemoveAllChildControls();
        $this->lstStripeDatas->SetDataEntites($arrStripeDatas);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objStripeData = null) {
        $this->pnlEdit = new StripeDataEditPanel($this, $objStripeData);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtStripeData = $this->AddWidget(((is_null($objStripeData)) ? 'Create StripeData' : 'Edit StripeData') , 'icon-edit', $this->pnlEdit);
        $wgtStripeData->AddCssClass('span6');
        return $wgtStripeData;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objStripeData) {
        $this->UpdateTable($objStripeData);
        $this->ScrollTo($this->lstStripeDatas->SelectedRow);
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objStripeData) {
        $this->lstStripeDatas->SelectedRow->Remove();
        $this->lstStripeDatas->SelectedRow = null;
    }
    public function InitList($arrStripeDatas) {
        $this->lstStripeDatas = new StripeDataListPanel($this, $arrStripeDatas);
        $this->lstStripeDatas->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstStripeData_editInit'));
        $this->lstStripeDatas->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstStripeData_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstStripeDatas->InitRemoveButtons();
            $this->lstStripeDatas->InitEditControls();
            $this->lstStripeDatas->AddEmptyRow();
        } else {
            $this->lstStripeDatas->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $wgtStripeData = $this->AddWidget('StripeDatas', 'icon-ul', $this->lstStripeDatas);
        $wgtStripeData->AddCssClass('span12');
        return $wgtStripeData;
    }
    public function lstStripeData_editInit() {
        //_dv($this->lstStripeDatas->SelectedRow);
        
    }
    public function lstStripeData_editSave() {
        $objStripeData = StripeData::LoadById($this->lstStripeDatas->SelectedRow->ActionParameter);
        if (is_null($objStripeData)) {
            $objStripeData = new StripeData();
        }
        $objStripeData->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstStripeDatas->SelectedRow->UpdateEntity($objStripeData);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetStripeData(StripeData::LoadById($strActionParameter));
        $this->lstStripeDatas->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objStripeData) {
        //_dv($objStripeData);
        if (!is_null($this->lstStripeDatas->SelectedRow)) {
            //This already exists
            $this->lstStripeDatas->SelectedRow->UpdateEntity($objStripeData);
            $this->lstStripeDatas->SelectedRow = null;
        } else {
            $objRow = $this->lstStripeDatas->AddRow($objStripeData);
        }
    }
}
