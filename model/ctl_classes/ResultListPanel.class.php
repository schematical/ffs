<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - ResultListPanel extends ResultListPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/ResultListPanelBase.class.php");
class ResultListPanel extends ResultListPanelBase {
    public function __construct($objParentControl, $arrResults = array()) {
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
            'IdAtheleteObject',
            'Athelete'
        );
        $colAthelete->SearchEntity = 'athelete';

        $this->AddColumn(
            'IdAtheleteObject',
            $colAthelete
        );

        /*$colSession = new MJaxBSTableColumn(
            $this,
            'IdSessionObject',
            'Session'
        );
        $colSession->SearchEntity = 'session';

        $this->AddColumn(
            'IdSessionObject',
            $colSession
        );*/



        //SCORE--------------------------------------------
        $colScore = $this->AddColumn('score','Score');
        $colScore->EditControlClass = 'MJaxTextBox';
        $colScore->Editable = true;


        $colEvent = new MJaxBSTableColumn(
            $this,
            'event',
            'Event'
        );
        $colEvent->SearchEntity = 'result';
        $colEvent->SearchField = 'event';

        $this->AddColumn(
            'event',
            $colEvent
        );

        //Judge
        $colJudge= new MJaxBSTableColumn(
            $this,
            'judge',
            'Judge'
        );
        $colJudge->SearchEntity = 'result';
        $colJudge->SearchField = 'judge';

        $this->AddColumn(
            'judge',
            $colJudge
        );

       /* $colFlag = $this->InitRowControl(
            'flag',
            null,
            null,
            '',
            'MJaxCheckBox'
        );
        $colFlag->EditControlClass = 'MJaxCheckBox';
       */
        //$colFlag->Editable = true;

        
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