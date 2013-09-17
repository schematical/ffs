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
        )->AddCssClass('span6');

        $this->pnlCompetition->AddAction(
            new MJaxSuccessEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlCompetition_success'
            )
        );
        if(!is_null(FFSForm::Competition())){

        }
    }
    public function pnlCompetition_success($strFormId, $strControlId, $objCompetition){
        if(FFSForm::Org()->IdOrg == $objCompetition->IdOrg){
            $objCompetition->sanctioned = true;
            $objCompetition->Save();
        }
        $this->Redirect(
            '/' . $objCompetition->Namespace . '/org/competition/index'
        );
    }
}
editCompetition::Run('editCompetition');