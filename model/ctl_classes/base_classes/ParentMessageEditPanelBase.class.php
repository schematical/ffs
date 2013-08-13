<?php
class ParentMessageEditPanelBase extends MJaxPanel{
	protected $objParentMessage = null;
    
    	
    	public $intIdParentMessage = null;
   		
    	
	
    	
    	
    	public $intIdAthelete = null;
   		
	
    	
    	
    	public $strAtheleteName = null;
   		
	
    	
    	
    	public $strMessage = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $dttDispDate = null;
   		
	
    	
    	
    	public $intIdUser = null;
   		
	
    	
    	
    	public $dttQueDate = null;
   		
	
    	
    	
    	public $strInviteData = null;
   		
	
    	
    	
    	public $strInviteType = null;
   		
	
    	
    	
    	public $strInviteToken = null;
   		
	
    	
    	
    	public $dttInviteViewDate = null;
   		
	
    	
    	
    	public $intIdCompetition = null;
   		
	
    	
    	
    	public $dttApproveDate = null;
   		
	
    	
    	
    	public $intIdStripeData = null;
   		
	
	
   		public $lnkViewParentIdAthelete = null;
	
   		public $lnkViewParentIdCompetition = null;
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objParentMessage = null){
		parent::__construct($objParentControl);
		$this->objParentMessage = $objParentMessage;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/ParentMessageEditPanelBase.tpl.php';
		
		$this->CreateFieldControls();
		$this->CreateContentControls();
		$this->CreateReferenceControls();
		
	}
	public function CreateContentControls(){
		$this->btnSave = new MJaxButton($this);
		$this->btnSave->Text = 'Save';
		$this->btnSave->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnSave_click'));
		$this->btnSave->AddCssClass('btn btn-large');
		
		$this->btnDelete = new MJaxButton($this);
		$this->btnDelete->Text = 'Delete';
		$this->btnDelete->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnDelete_click'));
		$this->btnDelete->AddCssClass('btn btn-large');
		if(is_null($this->objParentMessage)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
	  		
  		
	     
	  	
            
                $this->strAtheleteName = new MJaxTextBox($this);
                $this->strAtheleteName->Name = 'atheleteName';
                $this->strAtheleteName->AddCssClass('input-large');
                //varchar(255)
                
            
	  		
  		
	     
	  	
            
                $this->strMessage = new MJaxTextBox($this);
                $this->strMessage->Name = 'message';
                $this->strMessage->AddCssClass('input-large');
                //longtext
                
                    $this->strMessage->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttDispDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttQueDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
                $this->strInviteData = new MJaxTextBox($this);
                $this->strInviteData->Name = 'inviteData';
                $this->strInviteData->AddCssClass('input-large');
                //varchar(256)
                
            
	  		
  		
	     
	  	
            
                $this->strInviteType = new MJaxTextBox($this);
                $this->strInviteType->Name = 'inviteType';
                $this->strInviteType->AddCssClass('input-large');
                //varchar(16)
                
            
	  		
  		
	     
	  	
            
                $this->strInviteToken = new MJaxTextBox($this);
                $this->strInviteToken->Name = 'inviteToken';
                $this->strInviteToken->AddCssClass('input-large');
                //varchar(256)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttInviteViewDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttApproveDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
                $this->intIdStripeData = new MJaxTextBox($this);
                $this->intIdStripeData->Name = 'idStripeData';
                $this->intIdStripeData->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	  
	  if(!is_null($this->objParentMessage)){
            $this->SetParentMessage($this->objParentMessage);
	  }
  }
  public function SetParentMessage($objParentMessage){
      $this->objParentMessage = $objParentMessage;
      $this->blnModified = true;
      if(!is_null($this->objParentMessage)){
          
            
            
                //PKey
                $this->intIdParentMessage = $this->objParentMessage->idParentMessage;
            

          
            
                
                
            
            

          
            
                
                    $this->strAtheleteName->Text = $this->objParentMessage->atheleteName;
                
                
            
            

          
            
                
                    $this->strMessage->Text = $this->objParentMessage->message;
                
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->dttDispDate->Value = $this->objParentMessage->dispDate;
                    
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->dttQueDate->Value = $this->objParentMessage->queDate;
                    
                
            
            

          
            
                
                    $this->strInviteData->Text = $this->objParentMessage->inviteData;
                
                
            
            

          
            
                
                    $this->strInviteType->Text = $this->objParentMessage->inviteType;
                
                
            
            

          
            
                
                    $this->strInviteToken->Text = $this->objParentMessage->inviteToken;
                
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->dttInviteViewDate->Value = $this->objParentMessage->inviteViewDate;
                    
                
            
            

          
            
                
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->dttApproveDate->Value = $this->objParentMessage->approveDate;
                    
                
            
            

          
            
                
                    $this->intIdStripeData->Text = $this->objParentMessage->idStripeData;
                
                
            
            

          
      }

	}
	public function CreateReferenceControls(){
        if(!is_null($this->objParentMessage)){
          
            if(!is_null($this->objParentMessage->idAthelete)){
                $this->lnkViewParentIdAthelete = new MJaxLinkButton($this);
                $this->lnkViewParentIdAthelete->Text = 'View Athelete';
                $this->lnkViewParentIdAthelete->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objParentMessage->idAthelete;
            }
          
            if(!is_null($this->objParentMessage->idCompetition)){
                $this->lnkViewParentIdCompetition = new MJaxLinkButton($this);
                $this->lnkViewParentIdCompetition->Text = 'View Competition';
                $this->lnkViewParentIdCompetition->Href = __ENTITY_MODEL_DIR__ . '/Competition/' . $this->objParentMessage->idCompetition;
            }
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objParentMessage)){
			//Create a new one
			$this->objParentMessage = new ParentMessage();
		}

  		  
            
		  
            
                
                
            
		  
            
                
                    $this->objParentMessage->atheleteName = $this->strAtheleteName->Text;
                
                
            
		  
            
                
                    $this->objParentMessage->message = $this->strMessage->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->objParentMessage->idUser = MLCAuthDriver::IdUser();
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                    $this->objParentMessage->inviteData = $this->strInviteData->Text;
                
                
            
		  
            
                
                    $this->objParentMessage->inviteType = $this->strInviteType->Text;
                
                
            
		  
            
                
                    $this->objParentMessage->inviteToken = $this->strInviteToken->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                    $this->objParentMessage->idStripeData = $this->intIdStripeData->Text;
                
                
            
		
		$this->objParentMessage->Save();
  	}
  	public function btnDelete_click(){
  		$this->objParentMessage->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objParentMessage);
  	}
  	
}
?>