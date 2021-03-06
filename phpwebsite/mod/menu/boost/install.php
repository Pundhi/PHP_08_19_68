<?php

/**
 * @author Matthew McNaney <mcnaney at gmail dot com>
 * @version $Id: install.php 7384 2010-03-24 14:29:01Z matt $
 */

function menu_install(&$content)
{
    PHPWS_Core::initModClass('menu', 'Menu_Item.php');
    $menu = new Menu_Item;
    $menu->title = dgettext('menu', 'Main menu');
    $menu->template = 'basic';
    $menu->pin_all = 1;
    $result = $menu->save();
    if (PHPWS_Error::isError($result)) {
        PHPWS_Error::log($result);
        return false;
    } else {
        $content[] = dgettext('menu', 'Default menu created successfully.');
        return true;
    }
}

?>