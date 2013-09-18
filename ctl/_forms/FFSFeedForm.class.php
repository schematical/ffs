<?php
//die(header('location:' . FFSForm::Competition()->Namespace . '/parent/message.php'));

class FFSFeedForm extends FFSForm
{

    public $pnlFeed = null;
    public function Form_Create()
    {
        parent::Form_Create();
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/feed.tpl.php';


        $this->InitFeed();


    }
    public function Update(){
        //$this->Alert("Updated :)");
    }

    public function InitFeed($initLastUpdated = 0){
        $this->pnlFeed = new MJaxFeedPanel($this);
        $strExcludeParentMessage = '';
        $pnlSelectedEntity = null;
        $intIdParentMessage = MLCApplication::QS(FFSQS::IdParentMessage);

        if(!is_null($intIdParentMessage)){
            $objParentMessage = ParentMessage::LoadById($intIdParentMessage);
            if(!is_null($objParentMessage)){
                $pnlSelectedEntity = $this->pnlFeed->AddFeedEntity(
                    $objParentMessage,
                    'QueDate'
                );

            }
            $strExcludeParentMessage = 'AND ParentMessage.idParentMessage != ' . $intIdParentMessage . ' ';
        }
        $intIdResult= MLCApplication::QS(FFSQS::IdResult);

        if(!is_null($intIdResult)){
            $objResult = Result::LoadById($intIdResult);
            if(!is_null($objResult)){
                $pnlSelectedEntity = $this->pnlFeed->AddFeedEntity(
                    $objResult
                );

            }


        }
        if(!is_null($pnlSelectedEntity)){
            //Makr highlighted
            $pnlSelectedEntity->AddCssClass('alert');
            $this->ScrollTo($pnlSelectedEntity);
        }
        //if user is not logged in load by competition
        //if(is_null(MLCAuthDriver::User())){

        if(!is_null(FFSForm::Competition())){
            //Init feed based on competition

            //Load All results by session
            $arrActiveSessions = FFSApplication::GetActiveSessions();


            if(count($arrActiveSessions) == 0){
                $pnlAnounce = new MJaxPanel($this);
                $pnlAnounce->Text = sprintf(
                    '<h3>There are no active sessions at the moment</h3> Thanks for checking out <b>%s</b>',
                    FFSForm::Competition()->Name
                );
                $this->arrFeedEntities[$initLastUpdated + 1] = $pnlAnounce;
            }

            foreach($arrActiveSessions as $objSession){

                $arrResults = FFSApplication::GetResultsBySessionGroupByAthelete($objSession);
                foreach($arrResults as $arrGroupedResults){
                    foreach($arrGroupedResults as $strKey => $objResult){
                        if(is_null($objResult->IdAthelete)){
                           unset($arrGroupedResults[$strKey]);
                        }

                    }
                }
                $this->pnlFeed->AddFeedEntity(
                    $arrResults
                );
            }
            //Load All parent messages by competiton
            $collCompetition = ParentMessage::Query(
                sprintf(
                    ' WHERE ParentMessage.idCompetition = %s AND QueDate > "%s" %s ORDER BY queDate DESC LIMIT 5',
                    FFSForm::Competition()->IdCompetition,
                    date(MLCDateTime::MYSQL_FORMAT, $initLastUpdated),
                    $strExcludeParentMessage
                )
            );


            $this->pnlFeed->AddFeedEntity(
                $collCompetition,
                'QueDate'
            );
        }else{
            //Show results based on time line parameters
            $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);

            if(!is_null($intIdAthelete)){
                $arrResults = Result::LoadCollByIdAthelete($intIdAthelete);

                $arrResults = Result::GroupByCompetition($arrResults);
                //_dv($arrResults);
                //_dv($arrResults[array_keys($arrResults)[0]]->Length());
                $this->pnlFeed->AddFeedEntity(
                    $arrResults
                );
            }
        }

    }
    public function GetShareUrl(){
        $arrQS = array();
        $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);
        if(!is_null($intIdAthelete)){
            $arrQS[FFSQS::Athelete_IdAthelete] = $intIdAthelete;
        }

        $intIdOrg = MLCApplication::QS(FFSQS::Org_IdOrg);
        if(!is_null($intIdOrg)){
            $arrQS[FFSQS::Org_IdOrg] = $intIdOrg;
        }

        $strNamespace = '';
        if(!is_null(FFSForm::Competition())){
            $strNamespace = FFSForm::Competition()->Namespace .'/';
        }
        $strUrl = sprintf(
            '%s://%s/%s?%s',
            (SERVER_ENV == 'local'?'http':'https'),
            $_SERVER['SERVER_NAME'],
            $strNamespace . 'parent/feed',
            http_build_query(
                $arrQS
            )
        );
        return $strUrl;
    }
}

?>