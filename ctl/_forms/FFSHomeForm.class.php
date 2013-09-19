<?php
abstract class FFSHomeForm extends FFSForm{

    public $lstComps = null;
    public $pnlComp = null;


    public function Form_Create(){
        parent::Form_Create();

        $arrAtheletes = $this->QueryAtheletes();
        $arrCompetition = array();
        foreach($arrAtheletes as $objAthelete){
            $arrResults = $objAthelete->GetResultArr();
            foreach($arrResults as $intIndex => $objResult){
                //Unsanctioned
                if(!is_null($objResult->IdCompetition)){
                    $arrCompetition[$objResult->IdCompetition] =  $objResult->IdCompetitionObject;
                }
            }
        }
        if(count($arrCompetition) > 0){
            $this->lstComps = new MJaxTable($this);
            $this->lstComps->AddCssClass('table table-striped table-bordered');
            $wgtComp = $this->AddWidget(
                'Competition List',
                'icon-flag',
                $this->lstComps
            );
            $this->lstComps->AddColumn('name','Name');
            $this->lstComps->RemoveColumn('IdOrgObject');
            $this->lstComps->RemoveColumn('idAuthUser');
            $this->lstComps->InitRowControl('colViewResults', 'View Results', $this, 'colViewResults_click');
            $this->lstComps->InitRowControl('colEditScores', 'Edit Scores', $this, 'colEditScores_click');
            $this->lstComps->SetDataEntites($arrCompetition);
            $wgtComp->AddCssClass('span6');
        }

        if(count($arrAtheletes) > 0){

            /*-----------Create new COmpetiton Panel-------------*/
            $this->pnlComp = new FFSParentCompSearchPanel($this);
            $wgtComp = $this->AddWidget(
                'Find  a competition',
                'icon-flag',
                $this->pnlComp
            );
            $wgtComp->AddCssClass('span6');
        }else{
            /*-----------Wizzard panel-------------*/
            $this->pnlComp = new FFSWizzardPanel(
                $this,
                'Start by adding your athletes',
                'Before we can go much further you need to add your athletes into our system. This will allow you to track scores for your team and even enroll your team into meets that are using TumbleScore to host their meet.',
                '/org/manageAthletes'
            );
            $wgtComp = $this->AddWidget(
                'Find  a competition',
                'icon-flag',
                $this->pnlComp
            );
            $wgtComp->AddCssClass('span6');
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
    public function colViewResults_click($f, $c, $strAP){

        $this->CPRedirect(
            '/results',
            array(
                FFSQS::Competition_IdCompetition => $strAP
            )
        );
    }
    abstract public function QueryAtheletes();


}
