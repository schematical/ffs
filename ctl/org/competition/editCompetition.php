<?php
class editCompetition extends FFSForm{
    public $pnlCompetition = null;
    public function Form_Create(){
        parent::Form_Create();
        $this->pnlCompetition = new CompetitionEditPanel($this, FFSForm::$objCompetition);
        $this->AddWidget(
            (is_null(FFSForm::$objCompetition)?'Create Competition':'Edit Competition'),
            'icon-cog',
            $this->pnlCompetition
        );
        if(!is_null(FFSForm::$objCompetition)){

        }
    }
}
editCompetition::Run('editCompetition');