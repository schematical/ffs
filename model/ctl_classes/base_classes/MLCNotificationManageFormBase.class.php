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
* - lstMLCNotification_editInit()
* - lstMLCNotification_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - MLCNotificationManageFormBase extends FFSForm
*/
class MLCNotificationManageFormBase extends FFSForm {
    public $lstMLCNotifications = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdNotification = MLCApplication::QS(FFSQS::MLCNotification_IdNotification);
        if (!is_null($intIdNotification)) {
            $arrAndConditions[] = sprintf('idNotification = %s', $intIdNotification);
        }
        $intIdUser = MLCApplication::QS(FFSQS::MLCNotification_IdUser);
        if (!is_null($intIdUser)) {
            $arrAndConditions[] = sprintf('idUser = %s', $intIdUser);
        }
        $strClassName = MLCApplication::QS(FFSQS::MLCNotification_ClassName);
        if (!is_null($strClassName)) {
            $arrAndConditions[] = sprintf('className LIKE "%s%%"', $strClassName);
        }
        if (count($arrAndConditions) >= 1) {
            $arrMLCNotifications = MLCNotification::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrMLCNotifications = array();
        }
        return $arrMLCNotifications;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new MLCNotificationSelectPanel($this);
        $this->pnlSelect->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtMLCNotification = $this->AddWidget('Select MLCNotification', 'icon-select', $this->pnlSelect);
        $wgtMLCNotification->AddCssClass('span6');
        return $wgtMLCNotification;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrMLCNotifications = $this->pnlSelect->GetValue();
        if (count($arrMLCNotifications) == 1) {
            $this->pnlEdit->SetMLCNotification($arrMLCNotifications[0]);
            foreach ($this->lstMLCNotifications as $objRow) {
                if ($objRow->ActionParameter == $arrMLCNotifications[0]->IdNotification) {
                    $this->lstMLCNotifications->SelectedRow = $objRow;
                }
            }
            $this->ScrollTo($this->pnlEdit);
        } else {
            $this->ScrollTo($this->lstMLCNotifications);
        }
        $this->lstMLCNotifications->RemoveAllChildControls();
        $this->lstMLCNotifications->SetDataEntites($arrMLCNotifications);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objMLCNotification = null) {
        $this->pnlEdit = new MLCNotificationEditPanel($this, $objMLCNotification);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtMLCNotification = $this->AddWidget(((is_null($objMLCNotification)) ? 'Create MLCNotification' : 'Edit MLCNotification') , 'icon-edit', $this->pnlEdit);
        $wgtMLCNotification->AddCssClass('span6');
        return $wgtMLCNotification;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objMLCNotification) {
        $this->UpdateTable($objMLCNotification);
        $this->ScrollTo($this->lstMLCNotifications->SelectedRow);
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objMLCNotification) {
        $this->lstMLCNotifications->SelectedRow->Remove();
        $this->lstMLCNotifications->SelectedRow = null;
    }
    public function InitList($arrMLCNotifications) {
        $this->lstMLCNotifications = new MLCNotificationListPanel($this, $arrMLCNotifications);
        $this->lstMLCNotifications->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstMLCNotification_editInit'));
        $this->lstMLCNotifications->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstMLCNotification_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstMLCNotifications->InitRemoveButtons();
            $this->lstMLCNotifications->InitEditControls();
            $this->lstMLCNotifications->AddEmptyRow();
        } else {
            $this->lstMLCNotifications->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $wgtMLCNotification = $this->AddWidget('MLCNotifications', 'icon-ul', $this->lstMLCNotifications);
        $wgtMLCNotification->AddCssClass('span12');
        return $wgtMLCNotification;
    }
    public function lstMLCNotification_editInit() {
        //_dv($this->lstMLCNotifications->SelectedRow);
        
    }
    public function lstMLCNotification_editSave() {
        $objMLCNotification = MLCNotification::LoadById($this->lstMLCNotifications->SelectedRow->ActionParameter);
        if (is_null($objMLCNotification)) {
            $objMLCNotification = new MLCNotification();
        }
        $objMLCNotification->IdCompetition = FFSForm::Competition()->IdCompetition;
        $this->lstMLCNotifications->SelectedRow->UpdateEntity($objMLCNotification);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetMLCNotification(MLCNotification::LoadById($strActionParameter));
        $this->lstMLCNotifications->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objMLCNotification) {
        //_dv($objMLCNotification);
        if (!is_null($this->lstMLCNotifications->SelectedRow)) {
            //This already exists
            $this->lstMLCNotifications->SelectedRow->UpdateEntity($objMLCNotification);
            $this->lstMLCNotifications->SelectedRow = null;
        } else {
            $objRow = $this->lstMLCNotifications->AddRow($objMLCNotification);
        }
    }
}
