<?php
$arrResults = Result::LoadAll()->getCollection();
foreach($arrResults as $intIndex => $objResult){
    if(strlen($objResult->Score) <= 1){
        echo 'DEleteing: ' . $objResult->IdResult . ' ' . $objResult->Score . "    <br/>\n";
        $objResult->MarkDeleted();
    }
}
MLCApplication::InitPackage('MLCCodegen');
require_once(dirname(__FILE__) . '/Discussion.class.php');
require_once(dirname(__FILE__) . '/Comment.class.php');
require_once(dirname(__FILE__) . '/Cat.class.php');

$objSaveDriver = new MLCZipSaveDriver('andre.zip');
//Load all catigorys
$arrCat = Cat::Query('WHERE 1');
foreach($arrCat as $objCat){
    //Post cat in via api(or create json)
    $objCat->PopulateDiscussions();

    $objSaveDriver->AddFile(
        'categories/' . $objCat->intIdCat . '.json',
        json_encode($objCat->GetData())
    );
    //_dv($objSaveDriver);
    //Load all topics/Discussions for a given cat

    foreach($objCat->arrDiscussions as $objDiscussion){
        $objDiscussion->PopulateComments();


        $objSaveDriver->AddFile(
            'categories/' . $objCat->intIdCat .  '/' . $objDiscussion->intIdTopic . '.json',
            json_encode($objDiscussion->GetData())
        );

    }


}
$objSaveDriver->CleanUp();
_dv($objSaveDriver->GetResult());