<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - ResultListPanel extends ResultListPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/ResultListPanelBase.class.php");
class FFSResultAdvList extends ResultListPanelBase {
    protected $arrResultEvents = array();//TODO: Make this dynamic
    public function __construct($objParentControl, $arrResults = array()) {
        //TODO: FIX This is hack
        $this->arrResultEvents = FFSEventData::$WOMENS_ARTISTIC_GYMNASTICS;
        parent::__construct($objParentControl, $arrResults);

        $this->AddCssClass('table table-striped table-bordered table-condensed');
        $this->strEditMode = MJaxTableEditMode::INLINE;
        $this->AddAction(
            new MJaxTableColBlurEvent(),
            new MJaxServerControlAction(
                $this,
                '_colBlur'
            )
        );
        $this->AddAction(
            new MJaxTableRowBlurEvent(),
            new MJaxServerControlAction(
                $this,
                '_rowBlur'
            )
        );



    }

    public function SetupCols(){
        $colAthelete = new MJaxBSTableColumn(
            $this,
            'Athelete',
            'Athlete'
        );
        $colAthelete->SearchEntity = 'athelete';

        $this->AddColumn(
            'Athelete',
            $colAthelete
        );

        foreach($this->arrResultEvents as  $strEventKey => $strEventName){
            $colScore = $this->AddColumn(
                $strEventKey,
                $strEventName
            );

            $colScore->RenderObject = $this;
            $colScore->RenderFunction = 'colScore_render';
        }
        $colScoreAA = $this->AddColumn(
            'aa',
            'Total'
        );
        $colScoreAA->RenderObject = $this;
        $colScoreAA->RenderFunction = 'colScoreAA_render';





    }
    public function colScoreAA_render($strData, $objRow, $objCol){
        $collAtheleteResults =  $objRow->GetData('_entity');
        $strNSPlace = null;
        if(is_null($collAtheleteResults)){
            return '';
        }
        //TODO: Figure out placing
        return $collAtheleteResults->Total;
    }
    public function colScore_render($strData, $objRow, $objCol){
        $collAtheleteResults =  $objRow->GetData('_entity');
        $strNSPlace = null;
        if(is_null($collAtheleteResults)){
            return '';
        }
        foreach($collAtheleteResults as $strKey => $objResult){
            if(
                ($objResult->Event == $objCol->Key) &&
                (!is_null($objResult->NSPlace))
            ){
                $strNSPlace = $objResult->NSPlace;
            }
        }
        if(!is_null($strNSPlace)){
            return sprintf(
                '%s<div class="ffs-report-place">%s</div>',
                $strData,
                $strNSPlace

            );
        }
        return $strData;

    }
    public function SetDataEntites($arrDataEntites){

        //$this->strDataMode = MJaxTableDataMode::DATA_ENTITY;

        foreach($arrDataEntites as $objCollection){
            $arrColumnData = array();
            foreach($this->arrColumnTitles as $strKey => $objColumn){

                try{
                    $arrColumnData[$strKey] = $objCollection->$strKey;
                }catch(MLCMissingPropertyException $e) {

                }

            }
            $arrColumnData['_entity'] = $objCollection;
            $objRow = $this->AddRow($arrColumnData);
            $objRow->ActionParameter = $objCollection;
            //_dp($objRow);
        }
        $this->RefreshControls();
        $this->blnModified = true;

    }
    public function SetTeamResultsByCompetitionAndAthelete($arrResultsByCompetition){
        if(!array_key_exists('Competition', $this->arrColumnTitles)){
            $this->AddColumn('Competition', 'Competition');
        }
        foreach($arrResultsByCompetition as $intIdCompetition => $arrCompResults){

            $arrAllAtheleteResults = Result::GroupByAthelete($arrCompResults);

            foreach($arrAllAtheleteResults as $intIdAthelete => $arrAtheleteResults){

                $arrAtheleteResults->Competition = $arrCompResults->Competition;
                $objRow = $this->AddRow();
                $objRow->SetData('Competition', $arrAtheleteResults->Competition);
                $objRow->SetData('Athelete', $arrAtheleteResults->Athelete);
                foreach($this->arrResultEvents as $strEventKey => $strName){
                    $fltScore =  $arrAtheleteResults->GetScoreByEvent($strEventKey);
                    //error_log($strEventKey . ' - '  . $arrAtheleteResults->Athelete->__toString() . ' - ' . $fltScore);
                    $objRow->SetData($strEventKey,$fltScore);
                }
                $intTotal = $arrAtheleteResults->GetTotal();
                $objRow->SetData('aa', $intTotal);
                $objRow->SetData('_entity', $arrAtheleteResults);
            }
        }
    }
    public function _rowBlur(){
        if(
            (!is_null($this->rowSelected)) &&
            (is_null($this->rowNewSelected)) &&
            (!is_null($this->rowSelected->GetData('_saved')))
        ){
            $this->AddEmptyRow();
        }
    }
    public function AddEmptyRow(){
        $objResult = new Result();//Result::LoadById(1194);
        $objResult->CreDate = MLCDateTime::Now();
        $objSession = $this->objForm->EntityManager->Session();
        if(!is_null($objSession)){
            $objResult->IdSession = $objSession->IdSession;
        }

        $objAthelete = $this->objForm->EntityManager->Athelete();
        if(!is_null($objAthelete)){
            $objResult->IdSession = $objAthelete->IdAthelete;
        }
        parent::AddEmptyRow();
        $this->rowSelected->UpdateRow($objResult);
        $this->rowSelected->SetData('_entity', $objResult);

    }
    public function _colBlur($strFormId, $strControlId, $mixActionParameter){
        if(!is_null($this->rowSelected)){
            $objResult = $this->rowSelected->GetData('_entity');
            $this->rowSelected->UpdateEntity($objResult);
            $this->rowSelected->SetData('_saved', 'true');
        }
    }

    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName)
    {
        switch ($strName) {
            case "ResultEvents":
                return $this->arrResultEvents;
            default:
                return parent::__get($strName);
            //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue)
    {
        switch ($strName) {
            case "ResultEvents":
                return $this->arrResultEvents = $mixValue;
            default:
                return parent::__set($strName, $mixValue);
            //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }

}
?>