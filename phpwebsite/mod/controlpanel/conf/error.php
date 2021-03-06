<?php
/**
 * @version $Id: error.php 7341 2010-03-15 19:57:34Z matt $
 * @author Matthew McNaney <mcnaney at gmail dot com>
 */

$errors = array (CP_BAD_TABS       => dgettext('controlpanel', 'Tabs must be in an array.'),
CP_MISSING_TITLE  => dgettext('controlpanel', 'Tab is missing a title.'),
CP_MISSING_LINK   => dgettext('controlpanel', 'Tab is missing a link address.'),
CP_NO_TABS        => dgettext('controlpanel', 'Unable to pull control panel tabs from database.')
);
?>