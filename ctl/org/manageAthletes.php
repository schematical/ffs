<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AtheleteManageForm extends AtheleteManageFormBase
*/
class AtheleteManageForm extends AtheleteManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnInlineEdit = true;
        //$this->InitSelectPanel();
        $arrAtheletes = $this->Query();
                //$this->InitEditPanel($objAthelete);
        $this->InitList($arrAtheletes);
    }
    public function Query(){
        $arrAtheletes = FFSApplication::GetAtheletesByOrgManager();
        return $arrAtheletes;
    }
    public function InitList($arrAtheletes) {
        $this->lstAtheletes = new FFSAtheleteEditListPanel($this);
        $this->lstAtheletes->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstAthelete_editInit'));
        $this->lstAtheletes->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstAthelete_editSave'));
        $this->lstAtheletes->SetDataEntites($arrAtheletes);
        $objRow = $this->lstAtheletes->AddEmptyRow();

        $wgtAthelete = $this->AddWidget('Atheletes', 'icon-ul', $this->lstAtheletes);
        $wgtAthelete->AddCssClass('span12');
        return $wgtAthelete;
    }
    public function lstAthelete_editInit() {
        //_dv($this->lstAtheletes->SelectedRow);

    }
    public function lstAthelete_editSave() {
        $blnIsNew = false;
        $objAthelete = $this->lstAtheletes->SelectedRow->GetData('_entity');
        if(is_null($objAthelete)){
            $blnIsNew = true;
            $objAthelete = new Athelete();
        }

        $objAthelete->IdOrg = FFSForm::Org()->IdOrg;
//_dv(FFSForm::Org());
        $this->lstAtheletes->SelectedRow->UpdateEntity($objAthelete);
        //_dv($objAthelete);
        if($blnIsNew){
            $this->lstAtheletes->AddEmptyRow();
        }
    }
}
AtheleteManageForm::Run('AtheleteManageForm');
