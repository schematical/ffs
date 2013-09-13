<?php
$collAthelte = Athelete::Query('');
echo $collAthelte->Length();
echo '--------------------<br/>';
$collAthelte->Limit(10);
$collAthelte->AddFieldCondition('Athelete.firstName','E%','LIKE');
$collAthelte->QueryNext();
echo $collAthelte->Length();
foreach($collAthelte as $objAthelete){
    echo 'Name:' . $objAthelete->IdAthelete . ' - ' . $objAthelete->__toString() . '<br/>';
}

echo '--------------------<br/>';
$collAthelte->QueryNext();
echo $collAthelte->Length();
foreach($collAthelte as $objAthelete){
    echo 'Name:' . $objAthelete->IdAthelete . ' - ' . $objAthelete->__toString() . '<br/>';
}

echo '--------------------<br/>';
$collAthelte->QueryNext();
echo $collAthelte->Length();
foreach($collAthelte as $objAthelete){
    echo 'Name:' . $objAthelete->IdAthelete . ' - ' . $objAthelete->__toString() . '<br/>';
}
