<?php
class AuthAccountTypeCd_tpcdEditPanelBase extends MJaxPanel{
	protected $objAuthAccountTypeCd_tpcd = null;
    
    	
    	public $intIdAccountTypeCd = null;
   		
    	
	
    	
    	
    	public $strShortDesc = null;
   		
	
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objAuthAccountTypeCd_tpcd = null){
		parent::__construct($objParentControl);
		$this->objAuthAccountTypeCd_tpcd = $objAuthAccountTypeCd_tpcd;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/AuthAccountTypeCd_tpcdEditPanelBase.tpl.php';
		
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
		if(is_null($this->objAuthAccountTypeCd_tpcd)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->strShortDesc = new MJaxTextBox($this);
                $this->strShortDesc->Name = 'shortDesc';
                $this->strShortDesc->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	  
	  if(!is_null($this->objAuthAccountTypeCd_tpcd)){
	     
	  	
  		
  			$this->intIdAccountTypeCd = $this->objAuthAccountTypeCd_tpcd->idAccountTypeCd;
  		
  		
	     
	  	
            
	  		    $this->strShortDesc->Text = $this->objAuthAccountTypeCd_tpcd->shortDesc;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objAuthAccountTypeCd_tpcd)){
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objAuthAccountTypeCd_tpcd)){
			//Create a new one
			$this->objAuthAccountTypeCd_tpcd = new AuthAccountTypeCd_tpcd();
		}

  		  
            
		  
            
                
                    $this->objAuthAccountTypeCd_tpcd->shortDesc = $this->strShortDesc->Text;
                
                
            
		
		$this->objAuthAccountTypeCd_tpcd->Save();
  	}
  	public function btnDelete_click(){
  		$this->objAuthAccountTypeCd_tpcd->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objAuthAccountTypeCd_tpcd);
  	}
  	
}
?>