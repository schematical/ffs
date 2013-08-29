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
* - EnrollmentSelectPanelBase extends MJaxPanel
*/
class EnrollmentSelectPanelBase extends MJaxPanel {
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
    */
    public $txtSearch = null;
    public $tblEnrollments = null;
    public $intIdEnrollment = null;
    public $intIdAthelete = null;
    public $intIdCompetition = null;
    public $intIdSession = null;
    public $strFlight = null;
    public $strDivision = null;
    public $strAgeGroup = null;
    public $strMisc1 = null;
    public $strMisc2 = null;
    public $strMisc3 = null;
    public $strMisc4 = null;
    public $strMisc5 = null;
    public $strLevel = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this->objForm->objJsonSearchDriver, '_searchEnrollment');
        $this->txtSearch->Name = 'idEnrollment';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdEnrollment = new MJaxTextBox($this);
        $this->intIdEnrollment->Attr('placeholder', "idEnrollment");
        $this->intIdAthelete = new MJaxTextBox($this);
        $this->intIdAthelete->Attr('placeholder', "idAthelete");
        $this->intIdCompetition = new MJaxTextBox($this);
        $this->intIdCompetition->Attr('placeholder', "idCompetition");
        $this->intIdSession = new MJaxTextBox($this);
        $this->intIdSession->Attr('placeholder', "idSession");
        $this->strFlight = new MJaxTextBox($this);
        $this->strFlight->Attr('placeholder', "flight");
        $this->strDivision = new MJaxTextBox($this);
        $this->strDivision->Attr('placeholder', "division");
        $this->strAgeGroup = new MJaxTextBox($this);
        $this->strAgeGroup->Attr('placeholder', "ageGroup");
        $this->strMisc1 = new MJaxTextBox($this);
        $this->strMisc1->Attr('placeholder', "misc1");
        $this->strMisc2 = new MJaxTextBox($this);
        $this->strMisc2->Attr('placeholder', "misc2");
        $this->strMisc3 = new MJaxTextBox($this);
        $this->strMisc3->Attr('placeholder', "misc3");
        $this->strMisc4 = new MJaxTextBox($this);
        $this->strMisc4->Attr('placeholder', "misc4");
        $this->strMisc5 = new MJaxTextBox($this);
        $this->strMisc5->Attr('placeholder', "misc5");
        $this->strLevel = new MJaxTextBox($this);
        $this->strLevel->Attr('placeholder', "level");
    }
    public function ConnectTable($tblEnrollments) {
        $this->tblEnrollments = $tblEnrollments;
        //$this->tblEnrollments = new EnrollmentListPanel($this);
        $this->tblEnrollments->AddColumn('selected', '');
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (class_exists($arrParts[0])) {
            $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
        }
        $arrEnrollments = array();
        switch (get_class($objEntity)) {
            case ('Enrollment'):
                $arrEnrollments = array(
                    $objEntity
                );
            break;
            case ('Athelete'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idAthelete = %s', $objEntity->IdAthelete);
                $arrEnrollments = Enrollment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Competition'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idCompetition = %s', $objEntity->IdCompetition);
                $arrEnrollments = Enrollment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Session'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idSession = %s', $objEntity->IdSession);
                $arrEnrollments = Enrollment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        if (!is_null($this->tblEnrollments)) {
            $this->tblEnrollments->RemoveAllChildControls();
            $this->tblEnrollments->SetDataEntites($arrEnrollments);
            foreach ($this->tblEnrollments->Rows as $intIndex => $objRow) {
                $chkSelected = new MJaxCheckBox($this);
                $chkSelected->Checked = true;
                $objRow->AddData($chkSelected, 'selected');
            }
        }
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strFlight->GetValue())) {
            $arrAndConditions[] = sprintf('flight LIKE "%s%%"', $this->strFlight->GetValue());
        }
        if (!is_null($this->strDivision->GetValue())) {
            $arrAndConditions[] = sprintf('division LIKE "%s%%"', $this->strDivision->GetValue());
        }
        if (!is_null($this->strAgeGroup->GetValue())) {
            $arrAndConditions[] = sprintf('ageGroup LIKE "%s%%"', $this->strAgeGroup->GetValue());
        }
        if (!is_null($this->strMisc1->GetValue())) {
            $arrAndConditions[] = sprintf('misc1 LIKE "%s%%"', $this->strMisc1->GetValue());
        }
        if (!is_null($this->strMisc2->GetValue())) {
            $arrAndConditions[] = sprintf('misc2 LIKE "%s%%"', $this->strMisc2->GetValue());
        }
        if (!is_null($this->strMisc3->GetValue())) {
            $arrAndConditions[] = sprintf('misc3 LIKE "%s%%"', $this->strMisc3->GetValue());
        }
        if (!is_null($this->strMisc4->GetValue())) {
            $arrAndConditions[] = sprintf('misc4 LIKE "%s%%"', $this->strMisc4->GetValue());
        }
        if (!is_null($this->strMisc5->GetValue())) {
            $arrAndConditions[] = sprintf('misc5 LIKE "%s%%"', $this->strMisc5->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (!is_null($this->strLevel->GetValue())) {
            $arrAndConditions[] = sprintf('level LIKE "%s%%"', $this->strLevel->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        $arrEnrollments = array();
        foreach ($this->tblEnrollments->Rows as $intIndex => $objRow) {
            $chkSelected = $objRow->GetData('selected');
            if ($chkSelected->Checked) {
                $arrEnrollments[] = $objRow->GetData('_entity');
            }
        }
        return $arrEnrollments;
    }
    /*
    public function txtSearch_search($objRoute){
        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchEnrollments($strSearch, $arrData);
        die(
            json_encode(
                $arrData
            )
        );
    }
    public function SearchEnrollments($strSearch, &$arrData){
        $arrAndConditions = $this->GetExtQuery();
        if(is_numeric($strSearch)){
            $arrAndConditions[] =  sprintf(
                '(Enrollment.idEnrollment)',
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
        $arrEnrollments = Enrollment::Query(
            $strQuery
        );
        foreach($arrEnrollments as $strKey => $objEnrollment){
            //_dv($objEnrollment-> getAllFields());
            $arrData[] = array(
                'value'=>'Enrollment_' . $objEnrollment->GetId(),
                'text'=>$objEnrollment->__toString()
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
