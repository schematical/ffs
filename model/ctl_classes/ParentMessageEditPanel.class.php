<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - ParentMessageEditPanel extends ParentMessageEditPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/ParentMessageEditPanelBase.class.php");
class ParentMessageEditPanel extends ParentMessageEditPanelBase {
    protected $blnAllowSave = true;
    public function __construct($objParentControl, $objParentMessage = null){
        parent::__construct($objParentControl, $objParentMessage);
        $this->InitidAtheleteAutocomplete();
         /*

                $this->InitAtheleteNameAutocomplete();
                $this->InitInviteDataAutocomplete();
                $this->InitInviteTypeAutocomplete();
                $this->InitInviteTokenAutocomplete();
                $this->InitidCompetitionAutocomplete();
        */
    }
    public function btnSave_click(){
        if($this->blnAllowSave){
            $this->btnSave_click();
        }else{
            $this->TriggerEvent('mjax-success');
        }
    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName)
    {
        switch ($strName) {
            case "AllowSave":
                return $this->blnAllowSave;
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
            case "AllowSave":
                return $this->blnAllowSave = $mixValue;
            default:
                return parent::__set($strName, $mixValue);
            //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }
    /*
    public function SetParentMessage($objParentMessage){
        parent::SetParentMessage($objParentMessage);
        
        
        
        
            if(
                (!is_null($this->intIdAthelete)) &&
                (!is_null($this->objParentMessage->idAthelete))
            ){
                
                    $objAthelete = Athelete::LoadById(
                        $this->objParentMessage->idAthelete
                    );
                    $this->intIdAthelete->Text = $objAthelete->Name;
                    $this->intIdAthelete->Value = $objAthelete->idAthelete;
                
                
            }
        
        
        
            if(
                (!is_null($this->strAtheleteName)) &&
                (!is_null($this->objParentMessage->atheleteName))
            ){
                
                
                    $this->strAtheleteName->Value = $this->strAtheleteName->Text;
                
            }
        
        
        
        
        
        
        
        
        
        
        
        
        
            if(
                (!is_null($this->strInviteData)) &&
                (!is_null($this->objParentMessage->inviteData))
            ){
                
                
                    $this->strInviteData->Value = $this->strInviteData->Text;
                
            }
        
        
        
            if(
                (!is_null($this->strInviteType)) &&
                (!is_null($this->objParentMessage->inviteType))
            ){
                
                
                    $this->strInviteType->Value = $this->strInviteType->Text;
                
            }
        
        
        
            if(
                (!is_null($this->strInviteToken)) &&
                (!is_null($this->objParentMessage->inviteToken))
            ){
                
                
                    $this->strInviteToken->Value = $this->strInviteToken->Text;
                
            }
        
        
        
        
        
            if(
                (!is_null($this->intIdCompetition)) &&
                (!is_null($this->objParentMessage->idCompetition))
            ){
                
                    $objCompetition = Competition::LoadById(
                        $this->objParentMessage->idCompetition
                    );
                    $this->intIdCompetition->Text = $objCompetition->Name;
                    $this->intIdCompetition->Value = $objCompetition->idCompetition;
                
                
            }
        
        
        
        
        
        
    }
    public function btnSave_click() {
        if (is_null($this->objParentMessage)) {
                //Create a new one
                $this->objParentMessage = new ParentMessage();
        }
        
            
        
            
                if(
                    (!is_null($this->intIdAthelete))
                ){
                    
                    $this->objParentMessage->idAthelete = $this->intIdAthelete->Value;
                    
                    
                }
            
        
            
                if(
                    (!is_null($this->strAtheleteName))
                ){
                    
                    
                        $this->strAtheleteName->Text = $this->strAtheleteName->Value;
                    
                }
            
        
            
        
            
        
            
        
            
        
            
        
            
                if(
                    (!is_null($this->strInviteData))
                ){
                    
                    
                        $this->strInviteData->Text = $this->strInviteData->Value;
                    
                }
            
        
            
                if(
                    (!is_null($this->strInviteType))
                ){
                    
                    
                        $this->strInviteType->Text = $this->strInviteType->Value;
                    
                }
            
        
            
                if(
                    (!is_null($this->strInviteToken))
                ){
                    
                    
                        $this->strInviteToken->Text = $this->strInviteToken->Value;
                    
                }
            
        
            
        
            
                if(
                    (!is_null($this->intIdCompetition))
                ){
                    
                    $this->objParentMessage->idCompetition = $this->intIdCompetition->Value;
                    
                    
                }
            
        
            
        
            
        
        parent::btnSave_click();
    }
    
    
    
    
    
    
    
    public function _searchAthelete($objRoute){
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
       
            $arrAtheletes = Athelete::Query(
                    sprintf(
                      'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                      strtolower($strSearch),
                      strtolower($strSearch)
                  )
            );
            foreach($arrAtheletes as $strKey => $objAthelete){
                $arrData[$strKey] = array(
                       'value'=>$objAthelete->GetId(),
                       'text'=>$objAthelete->Name
                );
            }
       
       die(
           json_encode(
               $arrData
           )
       );
    }
    
    
    
    
    public function _searchAtheleteName($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrParentMessages = ParentMessage::Query(
                sprintf(
                  'WHERE AtheleteName LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrParentMessages as $strKey => $objParentMessage){
               $arrData[$strKey] = array(
                      'value'=>$objParentMessage->AtheleteName,
                      'text'=>$objParentMessage->AtheleteName
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function _searchInviteData($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrParentMessages = ParentMessage::Query(
                sprintf(
                  'WHERE InviteData LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrParentMessages as $strKey => $objParentMessage){
               $arrData[$strKey] = array(
                      'value'=>$objParentMessage->InviteData,
                      'text'=>$objParentMessage->InviteData
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
    
    
    
    
    public function _searchInviteType($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrParentMessages = ParentMessage::Query(
                sprintf(
                  'WHERE InviteType LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrParentMessages as $strKey => $objParentMessage){
               $arrData[$strKey] = array(
                      'value'=>$objParentMessage->InviteType,
                      'text'=>$objParentMessage->InviteType
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
    
    
    
    
    public function _searchInviteToken($objRoute){
    
    
       $strSearch = $_POST['search'];
       $arrData = array();
       
           $arrParentMessages = ParentMessage::Query(
                sprintf(
                  'WHERE InviteToken LIKE "%s%%"',
                  strtolower($strSearch)
              )
           );
           foreach($arrParentMessages as $strKey => $objParentMessage){
               $arrData[$strKey] = array(
                      'value'=>$objParentMessage->InviteToken,
                      'text'=>$objParentMessage->InviteToken
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