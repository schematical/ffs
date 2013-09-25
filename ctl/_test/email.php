<?php
$strEmail = MLCApplication::QS('email');
$strEmailDir = __ASSETS_ACTIVE_APP_DIR__ . '/email';
if(is_null($strEmail)){
    if ($handle = opendir($strEmailDir)) {

        /* This is the correct way to loop over the directory. */
        while (false !== ($strFile = readdir($handle))) {
            if(!is_dir($strEmailDir . '/' . $strFile)){
                echo sprintf(
                    '<a href="?email=%s">%s</a><br/>',
                    $strFile,
                    $strFile
                );
            }
        }


        closedir($handle);
    }

}else{

    $ASSIGNMENT = Assignment::Query(
        'ORDER BY Assignment_rel.idAssignment DESC LIMIT 1',
         true
    );

    $AUTH_ROLL = AuthRoll::Query(
        'ORDER BY AuthRoll.idAuthRoll DESC LIMIT 1',
        true
    );
    $SUBJECT = 'Subject Line goes here';//You have been authorized to help at <?php echo $ASSIGNMENT->IdSessionObject->IdCompetitionObject->Name;
    require_once($strEmailDir . '/' . $strEmail);
}