<?php
/**
 * @version $Id: index.php 7311 2010-03-10 13:21:15Z matt $
 * @author Matthew McNaney <mcnaney at gmail dot com>
 */

if (!defined('PHPWS_SOURCE_DIR')) {
    include '../../core/conf/404.html';
    exit();
}

PHPWS_Core::initModClass('help', 'Help.php');

PHPWS_Help::show_help();

?>