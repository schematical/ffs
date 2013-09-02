<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - OrgCompetitionEditPanel extends OrgCompetitionEditPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/OrgCompetitionEditPanelBase.class.php");
class OrgCompetitionEditPanel extends OrgCompetitionEditPanelBase {
    /*
    public function __construct($objParentControl, $objOrgCompetition = null){
    parent::__construct($objParentControl, $objOrgCompetition);
        
            
            
        
            
                $this->InitidOrgAutocomplete();
            
            
        
            
                $this->InitidCompetitionAutocomplete();
            
            
        
            
            
        
            
            
        
    }
    public function SetOrgCompetition($objOrgCompetition){
        parent::SetOrgCompetition($objOrgCompetition);
        
        
        
        
            if(
                (!is_null($this->intIdOrg)) &&
                (!is_null($this->objOrgCompetition->idOrg))
            ){
                
                    $objOrg = Org::LoadById(
                        $this->objOrgCompetition->idOrg
                    );
                    $this->intIdOrg->Text = $objOrg->Name;
                    $this->intIdOrg->Value = $objOrg->idOrg;
                
                
            }
        
        
        
            if(
                (!is_null($this->intIdCompetition)) &&
                (!is_null($this->objOrgCompetition->idCompetition))
            ){
                
                    $objCompetition = Competition::LoadById(
                        $this->objOrgCompetition->idCompetition
                    );
                    $this->intIdCompetition->Text = $objCompetition->Name;
                    $this->intIdCompetition->Value = $objCompetition->idCompetition;
                
                
            }
        
        
        
        
        
        
    }
    public function btnSave_click() {
        if (is_null($this->objOrgCompetition)) {
                //Create a new one
                $this->objOrgCompetition = new OrgCompetition();
        }
        
            
        
            
                if(
                    (!is_null($this->intIdOrg))
                ){
                    
                    $this->objOrgCompetition->idOrg = $this->intIdOrg->Value;
                    
                    
                }
            
        
            
                if(
                    (!is_null($this->intIdCompetition))
                ){
                    
                    $this->objOrgCompetition->idCompetition = $this->intIdCompetition->Value;
                    
                    
                }
            
        
            
        
            
        
        parent::btnSave_click();
    }
    
        
    
    
        
            public function InitidOrgAutocomplete(){
                
                $this->intIdOrg = new MJaxBSAutocompleteTextBox($this, $this, '_searchOrg');
                
                
                $this->intIdOrg->Name = 'idOrg';
                $this->intIdOrg->AddCssClass('input-large');
            }
        
    
    
        
            public function InitidCompetitionAutocomplete(){
                
                $this->intIdCompetition = new MJaxBSAutocompleteTextBox($this, $this, '_searchCompetition');
                
                
                $this->intIdCompetition->Name = 'idCompetition';
                $this->intIdCompetition->AddCssClass('input-large');
            }
        
    
    
        
    
    
        
    
    
    
    
    
    
    
    
    public function _searchOrg($objRoute){
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
       
            $arrOrgs = Org::Query(
                    sprintf(
                      'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                      strtolower($strSearch),
                      strtolower($strSearch)
                  )
            );
            foreach($arrOrgs as $strKey => $objOrg){
                $arrData[$strKey] = array(
                       'value'=>$objOrg->GetId(),
                       'text'=>$objOrg->Name
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
    
    
    
    
    
    
    */
}
?>