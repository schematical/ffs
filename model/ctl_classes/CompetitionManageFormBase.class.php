<?php
class CompetitionManageFormBase extends FFSForm{
    public $lstCompetitions = null;
    public $pnlEdit = null;
    public function Form_Create(){
        parent::Form_Create();

        $arrCompetitions = $this->Query();
        $this->InitList($arrCompetitions);
    }
    public function InitEditPanel($objCompetition = null){
        $this->pnlEdit = new CompetitionEditPanel($this, $objCompetition);
        $this->AddWidget(
            ((is_null($objCompetition))?'Create Competition':'Edit Competition'),
            'icon-edit',
            $this->pnlEdit
        );
    }
    public function InitList($arrCompetitions){
        $this->lstCompetitions = new CompetitionListPanel($this, $arrCompetitions);

        $this->lstCompetitions->AddAction(
            new MJaxTableEditInitEvent(),
            new MJaxServerControlAction($this, 'lstCompetition_editInit')
        );
        $this->lstCompetitions->AddAction(
            new MJaxTableEditSaveEvent(),
            new MJaxServerControlAction($this, 'lstCompetition_editSave')
        );
        $this->AddWidget(
            'Competitions',
            'icon-ul',
            $this->lstCompetitions
        );

    }
    public function lstCompetition_editInit(){
        //_dv($this->lstCompetitions->SelectedRow);
    }
    public function lstCompetition_editSave(){
        $objCompetition = Competition::LoadById($this->lstCompetitions->SelectedRow->ActionParameter);
        if(is_null($objCompetition)){
            $objCompetition = new Competition();
        }
        $objCompetition->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstCompetitions->SelectedRow->UpdateEntity(
            $objCompetition
        );
    }
}
