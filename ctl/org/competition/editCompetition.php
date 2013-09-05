<?php
class editCompetition extends FFSForm{
    public $pnlCompetition = null;
    public function Form_Create(){
        parent::Form_Create();
        $this->pnlCompetition = new CompetitionEditPanel($this, FFSForm::Competition());
        $this->AddWidget(
            (is_null(FFSForm::Competition())?'Create Competition':'Edit Competition'),
            'icon-cog',
            $this->pnlCompetition
        );
        if(!is_null(FFSForm::Competition())){

        }
    }
}
editCompetition::Run('editCompetition');