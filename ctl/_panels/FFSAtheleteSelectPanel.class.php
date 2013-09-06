<?php
class FFSAtheleteSelectPanel extends MJaxPanel{
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
     */
    public $txtSearch = null;
    public $tblAtheletes = null;
    public $txtAdvStartDate = null;
    public $txtAdvEndDate = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this);
        $this->txtSearch->SetSearchEntity('athelete');


        $this->txtSearch->Name = 'idAthelete';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction($this, 'txtSearch_change')
        );
        $this->tblAtheletes = new AtheleteListPanel($this);
        $this->tblAtheletes->AddColumn('selected','');

        $this->txtAdvStartDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvStartDate->DateOnly();
        $this->txtAdvEndDate = new MJaxBSDateTimePicker($this);
        $this->txtAdvEndDate->DateOnly();
       
    }
    public function txtSearch_change(){
       /* $this->objForm->Alert(
            $this->txtSearch->Value . ' - ' . $this->txtSearch->Text
        );*/
        $objEntity = null;

        $arrParts = explode('_', $this->txtSearch->Value);
        if(class_exists($arrParts[0])){
            $objEntity = call_user_func(
                $arrParts[0] . '::LoadById',
                $arrParts[1]
            );
        }

        $arrAtheletes = array();
        switch(get_class($objEntity)){
            case('Athelete'):
                $arrAtheletes = array($objEntity);
            break;
            case('Org'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(
                    ' idOrg = %s',
                    $objEntity->IdOrg
                );
                $arrAtheletes = Athelete::Query(
                    ' WHERE ' . implode(' AND ', $arrAndConditions)
                );
            break;
            default:array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }


        $this->tblAtheletes->RemoveAllChildControls();
        $this->tblAtheletes->SetDataEntites($arrAtheletes);
        foreach($this->tblAtheletes->Rows as $intIndex => $objRow){
            $chkSelected = new MJaxCheckBox($this);
            $chkSelected->Checked = true;
            $objRow->AddData($chkSelected , 'selected');
        }

    }
    public function GetExtQuery(){
        $arrAndConditions = array();
        if(!is_null($this->txtAdvStartDate->Value)){
            if(is_null($this->txtAdvEndDate->Value)){
                $this->txtAdvEndDate->Alert("Must have an end date to perform this function");

            }else{
                $arrAndConditions[] = sprintf(
                    '(birthDate > "%s" AND birthDate < "%s")',
                    $this->txtAdvStartDate->Text,
                    $this->txtAdvEndDate->Text
                );
            }
        }
        if(is_null($arrAndConditions)){
            throw new Excpetion("WTF?");
        }
        //_dv($arrAndConditions);
        return $arrAndConditions;
    }
    public function GetValue(){
        $arrAtheletes = array();
        foreach($this->tblAtheletes->Rows as $intIndex => $objRow){
            $chkSelected =  $objRow->GetData('selected');
            if($chkSelected->Checked){
                $arrAtheletes[] = $objRow->GetData('_entity');
            }
        }
        return $arrAtheletes;
    }
    public function txtSearch_search($objRoute){

        $strSearch = $_POST['search'];
        $arrData = array();
        $this->SearchOrg($strSearch, $arrData);
        $this->SearchAtheletes($strSearch, $arrData);

        die(
            json_encode(
                $arrData
            )
        );
    }
    public function SearchAtheletes($strSearch, &$arrData){
        $arrAndConditions = $this->GetExtQuery();
        $strJoin = 'JOIN Org ON Athelete.idOrg = Org.idOrg';
        if(is_numeric($strSearch)){
            $arrAndConditions[] =  sprintf(
                '(Athelete.idAthelete = %s OR Athelete.memId = %s)',
                strtolower($strSearch),
                strtolower($strSearch)
            );
        }else{
            $arrAndConditions[] = sprintf(
                '(Athelete.firstName LIKE "%s%%" or Athelete.lastName LIKE "%s%%" OR Org.name LIKE "%s%%")',
                strtolower($strSearch),
                strtolower($strSearch),
                strtolower($strSearch)
            );
        }
        $strQuery = $strJoin . ' WHERE ' . implode( ' AND ', $arrAndConditions);
        $arrAtheletes = Athelete::Query(
            $strQuery
        );
        foreach($arrAtheletes as $strKey => $objAthelete){
            //_dv($objAthelete-> getAllFields());
            $arrData[] = array(
                'value'=>'Athelete_' . $objAthelete->GetId(),
                'text'=>$objAthelete->LastName . ', ' . $objAthelete->FirstName . ' - ' . $objAthelete-> getAllFields()['name']
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


}