<?php
class AuthAccountEditPanelBase extends MJaxPanel{
	protected $objAuthAccount = null;
    
    	
    	public $intIdAccount = null;
   		
    	
	
    	
    	
    	public $intIdAccountTypeCd = null;
   		
	
    	
    	
    	public $intIdUser = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $strShortDesc = null;
   		
	
	
	
  		public $lnkViewChildMLCLocation = null;
  	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objAuthAccount = null){
		parent::__construct($objParentControl);
		$this->objAuthAccount = $objAuthAccount;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/AuthAccountEditPanelBase.tpl.php';
		
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
		if(is_null($this->objAuthAccount)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->intIdAccountTypeCd = new MJaxTextBox($this);
                $this->intIdAccountTypeCd->Name = 'idAccountTypeCd';
                $this->intIdAccountTypeCd->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
                $this->strShortDesc = new MJaxTextBox($this);
                $this->strShortDesc->Name = 'shortDesc';
                $this->strShortDesc->AddCssClass('input-large');
                //varchar(45)
                
            
	  		
  		
	  
	  if(!is_null($this->objAuthAccount)){
	     
	  	
  		
  			$this->intIdAccount = $this->objAuthAccount->idAccount;
  		
  		
	     
	  	
            
	  		    $this->intIdAccountTypeCd->Text = $this->objAuthAccount->idAccountTypeCd;
            
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->strShortDesc->Text = $this->objAuthAccount->shortDesc;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objAuthAccount)){
          

	   }

           

            $this->lnkViewChildMLCLocation = new MJaxLinkButton($this);
            $this->lnkViewChildMLCLocation->Text = 'View MLCLocations';
            //I should really fix this
            //$this->lnkViewChildMLCLocation->Href = __ENTITY_MODEL_DIR__ . '/AuthAccount/' . $this->objAuthAccount->idAccount . '/MLCLocations';

          
	}
	
	public function btnSave_click(){
		if(is_null($this->objAuthAccount)){
			//Create a new one
			$this->objAuthAccount = new AuthAccount();
		}

  		  
            
		  
            
                
                    $this->objAuthAccount->idAccountTypeCd = $this->intIdAccountTypeCd->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->objAuthAccount->idUser = MLCAuthDriver::IdUser();
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                    $this->objAuthAccount->shortDesc = $this->strShortDesc->Text;
                
                
            
		
		$this->objAuthAccount->Save();
  	}
  	public function btnDelete_click(){
  		$this->objAuthAccount->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objAuthAccount);
  	}
  	
}
?>