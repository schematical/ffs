<?php
class FFSRewriteHandeler extends MLCRewriteHandelerBase{
    protected $objEntityManager = null;
    public function Handel($strUri){


        $this->objEntityManager = new FFSEntityManager();

        if($strUri == '/'){
            return parent::Handel($strUri);
        }
        $arrParts = explode('/', $strUri);
        $arrFileNameParts = explode('.', $arrParts[count($arrParts) - 1]);
        if(count($arrFileNameParts) > 1){
            $strSufix = '.' . $arrFileNameParts[1];
        }else{
            $strSufix = '';
        }
        $arrParts[count($arrParts) - 1] = $arrFileNameParts[0];

        if(count($arrParts) > 1){
            $objCompetition = Competition::LoadSingleByField('namespace', $arrParts[1]);

            if(!is_null($objCompetition)){

                $this->objEntityManager->Competition($objCompetition);
                $this->objEntityManager->Org(Org::LoadById($objCompetition->IdOrg));
                $arrEndUri = array();
                for($i = 3; $i < count($arrParts); $i++){
                    $arrEndUri[] = $arrParts[$i];
                }
                if(count($arrEndUri) == 0){
                    $strEndUri = 'index.php' . $strSufix;
                }else{

                    $strEndUri = implode('/', $arrEndUri);

                    $strEndUri .= '.php';//$strSufix;
                }
                if(count($arrParts) > 2){
                    $strSubFolder = $arrParts[2];
                }else{
                    $strSubFolder = 'parent';
                }
                FFSForm::$strSection = $strSubFolder;

                //Assume it is a parent
                MLCApplication::$strCtlFile = __CTL_ACTIVE_APP_DIR__ . '/' . $strSubFolder . '/' . $strEndUri;

                if(file_exists(MLCApplication::$strCtlFile)){
                    return MLCApplication::$strCtlFile;
                }

                return FFSForm::$strSection = $arrParts[1];
            }else{
                FFSForm::$strSection = $arrParts[1];
                //_dv(FFSForm::$strSection);
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