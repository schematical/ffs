<?php
class ResultManageFormBase extends FFSForm{
    public $lstResults = null;
    public $pnlEdit = null;
    public function Form_Create(){
        parent::Form_Create();

        $arrResults = $this->Query();
        $this->InitList($arrResults);
    }
    public function InitEditPanel($objResult = null){
        $this->pnlEdit = new ResultEditPanel($this, $objResult);
        $this->AddWidget(
            ((is_null($objResult))?'Create Result':'Edit Result'),
            'icon-edit',
            $this->pnlEdit
        );
    }
    public function InitList($arrResults){
        $this->lstResults = new ResultListPanel($this, $arrResults);

        $this->lstResults->AddAction(
            new MJaxTableEditInitEvent(),
            new MJaxServerControlAction($this, 'lstResult_editInit')
        );
        $this->lstResults->AddAction(
            new MJaxTableEditSaveEvent(),
            new MJaxServerControlAction($this, 'lstResult_editSave')
        );
        $this->AddWidget(
            'Results',
            'icon-ul',
            $this->lstResults
        );

    }
    public function lstResult_editInit(){
        //_dv($this->lstResults->SelectedRow);
    }
    public function lstResult_editSave(){
        $objResult = Result::LoadById($this->lstResults->SelectedRow->ActionParameter);
        if(is_null($objResult)){
            $objResult = new Result();
        }
        $objResult->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstResults->SelectedRow->UpdateEntity(
            $objResult
        );
    }
}
