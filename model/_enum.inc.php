<?php
abstract class FFSRoll{
    const ORG_MANAGER = 'org_manager';
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