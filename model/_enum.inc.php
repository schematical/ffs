<?php
abstract class FFSRoll{
    const ORG_MANAGER = 'org_manager';
    const FOLLOW = 'follow';
}
abstract class FFSInviteType{
    const EMAIL = 'EMAIL';
}
abstract class FFSMemType{
    const USAG = 'USAG';
}
abstract class FFSSection{
    const PARENT = 'parent';
    const ORG = 'org';
    const COACH = 'coach';
}
abstract class FFSQS extends FFSQSBase{
    const IdAthelete = 'a';
    const IdParentMessage = 'pm';
    const IdResult = 'r';
    const IdCompetition = 'c';
    const IdSession  = 's';
    const IdOrg = 'o';
}
abstract class FFSEventData{
    public static $WOMENS_ARTISTIC_GYMNASTICS = array(
        'Vault' => 'Vault',
        'Floor' => 'Floor',
        'Beam' => 'Beam',
        'Bars' => 'Bars'
    );
    public static $MENS_ARTISTIC_GYMNASTICS = array(
        'Vault' => 'Vault',
        'Floor' => 'Floor',
        'HighBar' => 'High Bar',
        'Rings' => 'Rings',
        'Parallel Bars' => 'Parallel Bars',
        'PommelHorse' => 'Pommel Horse'
    );
}