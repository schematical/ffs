<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstAthelete_editInit()
* - lstAthelete_editSave()
* Classes list:
* - AtheleteManageFormBase extends FFSForm
*/
class AtheleteManageFormBase extends FFSForm {
    public $lstAtheletes = null;
    public $pnlEdit = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function InitEditPanel($objAthelete = null) {
        $this->pnlEdit = new AtheleteEditPanel($this, $objAthelete);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtAthelete = $this->AddWidget(((is_null($objAthelete)) ? 'Create Athelete' : 'Edit Athelete') , 'icon-edit', $this->pnlEdit);
        return $wgtAthelete;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objAthelete) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objAthelete) {
    }
    public function InitList($arrAtheletes) {
        $this->lstAtheletes = new AtheleteListPanel($this, $arrAtheletes);
        $this->lstAtheletes->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstAthelete_editInit'));
        $this->lstAtheletes->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstAthelete_editSave'));
        $wgtAthelete = $this->AddWidget('Atheletes', 'icon-ul', $this->lstAtheletes);
        return $wgtAthelete;
    }
    public function lstAthelete_editInit() {
        //_dv($this->lstAtheletes->SelectedRow);
        
    }
    public function lstAthelete_editSave() {
        $objAthelete = Athelete::LoadById($this->lstAtheletes->SelectedRow->ActionParameter);
        if (is_null($objAthelete)) {
            $objAthelete = new Athelete();
        }
        $objAthelete->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstAtheletes->SelectedRow->UpdateEntity($objAthelete);
    }
}
