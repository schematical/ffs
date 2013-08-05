<?php
class ParentMessageListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrParentMessages = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrParentMessages);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idParentMessage','idParentMessage');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('idAthelete','idAthelete');
	   		
		
	    	
	    	
	    	$this->AddColumn('atheleteName','atheleteName');
	   		
		
	    	
	    	
	    	$this->AddColumn('message','message');
	   		
		
	    	
	    	
	    	$this->AddColumn('creDate','creDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('dispDate','dispDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('idUser','idUser');
	   		
		
	    	
	    	
	    	$this->AddColumn('queDate','queDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('inviteData','inviteData');
	   		
		
	    	
	    	
	    	$this->AddColumn('inviteType','inviteType');
	   		
		
	    	
	    	
	    	$this->AddColumn('inviteToken','inviteToken');
	   		
		
	    	
	    	
	    	$this->AddColumn('inviteViewDate','inviteViewDate');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/ParentMessage/' . $strActionParameter);
	}
	
  	
}
?>