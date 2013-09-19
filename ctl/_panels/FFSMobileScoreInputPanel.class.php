<?php
class FFSMobileScoreInputPanel extends MJaxPanel{

    public $strAllAroundScore = null;

    public $lstSpecialNotes = null;
    public $lstAtheletes = null;
    public $objSelAthelete = null;

    public $arrTabs = array();
    public $strSelEvent = null;

    public $txtScore = null;
    public $txtStartValue = null;
    public $txtNotes = null;
    public $lstPlace = null;
    public $chkTied = null;

    public $arrNumberKeys = array();

    public $objResult = null;
    protected $objSelCompetition = null;



    public function __construct($objParentControl, $strControlId = null, $objCompetition){
        parent::__construct($objParentControl, $strControlId);
        $this->objSelCompetition = $objCompetition;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->lstAtheletes = new MJaxBSListBox($this);
        $this->lstAtheletes->Text = 'Change Athletes';
        $this->lstAtheletes->lnkPrimary->AddCssClass('btn-large');
        $this->lstAtheletes->AddItem('Add more Athletes', -1);
        $this->lstAtheletes->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'lstAtheletes_change'
            )
        );

        $this->lstSpecialNotes = new MJaxBSListBox($this, 'ffs-special-notes');
        $this->lstSpecialNotes->Text = "Special Notes";
        $this->lstSpecialNotes->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'lstSpecialNotes_change'
            )
        );



        $this->lstSpecialNotes->AddItem(
            FFSResultSpecialNotes::Stuck,
            FFSResultSpecialNotes::Stuck
        );
        $this->lstSpecialNotes->AddItem(
            FFSResultSpecialNotes::Solid,
            FFSResultSpecialNotes::Solid
        );
        $this->lstSpecialNotes->AddItem(
            FFSResultSpecialNotes::Average,
            FFSResultSpecialNotes::Average
        );
        $this->lstSpecialNotes->AddItem(
            FFSResultSpecialNotes::Wobbly,
            FFSResultSpecialNotes::Wobbly
        );
        $this->lstSpecialNotes->AddItem(
            FFSResultSpecialNotes::Fall,
            FFSResultSpecialNotes::Fall
        );

        $this->txtScore = new MJaxTextBox($this, 'ffs-score-input');
        $this->txtScore->AddCssClass('input-large');
        $this->txtScore->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'SaveState'
            )
        );



        $this->txtStartValue = new MJaxTextBox($this);
        $this->txtStartValue->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'SaveState'
            )
        );

        $this->txtNotes  = new MJaxTextBox($this);
        $this->txtNotes->TextMode = MJaxTextMode::MultiLine;
        $this->txtNotes->AddCssClass('span12 ffs-score-notes');
        $this->txtNotes->Attr('placeholder','Notes');
        $this->txtNotes->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'SaveState'
            )
        );

        $this->lstPlace = new MJaxListBox($this);
        $this->lstPlace->AddCssClass('ffs-list-place');
        $this->lstPlace->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'SaveState'
            )
        );
        $this->lstPlace->AddItem("Not Set", null);
        for($i = 1; $i < 25; $i ++){
            $this->lstPlace->AddItem($i, $i);
        }


        $this->chkTied = new MJaxCheckBox($this);
        $this->chkTied->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'SaveState'
            )
        );

        $this->InitDialPad();

    }
    public function lstSpecialNotes_change(){
        $this->SaveState();
        $this->lstSpecialNotes->Text = $this->lstSpecialNotes->lnkSelOption->Text;
        $this->lstSpecialNotes->lnkPrimary->AddCssClass('btn-success');
    }
    public function InitDialPad(){
        for($i = -2; $i < 10; $i++){
            $this->arrNumberKeys[$i] = new MJaxLinkButton($this);
            $this->arrNumberKeys[$i]->AddCssClass('btn');
            switch($i){
                case(-2):
                    $strAP = 'del';
                    $strText = "<i class=' icon-arrow-lef'></i><i class=' icon-remove'></i>";
                break;
                case(-1):
                    $strAP = '.';
                    $strText = '.';
                break;
                default:
                    $strText = $i;
                    $strAP = $i;
            }
            $this->arrNumberKeys[$i]->Text = $strText;
            $this->arrNumberKeys[$i]->ActionParameter = $strAP;
            $this->arrNumberKeys[$i]->AddAction(
                $this,
                'lnkKeyPad_click'
            );
        }
    }

    public function lnkKeyPad_click($f, $c,$strActionParam){
        $strActionParam = (string) $strActionParam;
        switch($strActionParam){
            case('del'):

                $strScore  = $this->txtScore->Text;
                if(strlen($strScore) > 0){
                    $this->txtScore->Text = substr($strScore, 0, strlen($strScore)-1);
                    $this->SaveState();
                }
            break;
            case('.'):
                if(strpos($this->txtScore->Text,'.') !== false){
                    return $this->txtScore->Alert('Invalid number entered');
                }
            default:
                $strScore  = $this->txtScore->Text;
               /* if($strActionParam == 0){
                    _dv((string)$strScore . (string)$strActionParam);
                }*/
                $this->txtScore->Text = (string)$strScore . (string)$strActionParam;
                $this->SaveState();

        }
    }
    public function SaveState(){
        //Save Score

        //Save SpecialNotes

        //Save notes

        //Save Start Score

        //Save Place

        //Save Tied

        $this->objResult->Score = $this->txtScore->Text;
        $this->objResult->NSSpecialNotes = $this->lstSpecialNotes->GetValue();
        $this->objResult->NSStartValue = $this->txtStartValue->Text;
        $this->objResult->Notes = $this->txtNotes->Text;
        $this->objResult->NSPlace = $this->lstPlace->SelectedValue;
        $this->objResult->NSTied = $this->chkTied->Checked;
        $this->objResult->Save();
    }
    public function UpdateResult(){
        $arrResults = FFSApplication::GeResultByCompetitionAthelete(
            $this->objSelCompetition,
            $this->objSelAthelete,
            false
        );

        $this->objResult = null;
        foreach($arrResults as $objResult){
            error_log($objResult->Event . '==' . $this->strSelEvent);
            if($objResult->Event == $this->strSelEvent){
                $this->objResult = $objResult;//$arrResults[$this->strSelEvent];
            }
        }

        if(is_null($this->objResult)){
            $this->objResult = new Result();
            $this->objResult->sanctioned = false;
            $this->objResult->Event = $this->strSelEvent;
            $this->objResult->IdAthelete = $this->objSelAthelete->IdAthelete;
            $this->objResult->IdCompetition = $this->objSelCompetition->IdCompetition;
            $this->objResult->CreDate = MLCDateTime::Now();
            $this->objResult->Save();
        }
        $this->txtScore->Text = $this->objResult->Score;
        $this->txtStartValue->Text = $this->objResult->NSStartValue;
        $this->txtNotes->Text = $this->objResult->Notes;
        $this->lstPlace->SetValue($this->objResult->NSPlace);
        if(is_null($this->objResult->NSTied)){
            $this->chkTied->Checked = false;
        }else{
            $this->chkTied->Checked = $this->objResult->NSTied;
        }
        $this->lstSpecialNotes->SetValue($this->objResult->NSSpecialNotes);
        $intTotal = 0;
        foreach($arrResults as $objResult){
            $intTotal += (double)$objResult->Score;
        }
        $this->strAllAroundScore = $intTotal;
        $this->objForm->ReplaceWith(
            '#ffs-athelete-aa-score',
            sprintf(
                "<div id='ffs-athelete-aa-score'>%s</div>",
                $this->strAllAroundScore
            )
        );
    }
    public function SetAtheletes($arrAtheletes){
        $this->objSelAthelete = $arrAtheletes[0];
        foreach($arrAtheletes as $objAthelete){
            $this->lstAtheletes->AddItem(
                $objAthelete->__toString(),
                $objAthelete
            );
        }
        if(!is_null($this->objSelAthelete)){
            $strEventDef = $this->objSelAthelete->Event_default;
            if(is_null($strEventDef) || strlen($strEventDef) < 1){
                $strEventDef = 'WOMENS_ARTISTIC_GYMNASTICS';
            }
            $arrEventData = FFSEventData::$$strEventDef;
            $this->SetEvents($arrEventData);
        }
    }
    public function SetEvents($arrEventData){
        foreach($this->arrTabs as $intIndex => $lnkTab){
            $lnkTab->Remove();
            unset($this->arrTabs[$intIndex]);
        }
        foreach($arrEventData as $strKey => $strName){
            if(is_null($this->strSelEvent)){
                $this->strSelEvent = $strKey;
            }
            $lnkTab = new MJaxLinkButton($this);
            $lnkTab->Text = $strName;

            $lnkTab->ActionParameter = $strKey;


            $lnkTab->Href = '#' . $this->strControlId . '_tab-content';
            $lnkTab->AddAction(
                $this,
                'lnkTab_click'
            );
            $this->arrTabs[] = $lnkTab;
        }
        $this->UpdateResult();
    }
    public function lnkTab_click($f, $c, $strEvent){
        $this->SaveState();
        $this->strSelEvent = $strEvent;
        $this->objForm->AddJSCall(
            sprintf(
                '$("#%s").tab("show");',
                $c
            )
        );
        $this->UpdateResult();
    }
    public function lstAtheletes_change(){
        $objAthelete = $this->lstAtheletes->GetValue();
        if(
            (!is_object($objAthelete)) &&
            ($objAthelete === -1)
        ){

            return $this->objForm->CPRedirect('/manageAthletes');

        }
        $this->objSelAthelete = $objAthelete;
        $this->objForm->ReplaceWith(
            '#ffs-athelete-name',
            sprintf(
                "<h3 id='ffs-athelete-name'>%s</h3>",
                $this->objSelAthelete->__toString()
            )
        );

        $this->UpdateResult();
    }
    
}