<?php
class results extends FFSForm{
    public $arrResultEvents =  null;
    public $lstIndResults = null;
    public $lstTeamResults = null;
    public $lstLevel = null;


    public function Form_Create(){
        parent::Form_Create();
        $this->arrResultEvents = FFSEventData::$WOMENS_ARTISTIC_GYMNASTICS;//TMP HACK
        $this->ForceLandscape();
        $arrResults = $this->QueryAtheleteResults();
        $this->SetupTeam($arrResults);
        $this->SetupIndividual($arrResults);



    }
    public function QueryAtheleteResults(){
        $arrAtheletes = FFSApplication::GetAtheletesByOrgManager();
        $arrResults = array();
        $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);
        $intIdCompetition = MLCApplication::QS(FFSQS::Competition_IdCompetition);
        foreach($arrAtheletes as $objAthelete){
            if(
                (is_null($intIdAthelete)) ||
                ($objAthelete->IdAthelete == $intIdAthelete)
            ){
                $arrIndResults = $objAthelete->GetResultArr();
                foreach($arrIndResults as $intIndex => $objResult){
                    //Unsanctioned
                    if(
                        (is_null($intIdCompetition)) ||
                        ($objResult->IdCompetition == $intIdCompetition)
                    ){
                        $arrResults[] = $objResult;
                    }
                }
            }
        }
        return $arrResults;
    }
    public function SetupTeam($collResults){
        $this->lstTeamResults = new FFSResultTeamList($this);
        $this->lstTeamResults->ResultEvents = $this->arrResultEvents;




        $wgtComp = $this->AddWidget(
            'Team Results',
            'icon-flag',
            $this->lstTeamResults
        );
        $wgtComp->AddCssClass('span6');


        $arrAtheletes = FFSApplication::GetAtheletesByOrgManager();

        $intIdCompetition = MLCApplication::QS(FFSQS::Competition_IdCompetition);
        if(!is_null($intIdCompetition)){
            $objCompetition = Competition::LoadById($intIdCompetition);
            /*$collResults = Result::LoadByAtheleteCollAndCompetition(
                new MLCBaseEntityCollection(
                    $arrAtheletes
                ),
                $objCompetition
            );*/

            $arrResultsByLevel = Result::GroupByLevel($collResults);
            $this->lstTeamResults->SetTeamResultsByLevel($arrResultsByLevel);
        }else{
            /*$collResults = Result::LoadByAtheleteColl(
                new MLCBaseEntityCollection(
                    $arrAtheletes
                )
            );*/

            $arrResultsByComp = Result::GroupByCompetition($collResults);
            $this->lstTeamResults->SetTeamResultsByCompetitionAndLevel($arrResultsByComp);

        }


    }
    public function SetupIndividual($collResults){
        $this->lstIndResults = new FFSResultAdvList($this);
        $this->lstIndResults->ResultEvents = $this->arrResultEvents;
        $this->lstIndResults->EditMode = MJaxTableEditMode::NONE;


        $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);
        $intIdCompetition = MLCApplication::QS(FFSQS::Competition_IdCompetition);
        if(
            (!is_null($intIdCompetition)) &&
            (!is_null($intIdAthelete))
        ){
            $this->lstIndResults->AddColumn('Competition', 'Competition');
            $arrResults = Result::GroupByCompetition($collResults);

        }else{
            if(!is_null($intIdCompetition)){
                $arrResults = Result::GroupByAthelete($collResults);
                $this->lstIndResults->SetDataEntites($arrResults);
            }else{

                $arrResultsByComp = Result::GroupByCompetition($collResults);
                $this->lstIndResults->SetTeamResultsByCompetitionAndAthelete($arrResultsByComp);
            }
        }



        if(
            (!is_null($intIdCompetition)) &&
            (!is_null($intIdAthelete))
        ){
            foreach($this->lstIndResults->Rows as $objRow){
                if($objRow->GetData('_entity')->Competition->IdCompetition == $intIdCompetition){
                    $objRow->AddCssClass('info');
                }

            }
        }
        $wgtComp = $this->AddWidget(
            'Results',
            'icon-flag',
            $this->lstIndResults
        );
        $wgtComp->AddCssClass('span6');

        if(count($collResults) == 0){
            $this->lstIndResults->Alert("You have no scores recorded yet");
        }
    }

    public function colEditScores_click($f, $c, $strActionParameter)
    {
        $this->CPRedirect(
            '/scores',
            array(
                FFSQS::Competition_IdCompetition => $strActionParameter
            )
        );

    }
}
results::Run('results');