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
* - lstMLCLocation_editInit()
* - lstMLCLocation_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - MLCLocationManageFormBase extends FFSForm
*/
class MLCLocationManageFormBase extends FFSForm {
    public $lstMLCLocations = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdLocation = MLCApplication::QS(FFSQS::MLCLocation_IdLocation);
        if (!is_null($intIdLocation)) {
            $arrAndConditions[] = sprintf('idLocation = %s', $intIdLocation);
        }
        $strShortDesc = MLCApplication::QS(FFSQS::MLCLocation_ShortDesc);
        if (!is_null($strShortDesc)) {
            $arrAndConditions[] = sprintf('shortDesc LIKE "%s%%"', $strShortDesc);
        }
        $strAddress1 = MLCApplication::QS(FFSQS::MLCLocation_Address1);
        if (!is_null($strAddress1)) {
            $arrAndConditions[] = sprintf('address1 LIKE "%s%%"', $strAddress1);
        }
        $strAddress2 = MLCApplication::QS(FFSQS::MLCLocation_Address2);
        if (!is_null($strAddress2)) {
            $arrAndConditions[] = sprintf('address2 LIKE "%s%%"', $strAddress2);
        }
        $strCity = MLCApplication::QS(FFSQS::MLCLocation_City);
        if (!is_null($strCity)) {
            $arrAndConditions[] = sprintf('city LIKE "%s%%"', $strCity);
        }
        $strState = MLCApplication::QS(FFSQS::MLCLocation_State);
        if (!is_null($strState)) {
            $arrAndConditions[] = sprintf('state LIKE "%s%%"', $strState);
        }
        $strZip = MLCApplication::QS(FFSQS::MLCLocation_Zip);
        if (!is_null($strZip)) {
            $arrAndConditions[] = sprintf('zip LIKE "%s%%"', $strZip);
        }
        $strCountry = MLCApplication::QS(FFSQS::MLCLocation_Country);
        if (!is_null($strCountry)) {
            $arrAndConditions[] = sprintf('country LIKE "%s%%"', $strCountry);
        }
        $intIdAccount = MLCApplication::QS(FFSQS::MLCLocation_IdAccount);
        if (!is_null($intIdAccount)) {
            $arrAndConditions[] = sprintf('idAccount = %s', $intIdAccount);
        }
        if (count($arrAndConditions) >= 1) {
            $arrMLCLocations = MLCLocation::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrMLCLocations = array();
        }
        return $arrMLCLocations;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new MLCLocationSelectPanel($this);
        $this->pnlSelect->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtMLCLocation = $this->AddWidget('Select MLCLocation', 'icon-select', $this->pnlSelect);
        $wgtMLCLocation->AddCssClass('span6');
        return $wgtMLCLocation;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrMLCLocations = $this->pnlSelect->GetValue();
        if (count($arrMLCLocations) == 1) {
            $this->pnlEdit->SetMLCLocation($arrMLCLocations[0]);
            foreach ($this->lstMLCLocations as $objRow) {
                if ($objRow->ActionParameter == $arrMLCLocations[0]->IdLocation) {
                    $this->lstMLCLocations->SelectedRow = $objRow;
                }
            }
            $this->ScrollTo($this->pnlEdit);
        } else {
            $this->ScrollTo($this->lstMLCLocations);
        }
        $this->lstMLCLocations->RemoveAllChildControls();
        $this->lstMLCLocations->SetDataEntites($arrMLCLocations);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objMLCLocation = null) {
        $this->pnlEdit = new MLCLocationEditPanel($this, $objMLCLocation);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtMLCLocation = $this->AddWidget(((is_null($objMLCLocation)) ? 'Create MLCLocation' : 'Edit MLCLocation') , 'icon-edit', $this->pnlEdit);
        $wgtMLCLocation->AddCssClass('span6');
        return $wgtMLCLocation;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objMLCLocation) {
        $this->UpdateTable($objMLCLocation);
        $this->ScrollTo($this->lstMLCLocations->SelectedRow);
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objMLCLocation) {
        $this->lstMLCLocations->SelectedRow->Remove();
        $this->lstMLCLocations->SelectedRow = null;
    }
    public function InitList($arrMLCLocations) {
        $this->lstMLCLocations = new MLCLocationListPanel($this, $arrMLCLocations);
        $this->lstMLCLocations->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstMLCLocation_editInit'));
        $this->lstMLCLocations->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstMLCLocation_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstMLCLocations->InitRemoveButtons();
            $this->lstMLCLocations->InitEditControls();
            $this->lstMLCLocations->AddEmptyRow();
        } else {
            $this->lstMLCLocations->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $wgtMLCLocation = $this->AddWidget('MLCLocations', 'icon-ul', $this->lstMLCLocations);
        $wgtMLCLocation->AddCssClass('span12');
        return $wgtMLCLocation;
    }
    public function lstMLCLocation_editInit() {
        //_dv($this->lstMLCLocations->SelectedRow);
        
    }
    public function lstMLCLocation_editSave() {
        $objMLCLocation = MLCLocation::LoadById($this->lstMLCLocations->SelectedRow->ActionParameter);
        if (is_null($objMLCLocation)) {
            $objMLCLocation = new MLCLocation();
        }
        $objMLCLocation->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstMLCLocations->SelectedRow->UpdateEntity($objMLCLocation);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetMLCLocation(MLCLocation::LoadById($strActionParameter));
        $this->lstMLCLocations->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objMLCLocation) {
        //_dv($objMLCLocation);
        if (!is_null($this->lstMLCLocations->SelectedRow)) {
            //This already exists
            $this->lstMLCLocations->SelectedRow->UpdateEntity($objMLCLocation);
            $this->lstMLCLocations->SelectedRow = null;
        } else {
            $objRow = $this->lstMLCLocations->AddRow($objMLCLocation);
        }
    }
}
