<?php
class OrgEditPanelBase extends MJaxPanel{
	protected $objOrg = null;
    
    	
    	public $intIdOrg = null;
   		
    	
	
    	
    	
    	public $strNamespace = null;
   		
	
    	
    	
    	public $strName = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $strPsData = null;
   		
	
    	
    	
    	public $intIdImportAuthUser = null;
   		
	
    	
    	
    	public $strClubNum = null;
   		
	
	
	
  		public $lnkViewChildDevice = null;
  	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objOrg = null){
		parent::__construct($objParentControl);
		$this->objOrg = $objOrg;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/OrgEditPanelBase.tpl.php';
		
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
		if(is_null($this->objOrg)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->strNamespace = new MJaxTextBox($this);
                $this->strNamespace->Name = 'namespace';
                $this->strNamespace->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strName = new MJaxTextBox($this);
                $this->strName->Name = 'name';
                $this->strName->AddCssClass('input-large');
                //varchar(128)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
                $this->strPsData = new MJaxTextBox($this);
                $this->strPsData->Name = 'psData';
                $this->strPsData->AddCssClass('input-large');
                //longtext
                
                    $this->strPsData->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
                $this->intIdImportAuthUser = new MJaxTextBox($this);
                $this->intIdImportAuthUser->Name = 'idImportAuthUser';
                $this->intIdImportAuthUser->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	     
	  	
            
                $this->strClubNum = new MJaxTextBox($this);
                $this->strClubNum->Name = 'clubNum';
                $this->strClubNum->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	  
	  if(!is_null($this->objOrg)){
            $this->SetOrg($this->objOrg);
	  }
  }
  public function SetOrg($objOrg){
      $this->objOrg = $objOrg;
      $this->blnModified = true;
      if(!is_null($this->objOrg)){
          
            
            
                //PKey
                $this->intIdOrg = $this->objOrg->idOrg;
            

          
            
                
                    $this->strNamespace->Text = $this->objOrg->namespace;
                
                
            
            

          
            
                
                    $this->strName->Text = $this->objOrg->name;
                
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
            

          
            
                
                    $this->strPsData->Text = $this->objOrg->psData;
                
                
            
            

          
            
                
                    $this->intIdImportAuthUser->Text = $this->objOrg->idImportAuthUser;
                
                
            
            

          
            
                
                    $this->strClubNum->Text = $this->objOrg->clubNum;
                
                
            
            

          
      }

	}
	public function CreateReferenceControls(){
        if(!is_null($this->objOrg)){
          

	   }

           

            $this->lnkViewChildDevice = new MJaxLinkButton($this);
            $this->lnkViewChildDevice->Text = 'View Devices';
            //I should really fix this
            //$this->lnkViewChildDevice->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objOrg->idOrg . '/Devices';

          
	}
	
	public function btnSave_click(){
		if(is_null($this->objOrg)){
			//Create a new one
			$this->objOrg = new Org();
		}

  		  
            
		  
            
                
                    $this->objOrg->namespace = $this->strNamespace->Text;
                
                
            
		  
            
                
                    $this->objOrg->name = $this->strName->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                    $this->objOrg->psData = $this->strPsData->Text;
                
                
            
		  
            
                
                    $this->objOrg->idImportAuthUser = $this->intIdImportAuthUser->Text;
                
                
            
		  
            
                
                    $this->objOrg->clubNum = $this->strClubNum->Text;
                
                
            
		
		$this->objOrg->Save();
  	}
  	public function btnDelete_click(){
  		$this->objOrg->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objOrg);
  	}
  	
}
?>