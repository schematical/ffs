<?php
class results extends FFSForm{

    public $lstResults = null;


    public function Form_Create(){
        parent::Form_Create();
        $this->ForceLandscape();
        $arrAtheletes = FFSApplication::GetAtheletesByOrgManager();
        $arrResults = array();
        $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);
        foreach($arrAtheletes as $objAthelete){
            if(
                (is_null($intIdAthelete)) ||
                ($objAthelete->IdAthelete == $intIdAthelete)
            ){
                $arrIndResults = $objAthelete->GetResultArr();
                foreach($arrIndResults as $intIndex => $objResult){
                    //Unsanctioned
                    $arrResults[] = $objResult;
                }
            }
        }
        $collResults = Result::GroupByCompetition($arrResults);
        $this->lstResults = new FFSResultAdvList($this);
        $this->lstResults->EditMode = MJaxTableEditMode::NONE;
        $this->lstResults->AddColumn('Competition', 'Competition');

        $intIdCompetition = MLCApplication::QS(FFSQS::Competition_IdCompetition);


        $this->lstResults->SetDataEntites($collResults);
        if(!is_null($intIdCompetition)){
            foreach($this->lstResults->Rows as $objRow){
                if($objRow->GetData('_entity')->Competition->IdCompetition == $intIdCompetition){
                    $objRow->AddCssClass('info');

                }

            }
        }
        $wgtComp = $this->AddWidget(
            'Results',
            'icon-flag',
            $this->lstResults
        );
        $wgtComp->AddCssClass('span6');

        if(count($arrResults) == 0){
            $this->lstResults->Alert("You have no scores recorded yet");
        }




    }

    public function colEditScores_click($f, $c, $strActionParameter)
    {
        $this->Redirect(
            '/parent/scores',
            array(
                FFSQS::Competition_IdCompetition => $strActionParameter
            )
        );

    }
}
results::Run('results');