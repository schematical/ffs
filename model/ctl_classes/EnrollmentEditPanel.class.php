<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - EnrollmentEditPanel extends EnrollmentEditPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/EnrollmentEditPanelBase.class.php");
class EnrollmentEditPanel extends EnrollmentEditPanelBase {

    public function __construct($objParentControl, $objEnrollment = null){
        parent::__construct($objParentControl, $objEnrollment);
        
            
            
        
            
                $this->InitidAtheleteAutocomplete();

                //$this->InitidCompetitionAutocomplete();
                //$this->InitidSessionAutocomplete();

                $this->InitFlightAutocomplete();
            
        
            
            
                $this->InitDivisionAutocomplete();
            
        
            
            
                $this->InitAgeGroupAutocomplete();
            
        
            

                $this->InitMisc1Autocomplete();
            
        
            
            
                $this->InitMisc2Autocomplete();
            
        
            
            
                $this->InitMisc3Autocomplete();
            
        
            
            
                $this->InitMisc4Autocomplete();
            
        
            
            
                $this->InitMisc5Autocomplete();
            
        

            
        
            
            
                $this->InitLevelAutocomplete();
            
        
    }
    public function SetEnrollment($objEnrollment){
        parent::SetEnrollment($objEnrollment);
        
        
        
        
            if(
                (!is_null($this->intIdAthelete)) &&
                (!is_null($this->objEnrollment->idAthelete))
            ){
                
                    $objAthelete = Athelete::LoadById(
                        $this->objEnrollment->idAthelete
                    );
                    $this->intIdAthelete->Text = $objAthelete;
                    $this->intIdAthelete->Value = $objAthelete->idAthelete;
                
                
            }
        
        
        
            if(
                (!is_null($this->intIdCompetition)) &&
                (!is_null($this->objEnrollment->idCompetition))
            ){
                
                    $objCompetition = Competition::LoadById(
                        $this->objEnrollment->idCompetition
                    );
                    $this->intIdCompetition->Text = $objCompetition->Name;
                    $this->intIdCompetition->Value = $objCompetition->idCompetition;
                
                
            }
        
        
        
            if(
                (!is_null($this->intIdSession)) &&
                (!is_null($this->objEnrollment->idSession))
            ){
                
                    $objSession = Session::LoadById(
                        $this->objEnrollment->idSession
                    );
                    $this->intIdSession->Text = $objSession->Name;
                    $this->intIdSession->Value = $objSession->idSession;
                
                
            }
        
        
        
            if(
                (!is_null($this->strFlight)) &&
                (!is_null($this->objEnrollment->flight))
            ){
                
                
                    $this->strFlight->Value = $this->strFlight->Text;
                
            }
        
        
        
            if(
                (!is_null($this->strDivision)) &&
                (!is_null($this->objEnrollment->division))
            ){
                
                
                    $this->strDivision->Value = $this->strDivision->Text;
                
            }
        
        
        
            if(
                (!is_null($this->strAgeGroup)) &&
                (!is_null($this->objEnrollment->ageGroup))
            ){
                
                
                    $this->strAgeGroup->Value = $this->strAgeGroup->Text;
                
            }
        
        
        
            if(
                (!is_null($this->strMisc1)) &&
                (!is_null($this->objEnrollment->misc1))
            ){
                
                
                    $this->strMisc1->Value = $this->strMisc1->Text;
                
            }
        
        
        
            if(
                (!is_null($this->strMisc2)) &&
                (!is_null($this->objEnrollment->misc2))
            ){
                
                
                    $this->strMisc2->Value = $this->strMisc2->Text;
                
            }
        
        
        
            if(
                (!is_null($this->strMisc3)) &&
                (!is_null($this->objEnrollment->misc3))
            ){
                
                
                    $this->strMisc3->Value = $this->strMisc3->Text;
                
            }
        
        
        
            if(
                (!is_null($this->strMisc4)) &&
                (!is_null($this->objEnrollment->misc4))
            ){
                
                
                    $this->strMisc4->Value = $this->strMisc4->Text;
                
            }
        
        
        
            if(
                (!is_null($this->strMisc5)) &&
                (!is_null($this->objEnrollment->misc5))
            ){
                
                
                    $this->strMisc5->Value = $this->strMisc5->Text;
                
            }
        
        
        
        
        
            if(
                (!is_null($this->strLevel)) &&
                (!is_null($this->objEnrollment->level))
            ){
                
                
                    $this->strLevel->Value = $this->strLevel->Text;
                
            }
        

    }
    public function btnSave_click() {
        //_dv($this->intIdAthelete->GetValue());
        if (is_null($this->objEnrollment)) {
                //Create a new one
                $this->objEnrollment = new Enrollment();
        }
        
            
        
            
                if(
                    (!is_null($this->intIdAthelete))
                ){
                    
                    $this->objEnrollment->idAthelete = $this->intIdAthelete->Value;
                    
                    
                }
            
        
            
                if(
                    (!is_null($this->intIdCompetition))
                ){
                    
                    $this->objEnrollment->idCompetition = $this->intIdCompetition->Value;
                    
                    
                }
            
        
            
                if(
                    (!is_null($this->intIdSession))
                ){
                    
                    $this->objEnrollment->idSession = $this->intIdSession->Value;
                    
                    
                }
            
        
            
                if(
                    (!is_null($this->strFlight))
                ){
                    
                    
                        $this->strFlight->Text = $this->strFlight->Value;
                    
                }
            

                if(
                    (!is_null($this->strDivision))
                ){
                    
                    
                        $this->strDivision->Text = $this->strDivision->Value;
                    
                }
            
        
            
                if(
                    (!is_null($this->strAgeGroup))
                ){
                    
                    
                        $this->strAgeGroup->Text = $this->strAgeGroup->Value;
                    
                }
            
        
            
                if(
                    (!is_null($this->strMisc1))
                ){
                    
                    
                        $this->strMisc1->Text = $this->strMisc1->Value;
                    
                }
            
        
            
                if(
                    (!is_null($this->strMisc2))
                ){
                    
                    
                        $this->strMisc2->Text = $this->strMisc2->Value;
                    
                }
            
        
            
                if(
                    (!is_null($this->strMisc3))
                ){
                    
                    
                        $this->strMisc3->Text = $this->strMisc3->Value;
                    
                }
            
        
            
                if(
                    (!is_null($this->strMisc4))
                ){
                    
                    
                        $this->strMisc4->Text = $this->strMisc4->Value;
                    
                }
            
        
            
                if(
                    (!is_null($this->strMisc5))
                ){
                    
                    
                        $this->strMisc5->Text = $this->strMisc5->Value;
                    
                }
            
        
            
        
            
                if(
                    (!is_null($this->strLevel))
                ){
                    
                    
                        $this->strLevel->Text = $this->strLevel->Value;
                    
                }
            
        
        parent::btnSave_click();
    }
    
        
    
/*
        
            public function InitidAtheleteAutocomplete(){
                
                $this->intIdAthelete = new FFSAtheleteSelectPanel($this);
                
                
                $this->intIdAthelete->Name = 'idAthelete';
                $this->intIdAthelete->AddCssClass('input-large');
            }
        
    
    
        
            public function InitidCompetitionAutocomplete(){
                
                $this->intIdCompetition = new MJaxBSAutocompleteTextBox($this);
                $this->intIdCompetition->SetSearchEntity('competition');
                
                
                $this->intIdCompetition->Name = 'idCompetition';
                $this->intIdCompetition->AddCssClass('input-large');
            }
        
    
    
        
            public function InitidSessionAutocomplete(){
                
                $this->intIdSession = new MJaxBSAutocompleteTextBox($this);
                $this->intIdSession->SetSearchEntity('session');
                
                $this->intIdSession->Name = 'idSession';
                $this->intIdSession->AddCssClass('input-large');
            }
        
    
    
        
            public function InitflightAutocomplete(){
                
                
                   $this->strFlight = new MJaxBSAutocompleteTextBox($this);
                $this->strFlight->SetSearchEntity('enrollment','flight');
                
                $this->strFlight->Name = 'flight';
                $this->strFlight->AddCssClass('input-large');
            }
        
    

        
            public function InitdivisionAutocomplete(){
                
                
                   $this->strDivision = new MJaxBSAutocompleteTextBox($this, $this, '_searchDivision');
                $this->strDivision->SetSearchEntity('enrollment','division');
                $this->strDivision->Name = 'division';
                $this->strDivision->AddCssClass('input-large');
            }
        
    
    
        
            public function InitageGroupAutocomplete(){
                
                
                   $this->strAgeGroup = new MJaxBSAutocompleteTextBox($this);
                $this->strDivision->SetSearchEntity('enrollment','ageGroup');
                $this->strAgeGroup->Name = 'ageGroup';
                $this->strAgeGroup->AddCssClass('input-large');
            }
        
    
    
        
            public function Initmisc1Autocomplete(){
                
                
                   $this->strMisc1 = new MJaxBSAutocompleteTextBox($this, $this, '_searchMisc1');
                
                $this->strMisc1->Name = 'misc1';
                $this->strMisc1->AddCssClass('input-large');
            }
        
    
    
        
            public function Initmisc2Autocomplete(){
                
                
                   $this->strMisc2 = new MJaxBSAutocompleteTextBox($this, $this, '_searchMisc2');
                
                $this->strMisc2->Name = 'misc2';
                $this->strMisc2->AddCssClass('input-large');
            }
        
    
    
        
            public function Initmisc3Autocomplete(){
                
                
                   $this->strMisc3 = new MJaxBSAutocompleteTextBox($this, $this, '_searchMisc3');
                
                $this->strMisc3->Name = 'misc3';
                $this->strMisc3->AddCssClass('input-large');
            }
        
    
    
        
            public function Initmisc4Autocomplete(){
                
                
                   $this->strMisc4 = new MJaxBSAutocompleteTextBox($this, $this, '_searchMisc4');
                
                $this->strMisc4->Name = 'misc4';
                $this->strMisc4->AddCssClass('input-large');
            }
        
    
    
        
            public function Initmisc5Autocomplete(){
                
                
                   $this->strMisc5 = new MJaxBSAutocompleteTextBox($this, $this, '_searchMisc5');
                
                $this->strMisc5->Name = 'misc5';
                $this->strMisc5->AddCssClass('input-large');
            }
        
    
    
        
    
    
        
            public function InitlevelAutocomplete(){
                
                
                   $this->strLevel = new MJaxBSAutocompleteTextBox($this, $this, '_searchLevel');
                
                $this->strLevel->Name = 'level';
                $this->strLevel->AddCssClass('input-large');
            }
        
    
    
    

    
    
    
    
    public function _searchAthelete($objRoute){
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
       if(!is_numeric($strSearch)){
            $arrAtheletes = Athelete::Query(
                    sprintf(
                      'WHERE firstName LIKE "%s%%" or lastName LIKE "%s%%"',
                      strtolower($strSearch),
                      strtolower($strSearch)
                  )
            );
       }else{
            $arrAtheletes = Athelete::Query(
                sprintf(
                    'WHERE idAthelete = %s OR memId = %s',
                    strtolower($strSearch),
                    strtolower($strSearch)
                )
            );
       }
        foreach($arrAtheletes as $strKey => $objAthelete){
            $arrData[$strKey] = array(
                   'value'=>$objAthelete->GetId(),
                   'text'=>$objAthelete->LastName . ', ' . $objAthelete->FirstName
            );
        }

       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    
    public function _searchCompetition($objRoute){
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
       
            $arrCompetitions = Competition::Query(
                    sprintf(
                      'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                      strtolower($strSearch),
                      strtolower($strSearch)
                  )
            );
            foreach($arrCompetitions as $strKey => $objCompetition){
                $arrData[$strKey] = array(
                       'value'=>$objCompetition->GetId(),
                       'text'=>$objCompetition->Name
                );
            }
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    
    public function _searchSession($objRoute){
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
       
            $arrSessions = Session::Query(
                    sprintf(
                      'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                      strtolower($strSearch),
                      strtolower($strSearch)
                  )
            );
            foreach($arrSessions as $strKey => $objSession){
                $arrData[$strKey] = array(
                       'value'=>$objSession->GetId(),
                       'text'=>$objSession->Name
                );
            }
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    public function _searchFlight($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrEnrollments = Enrollment::Query(
                sprintf(
                  'WHERE Flight LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrEnrollments as $strKey => $objEnrollment){
               $arrData[$strKey] = array(
                      'value'=>$objEnrollment->Flight,
                      'text'=>$objEnrollment->Flight
               );
           }
           if(count($arrData) == 0){
                $arrData[] = array(
                    'value'=> $strSearch,
                    'text'=> $strSearch
                );
           }
       
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    public function _searchDivision($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrEnrollments = Enrollment::Query(
                sprintf(
                  'WHERE Division LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrEnrollments as $strKey => $objEnrollment){
               $arrData[$strKey] = array(
                      'value'=>$objEnrollment->Division,
                      'text'=>$objEnrollment->Division
               );
           }
           if(count($arrData) == 0){
                $arrData[] = array(
                    'value'=> $strSearch,
                    'text'=> $strSearch
                );
           }
       
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    public function _searchAgeGroup($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();



           $arrEnrollments = Enrollment::Query(
                sprintf(
                  'WHERE AgeGroup LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrEnrollments as $strKey => $objEnrollment){
               $arrData[$strKey] = array(
                      'value'=>$objEnrollment->AgeGroup,
                      'text'=>$objEnrollment->AgeGroup
               );
           }
           if(count($arrData) == 0){
                $arrData[] = array(
                    'value'=> $strSearch,
                    'text'=> $strSearch
                );
           }
       
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    public function _searchMisc1($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrEnrollments = Enrollment::Query(
                sprintf(
                  'WHERE Misc1 LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrEnrollments as $strKey => $objEnrollment){
               $arrData[$strKey] = array(
                      'value'=>$objEnrollment->Misc1,
                      'text'=>$objEnrollment->Misc1
               );
           }
           if(count($arrData) == 0){
                $arrData[] = array(
                    'value'=> $strSearch,
                    'text'=> $strSearch
                );
           }
       
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    public function _searchMisc2($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrEnrollments = Enrollment::Query(
                sprintf(
                  'WHERE Misc2 LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrEnrollments as $strKey => $objEnrollment){
               $arrData[$strKey] = array(
                      'value'=>$objEnrollment->Misc2,
                      'text'=>$objEnrollment->Misc2
               );
           }
           if(count($arrData) == 0){
                $arrData[] = array(
                    'value'=> $strSearch,
                    'text'=> $strSearch
                );
           }
       
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    public function _searchMisc3($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrEnrollments = Enrollment::Query(
                sprintf(
                  'WHERE Misc3 LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrEnrollments as $strKey => $objEnrollment){
               $arrData[$strKey] = array(
                      'value'=>$objEnrollment->Misc3,
                      'text'=>$objEnrollment->Misc3
               );
           }
           if(count($arrData) == 0){
                $arrData[] = array(
                    'value'=> $strSearch,
                    'text'=> $strSearch
                );
           }
       
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    public function _searchMisc4($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrEnrollments = Enrollment::Query(
                sprintf(
                  'WHERE Misc4 LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrEnrollments as $strKey => $objEnrollment){
               $arrData[$strKey] = array(
                      'value'=>$objEnrollment->Misc4,
                      'text'=>$objEnrollment->Misc4
               );
           }
           if(count($arrData) == 0){
                $arrData[] = array(
                    'value'=> $strSearch,
                    'text'=> $strSearch
                );
           }
       
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    public function _searchMisc5($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrEnrollments = Enrollment::Query(
                sprintf(
                  'WHERE Misc5 LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrEnrollments as $strKey => $objEnrollment){
               $arrData[$strKey] = array(
                      'value'=>$objEnrollment->Misc5,
                      'text'=>$objEnrollment->Misc5
               );
           }
           if(count($arrData) == 0){
                $arrData[] = array(
                    'value'=> $strSearch,
                    'text'=> $strSearch
                );
           }
       
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    
    
    public function _searchLevel($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrEnrollments = Enrollment::Query(
                sprintf(
                  'WHERE Level LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrEnrollments as $strKey => $objEnrollment){
               $arrData[$strKey] = array(
                      'value'=>$objEnrollment->Level,
                      'text'=>$objEnrollment->Level
               );
           }
           if(count($arrData) == 0){
                $arrData[] = array(
                    'value'=> $strSearch,
                    'text'=> $strSearch
                );
           }
       
       
       die(
           json_encode(
               $arrData
           )
       );
    }
 */
}
?>