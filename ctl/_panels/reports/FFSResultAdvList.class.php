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
            //$colScore->RenderObject = $this;
            //$colScore->RenderFunction = $this;
        }
        $colScore = $this->AddColumn(
            'Total',
            'Total'
        );




    }
    public function SetDataEntites($arrDataEntites){

        //$this->strDataMode = MJaxTableDataMode::DATA_ENTITY;

        foreach($arrDataEntites as $objCollection){

            foreach($this->arrColumnTitles as $strKey => $objColumn){

                try{
                    $arrColumnData[$strKey] = $objCollection->$strKey;
                }catch(MLCMissingPropertyException $e) {}

            }
            $arrColumnData['_entity'] = $objCollection;
            $objRow = $this->AddRow($arrColumnData);
            $objRow->ActionParameter = $objCollection;
            //_dp($objRow);
        }
        $this->RefreshControls();
        $this->blnModified = true;

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

}
?>