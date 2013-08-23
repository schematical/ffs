<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/SessionEditPanelBase.class.php");
class SessionEditPanel extends SessionEditPanelBase {

    public function __construct($objParentControl, $objSession = null){
		parent::__construct($objParentControl, $objSession);
        
            
            
        
            
            
        
            
            
        
            
                $this->InitidCompetitionAutocomplete();
            
            
        
            
            
                $this->InitNameAutocomplete();
            
        
            
            
        
            
            
        
            
            
                $this->InitEquipmentSetAutocomplete();
            
        
            
            
        
    }
    
        

        
    
        

        
    
        

        
    
        
            public function InitidCompetitionAutocomplete(){
                $this->intIdCompetition = new MJaxTextBox($this);
                $this->intIdCompetition->Name = 'idCompetition';
                $this->intIdCompetition->AddCssClass('input-large');
                $this->intIdCompetition->Typehead($this, '_searchCompetition');
            }
        

        
    
        

        
            public function InitNameAutocomplete(){
                $this->strName->Typehead($this, '_searchName');
            }
        
    
        

        
    
        

        
    
        

        
            public function InitEquipmentSetAutocomplete(){
                $this->strEquipmentSet->Typehead($this, '_searchEquipmentSet');
            }
        
    
        

        
    
    
    
    
    
    
    
    
    
    
    
    
    public function _searchCompetition($objRoute){
        $strSearch = $_POST['search'];
        $arrCompetitions = Competition::Query(
             sprintf(
               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
               strtolower($strSearch),
               strtolower($strSearch)
           )
        );

        $arrData = array();
        foreach($arrCompetitions as $strKey => $objCompetition){
            $arrData[$strKey] = $objCompetition->Name;
        }
        die(
            json_encode(
                $arrData
            )
        );
    }
    
    
    
    
    
    public function _searchName($objRoute){
       $strSearch = $_POST['search'];
       $arrSessions = Session::Query(
            sprintf(
              'WHERE Name LIKE "%s%%"',
              strtolower($strSearch)
          )
       );

       $arrData = array();
       foreach($arrSessions as $strKey => $objSession){
           $arrData[$strKey] = $objSession->Name;
       }
       die(
           json_encode(
               $arrData
           )
       );
   }
    
    
    
    
    
    
    
    
    
    
    public function _searchEquipmentSet($objRoute){
       $strSearch = $_POST['search'];
       $arrSessions = Session::Query(
            sprintf(
              'WHERE EquipmentSet LIKE "%s%%"',
              $strSearch
          )
       );

       $arrData = array();
       foreach($arrSessions as $strKey => $objSession){
           $arrData[$strKey] = array(
               'value'=>$objSession->EquipmentSet,
               'text'=>$objSession->EquipmentSet
           );
       }
       die(
           json_encode(
               $arrData
           )
       );
   }
    
    
    
    
    

}


?>