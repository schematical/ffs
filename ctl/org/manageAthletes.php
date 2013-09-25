<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AtheleteManageForm extends AtheleteManageFormBase
*/
class AtheleteManageForm extends AtheleteManageFormBase {
    protected $wgtMaster = null;
    protected $blnInlineEdit = false;
    protected $pnlMaster = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->ForceLandscape();


        $arrAtheletes = $this->Query();

        $this->InitMasterPanel();

        $this->InitList($arrAtheletes);



    }
    public function InitMasterPanel(){
        $this->pnlMaster = new FFSManageAtheletesMasterPanel($this);
        $this->wgtMaster = $this->AddWidget('Manage Athletes', 'icon-group', $this->pnlMaster);
        $this->wgtMaster->AddCssClass('span6');
    }
    public function InitEditPanel($objAthelete = null) {
        $this->pnlEdit = new AtheleteEditPanel($this, $objAthelete);
        $this->pnlEdit->intIdOrg->Remove();
        $this->pnlEdit->intIdOrg = null;
        $this->pnlEdit->Modified = true;
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        /*$wgtAthelete = $this->AddWidget(((is_null($objAthelete)) ? 'Create Athelete' : 'Edit Athelete') , 'icon-edit', $this->pnlEdit);
        $wgtAthelete->AddCssClass('span6');*/
        $this->pnlMaster->After($this->pnlEdit);
        $this->ScrollTo($this->pnlEdit);
        return $this->pnlEdit;
    }
    public function Query(){
        $arrAtheletes = FFSApplication::GetAtheletesByOrgManager();
        return $arrAtheletes;
    }
    public function InitList($arrAtheletes) {
        $this->lstAtheletes = new FFSAtheleteEditListPanel($this);
        $this->lstAtheletes->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstAthelete_editSave'));;
        $this->lstAtheletes->AddAction(new MJaxTableColBlurEvent() , new MJaxServerControlAction($this, 'lstAthelete_editSave'));
        $this->lstAtheletes->SetDataEntites($arrAtheletes);


        $wgtAthelete = $this->AddWidget('Your Team', 'icon-ul', $this->lstAtheletes);
        $wgtAthelete->AddCssClass('span12');
        return $wgtAthelete;
    }
    public function lstAthelete_editInit() {
        //_dv($this->lstAtheletes->SelectedRow);

    }
    public function lstAthelete_editSave() {
        $blnIsNew = false;
        if(is_null($this->lstAtheletes->SelectedRow)){
            return;
        }
        $objAthelete = $this->lstAtheletes->SelectedRow->GetData('_entity');
        if(is_null($objAthelete)){
            $blnIsNew = true;
            $objAthelete = new Athelete();
            $objAthelete->IdOrg = FFSForm::Org()->IdOrg;
            $this->lstAtheletes->RefreshControls();
            $this->lstAtheletes->SelectedRow->SetData('_entity', $objAthelete);
        }



        $this->lstAtheletes->SelectedRow->UpdateEntity($objAthelete);
        $this->lstAtheletes->SelectedRow->ActionParameter = $objAthelete->IdAthelete;
        //_dv($objAthelete);
        /*if($blnIsNew){
            $this->lstAtheletes->AddEmptyRow();
        }*/
    }
  /*  public function lnkAddAtheleteEditPanel_click()
    {
        $wgtEdit = $this->InitEditPanel();

    }*/
    public function lnkAddAtheleteInline_click(){
        $objRow = $this->lstAtheletes->AddEmptyRow();
        $this->ScrollTo($objRow);
        $this->lstAtheletes->SelectedCol = $this->lstAtheletes->GetColumns()['firstName'];
        $this->Focus('.mjax-td-selected > *');
    }
}
AtheleteManageForm::Run('AtheleteManageForm');
