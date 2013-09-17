<?php
class FFSMobileScoreInputPanel extends MJaxPanel{

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

    public $objResult = null;
    protected $objSelCompetition = null;


    public function __construct($objParentControl, $strControlId = null, $objCompetition){
        parent::__construct($objParentControl, $strControlId);
        $this->objSelCompetition = $objCompetition;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->lstAtheletes = new MJaxBSListBox($this);
        $this->lstAtheletes->Text = 'Your Athletes';
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
                'SaveState'
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
            FFSResultSpecialNotes::Averedge,
            FFSResultSpecialNotes::Averedge
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
        $this->objResult = FFSApplication::GeResultByCompetitionEventAthelete(
            $this->objSelCompetition,
            $this->strSelEvent,
            $this->objSelAthelete,
            false
        );
        if(is_null($this->objResult)){
            $this->objResult = new Result();
            $this->objResult->sanctioned = false;
            $this->objResult->Event = $this->strSelEvent;
            $this->objResult->IdAthelete = $this->objSelAthelete->IdAthelete;
            $this->objResult->IdCompetition = $this->objSelCompetition->IdCompetition;
        }
        $this->txtScore->Text = $this->objResult->Score;
        $this->txtStartValue->Text = $this->objResult->NSStartValue;
        $this->txtNotes->Text = $this->objResult->Notes;
        $this->lstPlace->SetValue($this->objResult->NSPlace);
        $this->chkTied->Checked = $this->objResult->NSTied;
        $this->lstSpecialNotes->SetValue($this->objResult->NSSpecialNotes);
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
            if(is_null($strEventDef)){
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
        $this->strSelEvent = $strEvent;
        $this->objForm->AddJSCall(
            sprintf(
                '$("#%s").tab("show");',
                $c
            )
        );
        $this->UpdateResult();
    }
    
}