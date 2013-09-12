<?php
class FFSOrgManagerSpecialPanel extends MJaxPanel{
    public $txtClubNum = null;
    public $lstClubType = null;
    public $dttCutOffDate = null;

    public $lnkSave = null;

    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $objOrg = FFSForm::Org();
        $this->txtClubNum = new MJaxTextBox($this);
        if(!is_null($objOrg->ClubNum)){
            $this->txtClubNum->Text = $objOrg->ClubNum;
            $this->txtClubNum->Attr('readonly','readonly');
        }

        $this->lstClubType = new MJaxListBox($this);
        if(!is_null($objOrg->ClubType)){
            $this->lstClubType->Attr('readonly','readonly');
        }
        $this->lstClubType->AddItem(
            null,
            null,
            is_null($objOrg->ClubType)
        );
        foreach(FFSClubTypes::$arrClubTypes as $strKey => $strName){
            $this->lstClubType->AddItem(
                $strName,
                $strKey,
                ($objOrg->ClubType == $strKey)
            );
        }
        $objCompetition = FFSForm::Competition();
        if(is_null($objCompetition->SignupCutOffDate)){
            $strCutoffDate = MLCDateTime::Offset($objCompetition->StartDate, '- 10 Days');
            if(MLCDateTime::IsLessThan($strCutoffDate)){
                $strCutoffDate = MLCDateTime::Now();
            }
        }else{
            $strCutoffDate = $objCompetition->SignupCutOffDate;
        }
        $this->dttCutOffDate = new MJaxBSDateTimePicker($this);
        $this->dttCutOffDate->DateOnly();
        $this->dttCutOffDate->SetValue(
            $strCutoffDate
        );
        $this->lnkSave = new MJaxLinkButton($this);
        $this->lnkSave->AddCssClass('btn btn-large');
        $this->lnkSave->Text = "Update";
        $this->lnkSave->AddAction($this, 'lnkSave_click');
    }

    public function lnkSave_click()
    {
        $objOrg = FFSForm::Org();
        $objOrg->ClubType = $this->lstClubType->SelectedValue;
        if(
            (strlen($this->txtClubNum->Text) > 0) &&
            (!is_numeric($this->txtClubNum->Text))
        ){
            $this->txtClubNum->Alert("This value must be numeric");
            return;
        }else{
            $objOrg->ClubNum = $this->txtClubNum->Text;
        }
        $objOrg->Save();

        $objCompetition = FFSForm::Competition();
        $strCutOffDate = $this->dttCutOffDate->GetValue();
        if(MLCDateTime::IsLessThan($strCutOffDate)){
            $this->dttCutOffDate->Alert("Must be later than now");
            return;
        }else if(MLCDateTime::IsGreaterThan($strCutOffDate, $objCompetition->StartDate)){
            $this->dttCutOffDate->Alert("Cannot be during or after your competition");
            return;
        }
        $objCompetition->SignupCutOffDate = $strCutOffDate;
        $objCompetition->Save();
    }
    
}