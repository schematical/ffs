<?php
abstract class FFSRoll{
    const ORG_MANAGER = 'org_manager';
    const FOLLOW = 'follow';
    const PARENT = 'parent';
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
    const IdParentMessage = 'idParentMessage';
    const IdResult = 'r';
    const IdCompetition = 'c';
    const IdSession  = 's';
    const IdOrg = 'o';
    const UseWizzard = 'w';
}
abstract class FFSSessionSettings{
    const athelete_capacity = 'athelete_capacity';
}
abstract class FFSEventData{
    public static $WOMENS_ARTISTIC_GYMNASTICS = array(
        'Vault' => 'Vault',
        'Bars' => 'Bars',
        'Beam' => 'Beam',
        'Floor' => 'Floor'
    );
    public static $MENS_ARTISTIC_GYMNASTICS = array(
        'Vault' => 'Vault',
        'Floor' => 'Floor',
        'HighBar' => 'High Bar',
        'Rings' => 'Rings',
        'Parallel Bars' => 'Parallel Bars',
        'PommelHorse' => 'Pommel Horse'
    );
    public static $TNT_GYMNASTICS = array(
        'Trampoline' => 'Trampoline',
        'Double Mini' => 'Double Mini',
        'Tumbling' => 'Tumbling'
    );
}
abstract class FFSFlightData{
    public static $WOMENS_ARTISTIC_GYMNASTICS = array(
        'Flight A' => 'Flight A',
        'Flight B' => 'Flight B',
        'Flight C' => 'Flight C',
        'Flight D' => 'Flight D'

    );
    public static $MENS_ARTISTIC_GYMNASTICS = array(
        'Flight A' => 'Flight A',
        'Flight B' => 'Flight B',
        'Flight C' => 'Flight C',
        'Flight D' => 'Flight D',
        'Flight E' => 'Flight E',
        'Flight F' => 'Flight F',
    );
}
abstract class FFSSessionState{
    CONST UPCOMING = 'UPCOMING';
    CONST ACTIVE = 'ACTIVE';
    CONST CLOSED = 'CLOSED';
}
abstract class FFSCompetitionState{
    CONST UPCOMING = 'UPCOMING';
    CONST ACTIVE = 'ACTIVE';
    CONST CLOSED = 'CLOSED';
}
abstract class FFSClubTypes{
    public static $arrClubTypes = array(
        'AAU'=>'AAU',
        'USGA'=>'USGA',
        'USTA'=>'USTA'
    );
}
abstract class FFSResultSpecialNotes{
    const Stuck = 'Stuck';
    const Solid = 'Solid';
    const Average = 'Average';
    const Wobbly = 'Wobbly';
    const Fall = 'Fall';
}