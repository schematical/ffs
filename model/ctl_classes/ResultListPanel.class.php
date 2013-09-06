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

        $colSession = new MJaxBSTableColumn(
            $this,
            'IdSessionObject',
            'Session'
        );
        $colSession->SearchEntity = 'session';

        $this->AddColumn(
            'IdSessionObject',
            $colSession
        );

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


        //SCORE--------------------------------------------
        $colScore = $this->AddColumn('score','Score');
        $colScore->EditControlClass = 'MJaxTextBox';
        $colScore->Editable = true;

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
            


        
            
            
        $colFlag = $this->AddColumn('flag','flag');
        $colFlag->EditControlClass = 'MJaxCheckBox';
        $colFlag->Editable = true;







            

            
        
    }

}
?>