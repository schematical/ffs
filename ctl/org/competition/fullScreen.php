<?php
MLCApplication::InitPackage('MJaxGentaTheme');
class fullScreen extends MJaxGentaForm {
    protected $intCt = 100;
    public $pnlScore = null;
    public $pnlMessage = null;
    public $lstEvent = null;

    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/org/competition/fullScreen.tpl.php';
        $this->blnSkipMainWindowRender = true;

        $this->InitEventList();

        $this->pnlScore = new FFSScoreDisplayPanel($this);
        $this->pnlScore->AddCssClass('span8');
        $this->pnlScore->AddAction(
            new MJaxTimeoutEvent(5000),
            new MJaxServerControlAction($this, 'pnlScore_timeout')
        );

        //$this->AddImage(__ASSETS_IMG__ . '/bkgd1.jpg');
        //$this->AddImage(__ASSETS_IMG__ . '/bkgd2.jpg');
        $this->AddImage(__ASSETS_IMG__ . '/bkgd3.jpg');
        //$this->AddImage(__ASSETS_IMG__ . '/bkgd4.jpg');
        //$this->AddImage(__ASSETS_IMG__ . '/bkgd5.jpg');

        $this->pnlMessage = new MJaxPanel($this,'pnlMessage');
        $this->pnlMessage->AddCssClass('offset2 span8');

        $this->UpdateMessageDisp();
        $this->UpdateScoreDisp();
    }
    public function InitEventList(){
        $this->lstEvent = new MJaxListBox($this);
        //Load active sessions

        //
        $this->lstEvent->AddItem('All', 'All');
    }
    public function pnlScore_timeout(){
        $this->UpdateMessageDisp();
        $this->UpdateScoreDisp();
    }
    public function UpdateScoreDisp(){


        $this->intCt += 5;
        $arrResults = FFSApplication::GetQuedResult();
        if(count($arrResults) == 0){

            return;
        }
        $arrIndResults = array();
        $intFailOut = 0;

        while(count($arrIndResults) == 0){
            if($intFailOut > 25){
                return;
            }
            $intTIndex = rand(0, count($arrResults)-1) ;
            $arrResultKeys = array_keys($arrResults);
            $arrIndResults = $arrResults[$arrResultKeys[$intTIndex]];
            $intFailOut += 1;
        }
        $this->pnlScore->Update($arrIndResults);

    }
    public function UpdateMessageDisp(){
        $this->intCt += 5;
        $arrMessage = FFSApplication::GetQuedMessages();

        if(count($arrMessage) == 0){
            $this->pnlMessage->Text = sprintf(
                '<p> Go to <b>%s/%s</b> to post a message to your athlete</p>',
                $_SERVER['SERVER_NAME'],
                FFSForm::Competition()->Namespace
            );
            return;
        }
        $objMessage = $arrMessage[rand(0, count($arrMessage) - 1)];
        if(is_null($objMessage->DispDate)){
            $objMessage->DispDate = MLCDateTime::Now();
            $objMessage->Save();
        }
        //_dv($objMessage);
        $this->pnlMessage->Text = sprintf(
            'To <b>%s: </b><br/>
            From <b>%s: </b>
            <p class="pull-right">%s</p>',
            $objMessage->AtheleteName,
            $objMessage->FromName,
            $objMessage->Message
        );
    }

}
fullScreen::Run('fullScreen');
?>