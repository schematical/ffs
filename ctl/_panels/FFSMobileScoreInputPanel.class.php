<?php
class FFSMobileScoreInputPanel extends MJaxPanel{


    public $lstAtheletes = null;
    public $objSelAthelete = null;

    public $arrTabs = array();
    public $strSelEvent = null;


    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->lstAtheletes = new MJaxBSListBox($this);
        $this->lstAtheletes->Text = 'Your Athletes';

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
    }
    public function lnkTab_click($f, $c, $strEvent){
        $this->objForm->AddJSCall(
            sprintf(
                '$("#%s").tab("show");',
                $c
            )
        );
    }
    
}