<?php
$strFile = file_get_contents(dirname(__FILE__) . '/test.txt');
$strFile = str_replace("\n\r", "\n", $strFile);
$arrLines = explode("\n", $strFile);
$i = 0;
$objSession = Session::LoadById(57);
$objSession->Data('flights', array(
    'Flight A' => 'Flight A',
    'Flight B' => 'Flight B',
    'Flight C' => 'Flight C'
));
echo $objSession->Name . '<br>';
echo 'Importing Lines: count(' . count($arrLines) . ')' . '<br>';
while($i < count($arrLines)){
    $strLine = $arrLines[$i];
    //echo substr($strLine, 0, count('Level')) . '<br/>';
    if(substr($strLine, 0, strlen('Level')) == 'Level'){
        $objAthelete = new Athelete();
        $arrParts = explode(' ', $strLine);
        $objAthelete->Level = $arrParts[1];
        $i = $i + 1;
        $strLine = $arrLines[$i];
        $arrParts = explode(',', $strLine);
        if(!is_numeric($arrParts[0])){
            $i = $i + 1;
            $strLine = $arrLines[$i];
            $arrParts = explode(',', $strLine);
        }
        if(!is_numeric($arrParts[0])){
            $i = $i + 1;
            $strLine = $arrLines[$i];
            $arrParts = explode(',', $strLine);
        }
        if(!is_numeric($arrParts[0])){
            $i = $i + 1;
            $strLine = $arrLines[$i];
            $arrParts = explode(',', $strLine);
        }

        if(!array_key_exists(1,$arrParts)){
           //_dv($arrParts);
        }else{
            $arrName = explode(' ', $arrParts[1]);

            $objAthelete->IdOrg = 5;
            $objAthelete->FirstName = $arrName[0];
            $objAthelete->LastName = $arrName[1];
            $objAthelete->BirthDate = $arrParts[3];
            //$objAthelete->Save();
            $objAthelete->PsData('jackrabbit_id', $arrParts[0]);
            $objAthelete->PsData('phone', $arrParts[2]);
            $objAthelete->CreDate = MLCDateTime::Now();

            $objAthelete->Save();
            $objEnrollment = $objAthelete->CreateEnrollmentFromSession($objSession);

            switch($objEnrollment->Level){
                case(3);
                    $objEnrollment->Flight = 'Flight A';
                    break;
                case(4);
                    $objEnrollment->Flight = 'Flight B';
                    break;
                case(5);
                    $objEnrollment->Flight = 'Flight C';
                    break;
            }
            $objEnrollment->Save();


            echo 'Imported: ' .$objAthelete->__toString() . '<br/>';
        }
    }
    $i = $i + 1;
}