<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - ConnectTable()
* - txtSearch_change()
* - GetExtQuery()
* - GetValue()
* Classes list:
* - ResultSelectPanelBase extends MJaxPanel
*/
class ResultSelectPanelBase extends MJaxPanel {
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
    */
    public $txtSearch = null;
    public $tblResults = null;
    public $intIdResult = null;
    public $intIdSession = null;
    public $intIdAthelete = null;
    public $strScore = null;
    public $strJudge = null;
    public $intFlag = null;
    public $strEvent = null;
    public $txtDispDate_StartDate = null;
    public $txtDispDate_EndDate = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this->objForm->objJsonSearchDriver, '_searchResult');
        $this->txtSearch->Name = 'idResult';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdResult = new MJaxTextBox($this);
        $this->intIdResult->Attr('placeholder', "idResult");
        $this->intIdSession = new MJaxTextBox($this);
        $this->intIdSession->Attr('placeholder', "idSession");
        $this->intIdAthelete = new MJaxTextBox($this);
        $this->intIdAthelete->Attr('placeholder', "idAthelete");
        $this->strScore = new MJaxTextBox($this);
        $this->strScore->Attr('placeholder', "score");
        $this->strJudge = new MJaxTextBox($this);
        $this->strJudge->Attr('placeholder', "judge");
        $this->intFlag = new MJaxTextBox($this);
        $this->intFlag->Attr('placeholder', "flag");
        $this->strEvent = new MJaxTextBox($this);
        $this->strEvent->Attr('placeholder', "event");
        $this->txtDispDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtDispDate_StartDate->DateOnly();
        $this->txtDispDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtDispDate_EndDate->DateOnly();
    }
    public function ConnectTable($tblResults) {
        $this->tblResults = $tblResults;
        //$this->tblResults = new ResultListPanel($this);
        $this->tblResults->AddColumn('selected', '');
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (class_exists($arrParts[0])) {
            $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
        }
        $arrResults = array();
        switch (get_class($objEntity)) {
            case ('Result'):
                $arrResults = array(
                    $objEntity
                );
            break;
            case ('Session'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idSession = %s', $objEntity->IdSession);
                $arrResults = Result::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Athelete'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idAthelete = %s', $objEntity->IdAthelete);
                $arrResults = Result::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        if (!is_null($this->tblResults)) {
            $this->tblResults->RemoveAllChildControls();
            $this->tblResults->SetDataEntites($arrResults);
            foreach ($this->tblResults->Rows as $intIndex => $objRow) {
                $chkSelected = new MJaxCheckBox($this);
                $chkSelected->Checked = true;
                $objRow->AddData($chkSelected, 'selected');
            }
        }
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strScore->GetValue())) {
            $arrAndConditions[] = sprintf('score LIKE "%s%%"', $this->strScore->GetValue());
        }
        if (!is_null($this->strJudge->GetValue())) {
            $arrAndConditions[] = sprintf('judge LIKE "%s%%"', $this->strJudge->GetValue());
        }
        if (!is_null($this->intFlag->GetValue())) {
            $arrAndConditions[] = sprintf('flag LIKE "%s%%"', $this->intFlag->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (!is_null($this->strEvent->GetValue())) {
            $arrAndConditions[] = sprintf('event LIKE "%s%%"', $this->strEvent->GetValue());
        }
        //Is special field!!!!!
        if (!is_null($this->txtDispDate_StartDate->GetValue())) {
            if (is_null($this->txtDispDate_EndDate->GetValue())) {
                $this->txtDispDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(dispDate > "%s" AND dispDate < "%s")', $this->txtDispDate_StartDate->GetValue() , $this->txtDispDate_EndDate->GetValue());
            }
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        $arrResults = array();
        foreach ($this->tblResults->Rows as $intIndex => $objRow) {
            $chkSelected = $objRow->GetData('selected');
            if ($chkSelected->Checked) {
                $arrResults[] = $objRow->GetData('_entity');
            }
        }
        return $arrResults;
    }
    /*
    public function txtSearch_search($objRoute){
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchResults($strSearch, $arrData);
        die(
            json_encode(
                $arrData
            )
        );
    }
    public function SearchResults($strSearch, &$arrData){
        $arrAndConditions = $this->GetExtQuery();
        if(is_numeric($strSearch)){
            $arrAndConditions[] =  sprintf(
                '(Result.idResult)',
                strtolower($strSearch)
            );
        }else{
            $arrAndConditions[] = sprintf(
                '(name LIKE "%s%%" or namespace LIKE "%s%%")',
                strtolower($strSearch),
                strtolower($strSearch)
            );
        }
        $strQuery = ' WHERE ' . implode( ' AND ', $arrAndConditions);
        $arrResults = Result::Query(
            $strQuery
        );
        foreach($arrResults as $strKey => $objResult){
            //_dv($objResult-> getAllFields());
            $arrData[] = array(
                'value'=>'Result_' . $objResult->GetId(),
                'text'=>$objResult->__toString()
            );
        }
        return $arrData;
    }
    public function SearchOrg($strSearch, &$arrData){
        $arrAndConditions = array();
        $strJoin = '';
        if(is_numeric($strSearch)){
        }else{
            $arrAndConditions[] = sprintf(
                '(name LIKE "%s%%") GROUP BY clubNum',
                strtolower($strSearch)
            );
        }
        $strQuery = $strJoin . ' WHERE ' . implode( ' AND ', $arrAndConditions);
        $arrOrg = Org::Query(
            $strQuery
        );
        foreach($arrOrg as $strKey => $objOrg){
            $arrData[] = array(
                'value'=>'Org_' . $objOrg->GetId(),
                'text'=>'Gym:' . $objOrg->Name
            );
        }
        return $arrData;
    }
    */
}
