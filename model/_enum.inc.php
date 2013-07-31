<?php
abstract class MDECookie{
	const LAST_BUILD = 'mde-last-build';
    const GIT_REPO = 'git';
    const UTMA = '__utma';
}
abstract class MDEStripePlan{
	const NONE = null;
	const BUILD = 1;
    const LAUNCH = 2;
    const SCALE = 3;
}

