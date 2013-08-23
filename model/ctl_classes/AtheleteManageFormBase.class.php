<?php
class AtheleteManageFormBase extends FFSForm{
    public $lstAtheletes = null;
    public $pnlEdit = null;
    public function Form_Create(){
        parent::Form_Create();

        $arrAtheletes = $this->Query();
        $this->InitList($arrAtheletes);
    }
    public function InitEditPanel($objAthelete = null){
        $this->pnlEdit = new AtheleteEditPanel($this, $objAthelete);
        $this->AddWidget(
            ((is_null($objAthelete))?'Create Athelete':'Edit Athelete'),
            'icon-edit',
            $this->pnlEdit
        );
    }
    public function InitList($arrAtheletes){
        $this->lstAtheletes = new AtheleteListPanel($this, $arrAtheletes);

        $this->lstAtheletes->AddAction(
            new MJaxTableEditInitEvent(),
            new MJaxServerControlAction($this, 'lstAthelete_editInit')
        );
        $this->lstAtheletes->AddAction(
            new MJaxTableEditSaveEvent(),
            new MJaxServerControlAction($this, 'lstAthelete_editSave')
        );
        $this->AddWidget(
            'Atheletes',
            'icon-ul',
            $this->lstAtheletes
        );

    }
    public function lstAthelete_editInit(){
        //_dv($this->lstAtheletes->SelectedRow);
    }
    public function lstAthelete_editSave(){
        $objAthelete = Athelete::LoadById($this->lstAtheletes->SelectedRow->ActionParameter);
        if(is_null($objAthelete)){
            $objAthelete = new Athelete();
        }
        $objAthelete->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstAtheletes->SelectedRow->UpdateEntity(
            $objAthelete
        );
    }
}
