<?php
class FFSRewriteHandeler extends MLCRewriteHandelerBase{
    public function Handel($strUri){
        $arrParts = explode('/', $strUri);
        if(count($arrParts) > 1){
            $strFirstNamespace = explode('.', $arrParts[1])[0];

            $objCompetition = Competition::LoadSingleByField('namespace', $strFirstNamespace);

            if(!is_null($objCompetition)){
                //Assume it is a parent
                return MLCApplication::$strCtlFile = __CTL_ACTIVE_APP_DIR__ . '/parent/index.php';
            }

        }
        parent::Handel($strUri);



    }
    /*public function Handel($strUri){
        $arrParts = explode('/', $strUri);
        if(count($arrParts) > 1){
            $objUser = AuthAccount::LoadSingleByField('shortDesc', $arrParts[1]);

            if(!is_null($objUser)){
                if(count($arrParts) < 3){
                    //Redirect to user home (index for today)
                    return MLCApplication::$strCtlFile = __CTL_ACTIVE_APP_DIR__ . '/index.php';//Might want to make this user home
                }else{
                    switch($arrParts[2]){
                        case('new_app'):
                            return MLCApplication::$strCtlFile = __CTL_ACTIVE_APP_DIR__ . '/AppHome.php';
                        break;
                        default:
                            //Try to load said app
                            $objApp = MDEApp::LoadSingleByField('namespace', $arrParts[2]);
                            if(!is_null($objApp)){
                                MDEForm::SetApp($objApp);
                                MDEBuildDriver::App($objApp);
                                if(count($arrParts) < 4){
                                    //Set app home
                                    return MLCApplication::$strCtlFile = __CTL_ACTIVE_APP_DIR__ . '/AppHome.php';

                                }else{
                                    if(count($arrParts) >= 4){
                                        //Figure out what the hell we are doing to the app

                                        $strEndUri = '';
                                        for($i = 4; $i < count($arrParts); $i++){
                                            $strEndUri .= '/' . $arrParts[$i];
                                        }
                                        MLCApplication::$strCtlFile = __CTL_ACTIVE_APP_DIR__ . '/' . $arrParts[3] .  $strEndUri;
                                        //. '.php';//$arrParts[4] . '.php';
                                        if(is_dir(MLCApplication::$strCtlFile)){
                                            MLCApplication::$strCtlFile .= '/index.php';
                                        }else{

                                            if(
                                                substr(
                                                    MLCApplication::$strCtlFile,
                                                    (strlen(MLCApplication::$strCtlFile) - 4),
                                                    4
                                                ) != '.php'
                                            ){
                                                MLCApplication::$strCtlFile .= '.php';
                                            }
                                        }
                                        //die(MLCApplication::$strCtlFile);
                                        return MLCApplication::$strCtlFile;
                                    }
                                }
                            }
                        break;
                    }
                }
            }
        }
        parent::Handel($strUri);



    }*/
    public static function ConvertToNamespace($strText){
        $strText = strtolower($strText);
        $strText = preg_replace('/[^a-z0-9]/', "", $strText);
        return $strText;
    }
}