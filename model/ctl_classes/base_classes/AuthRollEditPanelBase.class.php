<?php
class AuthRollEditPanelBase extends MJaxPanel{
	protected $objAuthRoll = null;
    
    	
    	public $intIdAuthRoll = null;
   		
    	
	
    	
    	
    	public $intIdAuthUser = null;
   		
	
    	
    	
    	public $intIdEntity = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $strEntityType = null;
   		
	
    	
    	
    	public $strRollType = null;
   		
	
    	
    	
    	public $strData = null;
   		
	
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objAuthRoll = null){
		parent::__construct($objParentControl);
		$this->objAuthRoll = $objAuthRoll;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/AuthRollEditPanelBase.tpl.php';
		
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
		if(is_null($this->objAuthRoll)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->intIdAuthUser = new MJaxTextBox($this);
                $this->intIdAuthUser->Name = 'idAuthUser';
                $this->intIdAuthUser->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	     
	  	
            
                $this->intIdEntity = new MJaxTextBox($this);
                $this->intIdEntity->Name = 'idEntity';
                $this->intIdEntity->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
                $this->strEntityType = new MJaxTextBox($this);
                $this->strEntityType->Name = 'entityType';
                $this->strEntityType->AddCssClass('input-large');
                //varchar(128)
                
            
	  		
  		
	     
	  	
            
                $this->strRollType = new MJaxTextBox($this);
                $this->strRollType->Name = 'rollType';
                $this->strRollType->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strData = new MJaxTextBox($this);
                $this->strData->Name = 'data';
                $this->strData->AddCssClass('input-large');
                //varchar(45)
                
            
	  		
  		
	  
	  if(!is_null($this->objAuthRoll)){
	     
	  	
  		
  			$this->intIdAuthRoll = $this->objAuthRoll->idAuthRoll;
  		
  		
	     
	  	
            
	  		    $this->intIdAuthUser->Text = $this->objAuthRoll->idAuthUser;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdEntity->Text = $this->objAuthRoll->idEntity;
            
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->strEntityType->Text = $this->objAuthRoll->entityType;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strRollType->Text = $this->objAuthRoll->rollType;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strData->Text = $this->objAuthRoll->data;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objAuthRoll)){
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objAuthRoll)){
			//Create a new one
			$this->objAuthRoll = new AuthRoll();
		}

  		  
            
		  
            
                
                    $this->objAuthRoll->idAuthUser = $this->intIdAuthUser->Text;
                
                
            
		  
            
                
                    $this->objAuthRoll->idEntity = $this->intIdEntity->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                    $this->objAuthRoll->entityType = $this->strEntityType->Text;
                
                
            
		  
            
                
                    $this->objAuthRoll->rollType = $this->strRollType->Text;
                
                
            
		  
            
                
                    $this->objAuthRoll->data = $this->strData->Text;
                
                
            
		
		$this->objAuthRoll->Save();
  	}
  	public function btnDelete_click(){
  		$this->objAuthRoll->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objAuthRoll);
  	}
  	
}
?>