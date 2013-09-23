<?php
$arrAthelete = Athelete::LoadCollByIdOrg(84);
foreach($arrAthelete as $objAthelete){
    if(count($objAthelete->GetResultArr()) == 0){
        echo "Deleteing: " . $objAthelete->IdAthelete . ' = ' . count($objAthelete->GetResultArr()) . '</br>';
        $objAthelete->MarkDeleted();
    }else{
        echo "Keeping: " . $objAthelete->IdAthelete . ' = ' . count($objAthelete->GetResultArr()) . '</br>';
    }
}