<?php
$objAthelete = Athelete::Query('WHERE 1', true, array(
    'Org'
));
echo $objAthelete->IdOrgObject->Name;