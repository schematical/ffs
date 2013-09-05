<?php
abstract class FFSFeedDisplayPanel extends MJaxPanel{

    public $objAthelete = null;
    public $objEntity = null;
    public $mixExtraData = null;
    public $objFollowRoll = null;
    //CTL

    public $lnkMessage = null;
    public $lnkShare = null;
    public $lnkToggleFollow = null;
    //
    public $pnlShare = null;

    public function __construct($objParentControl, $objEntity = null){
        parent::__construct($objParentControl);
        $this->objEntity = $objEntity;
        $this->objAthelete = $this->objEntity->IdAtheleteObject;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->AddCssClass('well');

        $this->lnkShare = new MJaxLinkButton($this);
        $this->lnkShare->Text = 'Share';
        $this->lnkShare->AddCssClass('btn btn-small');
        $this->lnkShare->AddAction(
            $this,
            'lnkShare_click'
        );




        $intIdAthelete  = null;
        try{
            $intIdAthelete = $this->objEntity->IdAthelete;
        }catch (Exception $e){
            //Do nothing
        }

        if(!is_null($intIdAthelete)){
            $this->lnkMessage = new MJaxLinkButton($this);
            $this->lnkMessage->Text = 'Shout out';
            $this->lnkMessage->AddCssClass('btn btn-small');
            //$this->lnkMessage->Url = $this->GetShareUrl();
            $this->lnkMessage->AddAction(
                $this,
                'lnkMessage_click'
            );


            if(!is_null($this->objAthelete)){
                $this->lnkToggleFollow = new MJaxLinkButton($this);
                $this->lnkToggleFollow->AddCssClass('btn btn-small');
                if(!is_null(MLCAuthDriver::User())){
                    $this->objFollowRoll = MLCAuthDriver::GetRollByEntity($this->objAthelete, FFSRoll::FOLLOW);
                }
                if(is_null($this->objFollowRoll)){
                    $this->lnkToggleFollow->Text = 'Follow';
                }else{
                    //_dv($this->objFollowRoll);
                    $this->lnkToggleFollow->Text = 'Unfollow';
                }
                $this->lnkToggleFollow->AddAction(
                    $this,
                    'lnkToggleFollow_click'
                );
            }
        }
    }
    abstract public function GetShareUrl();
    public function lnkMessage_click(){
        $this->objForm->Redirect(
            sprintf(
                '%s/parent/message',
                FFSForm::Competition()->Namespace
            ),
            array(
                FFSQS::IdAthelete => $this->objEntity->IdAthelete
            )
        );
    }
    public function lnkToggleFollow_click(){
        if(is_null(MLCAuthDriver::User())){
            return $this->Alert("Signup");
        }

        if(!is_null($this->objFollowRoll)){

            $this->objFollowRoll->MarkDeleted();
            $this->objFollowRoll = null;
            $this->lnkToggleFollow->Text = 'Follow';
        }else{
            //_dv($this->objFollowRoll);
            $this->objFollowRoll = MLCAuthDriver::AddRoll(
                FFSRoll::FOLLOW,
                $this->objAthelete
            );
            $this->lnkToggleFollow->Text = 'Unfollow';
        }
        $this->objForm->SkipMainWindowRender = true;
    }
    public function lnkShare_click(){
        if(is_null($this->pnlShare)){
            $this->pnlShare = new FFSSharePanel($this);
            $this->pnlShare->Url = $this->GetShareUrl();

        }
        $this->objForm->Alert($this->pnlShare);
        /*$this->objForm->Redirect(
            $this->GetShareUrl()
        );*/
    }

    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName)
    {
        switch ($strName) {
            case "ExtraData":
                return $this->mixExtraData;
            case "Entity":
                return $this->objEntity;
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

            case "ExtraData":
                return $this->mixExtraData = $mixValue;
            case "Entity":
                return $this->objEntity = $mixValue;
            default:
                return parent::__set($strName, $mixValue);
                //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }
}